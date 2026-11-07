<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Check the AI assistant setup: php artisan ai:test
Artisan::command('ai:test', function () {
    $this->line('PHP ' . PHP_VERSION . ' | curl: ' . (extension_loaded('curl') ? 'yes' : 'NO') . ' | openssl: ' . (extension_loaded('openssl') ? 'yes' : 'NO'));
    $results = app(\App\Services\AiAssistant::class)->diagnose();
    if (! $results) {
        $this->warn('No AI provider key found. Add e.g. GROQ_API_KEY=gsk_... to .env, then run: php artisan config:clear');
        return;
    }
    foreach ($results as $key => $r) {
        $line = sprintf('%-11s %-24s %5.1fs  %s', $key, $r['model'], $r['seconds'], $r['ok'] ? 'OK  -> ' . $r['detail'] : 'FAIL -> ' . $r['detail']);
        $r['ok'] ? $this->info($line) : $this->error($line);
        if (! $r['ok'] && str_contains($r['detail'], 'cURL error 60')) {
            $this->warn('  Fix: PHP cannot verify SSL certificates. See README "AI troubleshooting".');
        }
        if (! $r['ok'] && preg_match('/HTTP 401|invalid.?api.?key/i', $r['detail'])) {
            $this->warn('  Fix: the API key is wrong. Copy it again (no spaces or quotes) and run php artisan config:clear');
        }
        if (! $r['ok'] && preg_match('/cURL error (6|7|28)\b|timed out|Could not resolve/i', $r['detail'])) {
            $this->warn('  Fix: your computer cannot reach this AI (internet, firewall, VPN or antivirus). Test in a browser: https://api.groq.com');
        }
        if ($r['ok'] && $r['seconds'] > 6) {
            $this->warn('  Slow. For faster replies try a smaller model, e.g. GROQ_MODEL=llama-3.1-8b-instant');
        }
        if (! $r['ok'] && str_contains($r['detail'], 'HTTP 429')) {
            $this->warn('  The free limit for this provider is used up for now. Wait a minute (or until tomorrow).');
        }
    }
})->purpose('Test the AI assistant API keys');
