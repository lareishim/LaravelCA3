<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900 text-white px-4">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Log in to your account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between mb-6 text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-600 text-indigo-500 shadow-sm focus:ring-indigo-400 bg-gray-700">
                        <span class="ml-2">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-indigo-400 hover:underline" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Log in -->
                <x-primary-button class="w-full justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>

            <!-- Google Login -->
            <div class="mt-6 text-center">
                <p class="mb-2 text-sm text-gray-400">Are you a fan? Use Google:</p>
                <a href="{{ route('google.redirect') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition">
                    Sign in with Google
                </a>
            </div>

            <!-- Register & Home Links -->
            <div class="mt-6 text-center text-sm text-gray-400">
                <p>Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Register</a>
                </p>
                <p class="mt-2">
                    <a href="{{ url('/') }}" class="text-indigo-400 hover:underline">← Back to Home</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
