<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Send www.e-trust.online (and plain http in production) to https://e-trust.online with one 301. */
class CanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('production') && ! $request->is('up')) {
            $host = $request->getHost();
            $wantHost = parse_url((string) config('app.url'), PHP_URL_HOST) ?: $host;
            $secure = $request->isSecure();
            if ($host !== $wantHost || ! $secure) {
                return redirect()->to('https://' . $wantHost . $request->getRequestUri(), 301);
            }
        }

        return $next($request);
    }
}
