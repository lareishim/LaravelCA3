<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return match (true) {
            $user->hasRole('admin') => view('admin.dashboard'),
            $user->hasRole('editor') => view('editor.dashboard'),
            default => view('fan.dashboard'),
        };
    }
}
