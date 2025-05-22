<nav x-data="{ open: false }" class="bg-gray-900 text-white border-b border-gray-700 w-full">
    <div class="px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <!-- Logo + Left Links -->
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="NBA Hub Logo" class="h-9 w-auto rounded shadow" />
            </a>

            @auth
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>
                <x-nav-link :href="route('players.index')" :active="request()->routeIs('players.*')">
                    Players
                </x-nav-link>

                <!-- Posts Dropdown -->
                <x-dropdown align="left" width="60">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium hover:text-gray-300 transition">
                            📝 Posts
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('posts.index')">
                            📄 View All Posts
                        </x-dropdown-link>

                        @unless(Auth::user()->hasRole('admin'))
                            <x-dropdown-link :href="route('posts.create')">
                                ✍️ Create Post
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('posts.mine')">
                                📁 My Posts
                            </x-dropdown-link>
                        @endunless
                    </x-slot>
                </x-dropdown>

                @if(Auth::user()->hasRole('admin'))
                    <x-nav-link :href="route('admin.users.index')">
                        👥 Manage Users
                    </x-nav-link>
                    <x-nav-link :href="route('admin.posts.pending')">
                        🕒 Pending Posts
                        @if(isset($pendingCount) && $pendingCount > 0)
                            <span class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold leading-none text-red-100 bg-red-600 rounded-full">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </x-nav-link>
                    <x-nav-link :href="route('admin.reports')">
                        🚩 Reports
                    </x-nav-link>
                    <x-nav-link :href="route('admin.logs')">
                        📜 Activity Logs
                    </x-nav-link>
                @endif
            @endauth
        </div>

        <!-- Right Links -->
        <div class="hidden sm:flex sm:items-center space-x-6">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium hover:text-gray-300 transition">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            ⚙️ {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('messages')">
                            📬 {{ __('Messages') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-700 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="text-sm hover:text-gray-300 transition">Login</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-gray-300 transition">Register</a>
                </div>
            @endauth
        </div>

        <!-- Mobile Hamburger -->
        <div class="flex sm:hidden">
            <button @click="open = ! open" class="text-gray-400 hover:text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path :class="{ 'hidden': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-gray-800 px-4 py-2">
        @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('players.index')" :active="request()->routeIs('players.*')">
                Players
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.index')">
                📄 View All Posts
            </x-responsive-nav-link>

            @unless(Auth::user()->hasRole('admin'))
                <x-responsive-nav-link :href="route('posts.create')">
                    ✍️ Create Post
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('posts.mine')">
                    📁 My Posts
                </x-responsive-nav-link>
            @endunless

            @if(Auth::user()->hasRole('admin'))
                <x-responsive-nav-link :href="route('admin.users.index')">
                    👥 Manage Users
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.posts.pending')">
                    🕒 Pending Posts
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold leading-none text-red-100 bg-red-600 rounded-full">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reports')">
                    🚩 Reports
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.logs')">
                    📜 Activity Logs
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('profile.edit')">
                ⚙️ {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                    🚪 {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-sm py-1">Login</a>
            <a href="{{ route('register') }}" class="block text-sm py-1">Register</a>
        @endauth
    </div>
</nav>
