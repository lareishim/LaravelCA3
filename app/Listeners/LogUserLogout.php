<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Helpers\ActivityLogger;

class LogUserLogout
{
    /**
     * Handle the logout event.
     */
    public function handle(Logout $event): void
    {
        ActivityLogger::log('logout', 'User logged out');
    }
}
