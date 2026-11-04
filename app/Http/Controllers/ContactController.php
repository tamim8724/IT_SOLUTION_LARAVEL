<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'message.min' => 'Tell us a little more about your project (at least 10 characters).',
        ]);

        $data['sent_at'] = now('Asia/Dhaka')->toDateTimeString();
        $data['page'] = url()->previous();
        $data['ip'] = $request->ip();

        // 1) Keep a copy on the server (storage/app/contact-messages.jsonl)
        try {
            Storage::disk('local')->append('contact-messages.jsonl', json_encode($data, JSON_UNESCAPED_UNICODE));
        } catch (Throwable $e) {
            Log::warning('Could not store contact message', ['error' => $e->getMessage()]);
        }

        // 2) Always write to the log (visible in Render > Logs)
        Log::info('New contact message', $data);

        // 3) Email the team (works once MAIL_* / RESEND_KEY is configured)
        $subject = 'Website enquiry from ' . $data['name']
            . (filled($data['service'] ?? null) ? ' (' . $data['service'] . ')' : '');
        $body = "New message from the e-Trust website\n\n"
            . "Name: {$data['name']}\n"
            . "Email: {$data['email']}\n"
            . 'Phone: ' . ($data['phone'] ?? '-') . "\n"
            . 'Service: ' . ($data['service'] ?? '-') . "\n\n"
            . "Message:\n{$data['message']}\n\n"
            . "Sent: {$data['sent_at']} (Dhaka time) from {$data['page']}";

        try {
            Mail::raw($body, function ($mail) use ($data, $subject) {
                $mail->to(config('etrust.contact_to'))
                    ->replyTo($data['email'], $data['name'])
                    ->subject($subject);
            });
        } catch (Throwable $e) {
            // The message is already saved above, so the visitor still gets a success message.
            Log::error('Contact form mail failed: ' . $e->getMessage());
        }

        return redirect()->to($back)->with('contact_success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
