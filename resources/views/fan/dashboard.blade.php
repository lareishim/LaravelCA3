@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-6 text-white">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ auth()->user()->name }} 👋</h1>
        <p class="text-lg text-gray-300">
            Here’s your personalized feed of players, highlights, and music picks curated just for you.
        </p>

        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Your Liked Players</h2>

            @if(auth()->user()->likedPlayers->isEmpty())
                <div class="border border-gray-700 rounded-lg p-6 text-center text-gray-400">
                    No liked players yet. Start exploring and hit the like button!
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(auth()->user()->likedPlayers as $player)
                        <div class="bg-gray-800 rounded-lg p-4 shadow-md text-center">
                            @if ($player->image && file_exists(public_path('images/' . $player->image)))
                                <img src="{{ asset('images/' . $player->image) }}" alt="{{ $player->name }}"
                                     class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border border-gray-600">
                            @else
                                <div class="w-32 h-32 bg-gray-700 rounded-full mx-auto mb-4 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif

                            <h3 class="text-lg font-bold">{{ $player->name }}</h3>
                            <p class="text-sm text-gray-400">{{ $player->team }} — {{ $player->position }}</p>
                            <p class="text-sm mt-1">🎵 {{ $player->afrobeats_track }}</p>

                            {{-- Unlike button --}}
                            <form method="POST" action="{{ route('players.unlike', $player->id) }}" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-sm rounded text-white">
                                    💔 Unlike
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
