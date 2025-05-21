<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // You can add other non-auth related listeners here if needed
    ];

    public function boot(): void
    {
        //
    }
}
