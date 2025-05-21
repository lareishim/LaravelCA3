<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Helpers\ActivityLogger;

class LogUserLogin
{
    /**
     * Handle the login event.
     */
    public function handle(Login $event): void
    {
        ActivityLogger::log('login', 'User logged in');
    }
}
