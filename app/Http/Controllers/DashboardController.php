<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => view('admin.dashboard'),
            'editor' => view('editor.dashboard'),
            default => view('fan.dashboard'),
        };
    }
}
