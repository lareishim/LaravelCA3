<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left Section: Logo and Nav -->
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="NBA Hub Logo" class="h-10 w-auto">
                </a>

                <!-- Dashboard Link -->
                @auth
                    <div class="hidden sm:flex space-x-6">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Right Section: Auth Dropdown or Guest Buttons -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                                @if (auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="avatar" class="h-8 w-8 rounded-full object-cover mr-2">
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-200 transition">Register</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="-me-2 flex sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{ 'hidden': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="sm:hidden hidden px-4 pt-4 pb-6">
        @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <div class="mt-4 border-t pt-4">
                <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-md text-center mb-2">Login</a>
            <a href="{{ route('register') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-800 rounded-md text-center">Register</a>
        @endauth
    </div>
</nav>
