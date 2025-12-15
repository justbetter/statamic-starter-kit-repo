<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Statamic::vite('app', [
            'resources/js/cp.js',
            'resources/css/cp.css',
        ]);
    }
}
