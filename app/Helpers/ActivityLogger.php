<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $action, string $description = null): void
    {
        $activity = activity();

        if (Auth::check()) {
            $activity->causedBy(Auth::user());
        }

        $activity
            ->withProperties([
                'description' => $description,
            ])
            ->log($action);
    }
}
