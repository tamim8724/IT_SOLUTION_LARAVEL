<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/** Free website audit requests: saved as enquiries, the team is emailed and the visitor gets a confirmation. */
class AuditController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        if (filled($request->input('company'))) { // honeypot
            return redirect()->to(url('/audit') . '#audit-form-box')->with('audit_success', 'We will email your report within 2 working days.');
        }

        $data = $request->validate([
            'name'       => ['required', 'string', 'min:2', 'max:100'],
            'email'      => ['required', 'string', 'max:150', config('etrust.lead_email_dns', true) ? 'email:rfc,dns' : 'email:rfc'],
            'no_website' => ['nullable', 'boolean'],
            'website'    => ['nullable', 'required_unless:no_website,1', 'string', 'max:200', 'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/\S*)?$/i'],
            'country'    => ['nullable', 'in:Australia,Bangladesh,Other'],
            'goal'       => ['nullable', 'in:More enquiries,Ranking on Google,Faster site,A fresh design'],
        ], [
            'website.required_unless' => 'Enter your website address, or tick the box below.',
            'website.regex'           => 'That website address doesn\'t look right.',
            'email.email'             => 'That email address doesn\'t look real. Check it and try again.',
        ]);

        $noSite = (bool) ($data['no_website'] ?? false);
        $site = $noSite ? null : trim((string) $data['website']);
        $message = $noSite
            ? 'No website yet: please send a free website plan.'
            : "Website: {$site}";
        $message .= "\nCountry: " . ($data['country'] ?? '-') . "\nWhat matters most: " . ($data['goal'] ?? '-');

        try {
            $enquiry = Enquiry::create([
                'name' => strip_tags($data['name']),
                'email' => mb_strtolower(trim($data['email'])),
                'service' => $noSite ? 'Free website plan' : 'Free website audit',
                'country' => $data['country'] ?? null,
                'message' => $message,
                'status' => 'new',
                'source_page' => '/audit',
                'ip' => $request->ip(),
            ]);
        } catch (Throwable $e) {
            Log::error('Audit request could not be saved: ' . $e->getMessage());
            $enquiry = null;
        }

        try {
            Mail::raw("New free audit request\n\nName: {$data['name']}\nEmail: {$data['email']}\n{$message}\n"
                . ($enquiry ? "\nOpen in admin: " . url('/admin/enquiries/' . $enquiry->id) . "\n" : ''),
                fn ($m) => $m->to(config('etrust.contact_to'))->replyTo($data['email'], $data['name'])
                    ->subject(($noSite ? 'Website plan request: ' : 'Audit request: ') . ($site ?: $data['name'])));
            Mail::raw("Hi {$data['name']},\n\nThanks for asking for a free " . ($noSite ? 'website plan' : 'website audit') . ".\n"
                . ($site ? "We'll check {$site} by hand" : "We'll put a simple plan together") . " and email you within 2 working days.\n\n"
                . "No calls, no spam. If you have questions, just reply to this email.\n\ne-Trust\nhttps://e-trust.online",
                fn ($m) => $m->to($data['email'], $data['name'])->subject('We got your free ' . ($noSite ? 'website plan' : 'website audit') . ' request'));
        } catch (Throwable $e) {
            Log::error('Audit mail failed: ' . $e->getMessage());
        }

        return redirect()->to(url('/audit') . '#audit-form-box')
            ->with('audit_success', 'We\'ve emailed you a confirmation and will send your report within 2 working days.');
    }
}
