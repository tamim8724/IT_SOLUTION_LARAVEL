<?php

/*
|--------------------------------------------------------------------------
| PHP polyfills
|--------------------------------------------------------------------------
| Some lightweight PHP builds (for example the one installed by php.new /
| Herd Lite on Windows) ship mbstring without its regex functions, so
| mb_split() is missing and Laravel's Str::studly() crashes. This fallback
| does the same job with preg_split() in UTF-8 mode. When the real
| mb_split() exists (Render's Docker image, XAMPP, etc.) this file does nothing.
*/

if (! function_exists('mb_split')) {
    function mb_split(string $pattern, string $string, int $limit = -1): array|false
    {
        $regex = '~' . str_replace('~', '\~', $pattern) . '~u';

        return preg_split($regex, $string, $limit);
    }
}
