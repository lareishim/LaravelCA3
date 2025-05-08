@extends('layouts.app')

@section('content')
    <div class="py-8 px-4 max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($players as $player)
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden p-4 flex flex-col items-center text-center">
                @if ($player->image && file_exists(public_path('images/' . $player->image)))
                    <img src="{{ asset('images/' . $player->image) }}" alt="{{ $player->name }}"
                         class="w-48 h-48 object-cover rounded mb-4 mx-auto">
                @else
                    <div class="w-48 h-48 bg-gray-700 flex items-center justify-center text-gray-400 rounded mb-4">
                        No Image
                    </div>
                @endif

                <h3 class="text-lg font-bold">{{ $player->name }}</h3>
                <p class="text-sm text-gray-400">{{ $player->team }} — {{ $player->position }}</p>
                <p class="text-sm mt-1">🎵 {{ $player->afrobeats_track }}</p>
                <p class="text-sm">🏀 {{ $player->points_per_game }} PPG, {{ $player->assists_per_game }} APG, {{ $player->rebounds_per_game }} RPG</p>

                <a href="{{ route('players.show', $player->id) }}" class="text-indigo-400 text-sm hover:underline mt-2">
                    View Profile
                </a>

                <form method="POST" action="{{ route('players.like', $player->id) }}" class="mt-3">
                    @csrf
                    <button type="submit"
                            class="mt-2 px-4 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded">
                        👍 Like Player
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-400 col-span-full text-center">No players found.</p>
        @endforelse
    </div>
@endsection
