<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $email = $googleUser->getEmail();

        // ❌ Block admin and editor domains
        if (Str::endsWith($email, '@admin.com') || Str::endsWith($email, '@editor.com')) {
            abort(403, 'Only fans can log in with Google.');
        }

        // ✅ Otherwise continue as fan
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $googleUser->getName(),
                'password' => Hash::make(Str::random(16)),
                'role' => 'fan',
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
