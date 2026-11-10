<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Leads from the AI chat: name, email and phone, confirmed with a 6-digit email code.
 * People are matched by email or phone (names can repeat), so the same person
 * never creates two leads.
 */
class LeadController extends Controller
{
    private const CODE_MINUTES = 10;
    private const MAX_TRIES = 5;

    /** Step 1: save the lead (unverified) and email a code */
    public function start(Request $request): JsonResponse
    {
        if (filled($request->input('website'))) { // honeypot
            return response()->json(['ok' => true, 'lead' => 'x']);
        }

        $data = $request->validate([
            'name'    => ['required', 'string', 'min:2', 'max:80'],
            // rfc = valid format, dns = the domain can actually receive mail
            'email'   => ['required', 'string', 'max:150', config('etrust.lead_email_dns', true) ? 'email:rfc,dns' : 'email:rfc'],
            'phone'   => ['required', 'string', 'max:30'],
            'summary' => ['nullable', 'string', 'max:1500'],
            'page'    => ['nullable', 'string', 'max:255'],
        ], [
            'email.email' => 'That email address doesn\'t look real. Check it and try again.',
        ]);

        [$phone, $country] = $this->normalisePhone($data['phone']);
        if (! $phone) {
            return response()->json(['errors' => ['phone' => ['Enter a valid mobile number, e.g. 01XXXXXXXXX (Bangladesh), 04XXXXXXXX (Australia) or +country code.']]], 422);
        }
        $email = mb_strtolower(trim($data['email']));
        $name = trim(strip_tags($data['name']));

        $lead = Enquiry::where('email', $email)->orWhere('phone', $phone)->latest()->first();
        $note = 'AI chat · ' . now('Asia/Dhaka')->format('d M Y, H:i');
        $summary = trim(strip_tags($data['summary'] ?? '')) ?: 'Asked for help in the AI chat.';

        if ($lead) {
            if ($lead->email !== $email) {
                $lead->verified_at = null; // new email address must be confirmed again
            }
            $lead->fill([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'country' => $lead->country ?: $country,
                'message' => mb_substr($lead->message . "\n\n— {$note}\n{$summary}", 0, 20000),
                'status' => $lead->status === 'lost' ? 'new' : $lead->status,
            ])->save();
        } else {
            $lead = Enquiry::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'country' => $country,
                'service' => 'AI chat',
                'message' => "— {$note}\n{$summary}",
                'status' => 'new',
                'source_page' => mb_substr($data['page'] ?? '/assistant', 0, 255),
                'ip' => $request->ip(),
            ]);
        }

        $code = (string) random_int(100000, 999999);
        Cache::put($this->key($lead->id), ['hash' => hash('sha256', $code . $lead->id), 'tries' => 0], now()->addMinutes(self::CODE_MINUTES));

        try {
            Mail::raw(
                "Hi {$name},\n\nYour e-Trust verification code is: {$code}\n\n"
                . 'Type it in the chat to confirm your email. The code works for ' . self::CODE_MINUTES . " minutes.\n\n"
                . "If you didn't ask for this, you can ignore this email.\n\ne-Trust\nhttps://e-trust.online",
                fn ($m) => $m->to($email, $name)->subject("{$code} is your e-Trust code")
            );
        } catch (Throwable $e) {
            Log::error('Lead code mail failed: ' . $e->getMessage());

            return response()->json(['error' => 'We couldn\'t send the code right now. Your details are saved and our team will email you.'], 503);
        }

        return response()->json(['ok' => true, 'lead' => encrypt($lead->id), 'email' => $email]);
    }

    /** Step 2: check the code */
    public function verify(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lead' => ['required', 'string', 'max:500'],
            'code' => ['required', 'string', 'regex:/^\d{6}$/'],
        ]);

        try {
            $id = decrypt($data['lead']);
        } catch (Throwable) {
            return response()->json(['error' => 'This code has expired. Ask for a new one.'], 422);
        }

        $entry = Cache::get($this->key($id));
        if (! $entry) {
            return response()->json(['error' => 'This code has expired. Ask for a new one.'], 422);
        }
        if ($entry['tries'] >= self::MAX_TRIES) {
            Cache::forget($this->key($id));

            return response()->json(['error' => 'Too many wrong tries. Ask for a new code.'], 429);
        }
        if (! hash_equals($entry['hash'], hash('sha256', $data['code'] . $id))) {
            $entry['tries']++;
            Cache::put($this->key($id), $entry, now()->addMinutes(self::CODE_MINUTES));

            return response()->json(['error' => 'That code isn\'t right. Check the email and try again.'], 422);
        }

        Cache::forget($this->key($id));
        $lead = Enquiry::find($id);
        if ($lead) {
            $lead->forceFill(['verified_at' => now()])->save();
            $this->notifyTeam($lead);
        }

        return response()->json(['ok' => true]);
    }

    private function notifyTeam(Enquiry $lead): void
    {
        try {
            Mail::raw(
                "New verified lead from the AI chat\n\n"
                . "Name: {$lead->name}\nEmail: {$lead->email}\nPhone: {$lead->phone}\nCountry: " . ($lead->country ?? '-') . "\n\n"
                . "{$lead->message}\n\nOpen in admin: " . url('/admin/enquiries/' . $lead->id) . "\n",
                fn ($m) => $m->to(config('etrust.contact_to'))->replyTo($lead->email, $lead->name)->subject('AI chat lead: ' . $lead->name)
            );
        } catch (Throwable $e) {
            Log::error('Lead notify mail failed: ' . $e->getMessage());
        }
    }

    /** Mobile number → [E.164, country] or [null, null] */
    private function normalisePhone(string $raw): array
    {
        $d = preg_replace('/\D+/', '', $raw);
        if (preg_match('/^(?:880|0)?(1[3-9]\d{8})$/', $d, $m)) {
            return ['+880' . $m[1], 'Bangladesh'];
        }
        if (preg_match('/^(?:61|0)?(4\d{8})$/', $d, $m)) {
            return ['+61' . $m[1], 'Australia'];
        }
        // Other countries: full international number, e.g. +44 7700 900123
        if (str_starts_with(trim($raw), '+') && preg_match('/^[1-9]\d{7,14}$/', $d)) {
            return ['+' . $d, 'Other'];
        }

        return [null, null];
    }

    private function key($id): string
    {
        return "lead:code:{$id}";
    }
}
