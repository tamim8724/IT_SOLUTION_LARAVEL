<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix mixed-content on Render (HTTPS site loading HTTP assets)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}