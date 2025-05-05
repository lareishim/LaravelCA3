<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-2">Create Your NBA Hub Account</h2>

            <!-- 👤 Auth or Guest -->
            <p class="text-center text-sm text-gray-500 mb-6">
                @auth
                    You're already signed in as <strong>{{ Auth::user()->name }}</strong>
                @else
                    Registering as a <strong>Fan/Guest</strong>
                @endauth
            </p>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" required autofocus
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                        Register
                    </button>
                </div>
            </form>

            <!-- Login link -->
            <div class="text-center mt-4 text-sm text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
            </div>

            <!-- Back to Welcome -->
            <div class="text-center mt-6">
                <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:underline">
                    ← Back to Welcome Page
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
