<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <!-- 🏀 Welcome Heading -->
            <h2 class="text-2xl font-bold text-center mb-2">
                Sign in to your NBA Hub Account
            </h2>

            <!-- 👤 Auth or Guest -->
            <p class="text-center text-sm text-gray-500 mb-6">
                @auth
                    Welcome back, <strong>{{ Auth::user()->name }}</strong>
                @else
                    You're logging in as a <strong>Guest</strong>
                @endauth
            </p>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                        Login
                    </button>
                </div>
            </form>

            <!-- Google Login -->
            <div class="text-center mt-4">
                <a href="{{ url('/auth/google') }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Sign in with Google
                </a>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4 text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
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
