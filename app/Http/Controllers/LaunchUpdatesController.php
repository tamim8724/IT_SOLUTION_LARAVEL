<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/** "Get launch updates" for Our Innovation: emails are saved to the admin enquiries list. */
class LaunchUpdatesController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (filled($request->input('website'))) { // honeypot
            return response()->json(['ok' => true]);
        }
        $data = $request->validate([
            'email' => ['required', 'string', 'max:150', config('etrust.lead_email_dns', true) ? 'email:rfc,dns' : 'email:rfc'],
        ], ['email.email' => 'That email address doesn\'t look real.']);
        $email = mb_strtolower(trim($data['email']));

        try {
            Enquiry::firstOrCreate(
                ['email' => $email, 'service' => 'Launch updates'],
                ['name' => 'Launch updates', 'message' => 'Asked to be told when Our Innovation launches.', 'status' => 'new', 'source_page' => '/#innovation', 'ip' => $request->ip()]
            );
        } catch (Throwable $e) {
            Log::error('Launch updates signup failed: ' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }

        return response()->json(['ok' => true]);
    }
}
