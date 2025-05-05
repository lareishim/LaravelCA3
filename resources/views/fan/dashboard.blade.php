@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-6 text-white">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ auth()->user()->name }} 👋</h1>
        <p class="text-lg text-gray-300">
            Here’s your personalized feed of players, highlights, and music picks curated just for you.
        </p>

        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Your Liked Players</h2>
            {{-- Placeholder for future liked players --}}
            <div class="border border-gray-700 rounded-lg p-6 text-center text-gray-400">
                No liked players yet. Start exploring and hit the like button!
            </div>
        </div>
    </div>
@endsection
