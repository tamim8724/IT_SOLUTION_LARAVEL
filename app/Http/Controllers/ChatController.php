<?php

namespace App\Http\Controllers;

use App\Services\AiAssistant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function __invoke(Request $request, AiAssistant $ai): JsonResponse
    {
        $data = $request->validate([
            'messages'           => ['required', 'array', 'min:1', 'max:24'],
            'messages.*.role'    => ['required', 'string', 'in:user,assistant'],
            'messages.*.content' => ['required', 'string', 'max:4000'],
        ]);

        $messages = collect($data['messages'])
            ->map(fn ($m) => ['role' => $m['role'], 'content' => trim(mb_substr($m['content'], 0, 4000))])
            ->filter(fn ($m) => $m['content'] !== '')
            ->values()
            ->take(-16) // keep the conversation short to save tokens
            ->values()
            ->all();

        if (empty($messages) || end($messages)['role'] !== 'user') {
            return response()->json(['error' => 'Write a message to start the chat.'], 422);
        }

        if (mb_strlen(end($messages)['content']) > 2000) {
            return response()->json(['error' => 'Your message is too long. Keep it under 2,000 characters.'], 422);
        }

        // Fair-use limits (file cache, works without a database)
        $cfg = config('etrust.ai');
        $store = Cache::store('file');
        $ip = sha1((string) $request->ip() . '|' . substr((string) $request->userAgent(), 0, 200));
        $minuteKey = "chat:m:{$ip}:" . now()->format('YmdHi');
        $dayKey = "chat:d:{$ip}:" . now()->format('Ymd');
        $globalKey = 'chat:g:' . now()->format('Ymd');

        if ($store->get($minuteKey, 0) >= $cfg['per_minute']) {
            return response()->json(['error' => 'You are sending messages very fast. Wait a few seconds and try again.'], 429);
        }
        if ($store->get($dayKey, 0) >= $cfg['per_day']) {
            return response()->json(['error' => 'You have reached today\'s free message limit. Come back tomorrow, or contact our team directly.'], 429);
        }

        $store->put($minuteKey, $store->get($minuteKey, 0) + 1, 90);
        $store->put($dayKey, $store->get($dayKey, 0) + 1, 60 * 60 * 26);

        $overGlobal = $store->get($globalKey, 0) >= $cfg['global_per_day'];
        $store->put($globalKey, $store->get($globalKey, 0) + 1, 60 * 60 * 26);

        // No model picker: visitors talk to one assistant; providers are chosen on the server
        $result = $overGlobal
            ? ['reply' => $ai->localReply(end($messages)['content'], true), 'source' => 'local']
            : $ai->reply($messages);

        // Which provider answered stays in the server log, not in the browser
        if (($result['source'] ?? '') !== 'local') {
            \Illuminate\Support\Facades\Log::info('AI reply', ['provider' => $result['source'] ?? null]);
        }

        return response()->json(['reply' => $result['reply'], 'label' => 'e-Trust AI']);
    }
}
