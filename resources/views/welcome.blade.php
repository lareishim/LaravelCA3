@extends('layouts.app')

@section('content')

    {{-- Hero Section with Background --}}
    <section class="relative bg-cover bg-center bg-no-repeat text-white min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/nba-bg.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-60 z-0"></div>

        <div class="relative z-10 text-center px-4 py-12">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Welcome to NBA Hub 🏀</h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8">
                Track your favorite NBA players, explore their Afrobeats playlists, and relive epic basketball highlights.
                This hub brings basketball and music together in one immersive platform.
            </p>

            {{-- ✅ Only show to logged-in users --}}
            @auth
                <a href="{{ route('dashboard') }}" class="inline-block bg-white text-gray-800 px-6 py-3 rounded-full font-semibold shadow hover:bg-gray-100 transition">
                    Enter Dashboard
                </a>
            @endauth
        </div>
    </section>

    {{-- Why NBA Hub Section --}}
    <section class="bg-gray-900 pt-16 pb-4 px-8 text-left text-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold mb-6">Why NBA Hub?</h2>
                <p class="mb-6 text-gray-300">
                    NBA Hub blends the thrill of the game with the rhythm of music. Discover your favorite players and jam to their preferred Afrobeats tracks — all in one interactive dashboard.
                </p>
                <ul class="space-y-4 text-gray-200">
                    <li>✅ Real-time stats and profiles of top NBA players</li>
                    <li>✅ Curated Afrobeats playlists linked to player profiles</li>
                    <li>✅ Role-based access for Fans, Editors, and Admins</li>
                    <li>✅ Embedded YouTube music and video highlights</li>
                </ul>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="NBA Logo" class="w-80 rounded-lg shadow-lg">
            </div>
        </div>
    </section>

@endsection
