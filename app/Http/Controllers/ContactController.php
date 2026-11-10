<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $back = url('/contact') . '#message';

        // Honeypot: real visitors never see this field, so anything in it is a bot.
        if (filled($request->input('website'))) {
            return redirect()->to($back)->with('contact_success', 'Thank you! Your message has been sent.');
        }

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:100', 'not_regex:/[\r\n]/'],
            'email'   => ['required', 'email:rfc,filter', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:30', 'not_regex:/[\r\n]/'],
            'service' => ['nullable', 'string', 'max:100', 'not_regex:/[\r\n]/'],
            'country' => ['nullable', Rule::in(Enquiry::COUNTRIES)],
            'budget'  => ['nullable', Rule::in(Enquiry::allBudgets())],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'message.min' => 'Tell us a little more about your project (at least 10 characters).',
        ]);

        $data['source_page'] = mb_substr((string) url()->previous(), 0, 255);
        $data['ip'] = $request->ip();

        // 1) Save to the database (the main record, visible at /admin/enquiries)
        $enquiry = null;
        try {
            $enquiry = Enquiry::create($data);
        } catch (Throwable $e) {
            Log::error('Could not save enquiry to database', ['error' => $e->getMessage()]);
            // Fallback so nothing is lost if the database is unavailable
            try {
                Storage::disk('local')->append('contact-messages.jsonl', json_encode($data + ['sent_at' => now()->toDateTimeString()], JSON_UNESCAPED_UNICODE));
            } catch (Throwable $e2) {
                Log::warning('Could not store contact message', ['error' => $e2->getMessage()]);
            }
        }

        Log::info('New contact message', ['id' => $enquiry?->id, 'email' => $data['email']]);

        // 2) Email the team (works once MAIL_* / RESEND_KEY is configured)
        $subject = 'Website enquiry from ' . $data['name']
            . (filled($data['service'] ?? null) ? ' (' . $data['service'] . ')' : '');
        $body = "New message from the e-Trust website\n\n"
            . "Name: {$data['name']}\n"
            . "Email: {$data['email']}\n"
            . 'Phone: ' . ($data['phone'] ?? '-') . "\n"
            . 'Service: ' . ($data['service'] ?? '-') . "\n"
            . 'Country: ' . ($data['country'] ?? '-') . "\n"
            . 'Budget: ' . ($data['budget'] ?? '-') . "\n\n"
            . "Message:\n{$data['message']}\n\n"
            . 'Sent: ' . now('Asia/Dhaka')->toDateTimeString() . " (Dhaka time) from {$data['source_page']}\n"
            . ($enquiry ? 'Open in admin: ' . url('/admin/enquiries/' . $enquiry->id) . "\n" : '');

        try {
            Mail::raw($body, function ($mail) use ($data, $subject) {
                $mail->to(config('etrust.contact_to'))
                    ->replyTo($data['email'], $data['name'])
                    ->subject($subject);
            });
        } catch (Throwable $e) {
            Log::error('Contact form mail failed: ' . $e->getMessage());
        }

        return redirect()->to($back)->with('contact_success', 'Thank you! Your message has been sent. We will reply within one working day.');
    }
}
