@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 flex flex-col justify-center items-center text-center px-4">

        <!-- Heading -->
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 drop-shadow-lg">
            🏀 Welcome to NBA Hub
        </h1>

        <!-- Subtitle -->
        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl">
            Your all-in-one hub to track NBA stars, their favorite music, and unforgettable highlights.
        </p>

        <!-- Actions -->
        @guest
            <a href="{{ url('/auth/google') }}"
               class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-full text-lg transition duration-300 shadow-lg">
                Sign in with Google
            </a>

            <div class="mt-6 text-sm text-gray-400">
                Or <a href="{{ route('login') }}" class="underline hover:text-white">login</a> /
                <a href="{{ route('register') }}" class="underline hover:text-white">register</a> manually
            </div>
        @else
            <p class="text-white text-xl mb-4">
                Welcome back, <strong>{{ auth()->user()->name }}</strong> 👋
            </p>

            <a href="{{ url('/dashboard') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full text-lg transition duration-300 shadow-lg">
                Enter Dashboard
            </a>
        @endguest

        <!-- Footer note -->
        <div class="mt-12 text-xs text-gray-500">
            Built with Laravel + Tailwind · &copy; {{ date('Y') }}
        </div>
    </div>
@endsection
