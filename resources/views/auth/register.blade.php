<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900 text-white px-4">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Create an Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-white" />
                    <x-text-input id="name" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                  type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <x-primary-button class="w-full justify-center">
                    {{ __('Register') }}
                </x-primary-button>
            </form>

            <!-- Extra Links -->
            <div class="mt-6 text-center text-sm text-gray-400">
                <p>Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Log in</a>
                </p>
                <p class="mt-2">
                    <a href="{{ url('/') }}" class="text-indigo-400 hover:underline">← Back to Home</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
