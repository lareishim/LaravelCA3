<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FanController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'fan') {
            abort(403, 'Unauthorized access.');
        }

        return view('fan.dashboard');
    }
}
