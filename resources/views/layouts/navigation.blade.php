<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="NBA Logo" class="h-10 w-auto">
            </a>

            {{-- Nav Links --}}
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition">Register</a>
                @endguest

                @auth
                    <span class="text-gray-800 font-medium">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded bg-red-200 text-red-700 font-semibold hover:bg-red-300 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
