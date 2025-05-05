<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Handles: /auth/google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handles: /auth/google/callback
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(str()->random(24)),
                'role' => 'fan', // ✅ Assign fan role
            ]
        );

        Auth::login($user);

        return redirect()->route('fan.dashboard');
    }
}
