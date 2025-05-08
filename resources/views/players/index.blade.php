@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 text-white">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">NBA Players</h1>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('players.create') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                        + Add Player
                    </a>
                @endif
            @endauth
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($players as $player)
                <div class="bg-gray-800 rounded-lg shadow p-4">
                    @if($player->image)
                        <img src="{{ $player->image }}" alt="{{ $player->name }}" class="w-full h-48 object-cover rounded mb-4">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $player->name }}</h2>
                    <p class="text-gray-400">{{ $player->team ?? 'No team' }} — {{ $player->position ?? 'N/A' }}</p>

                    <div class="mt-3">
                        <a href="{{ route('players.show', $player) }}" class="text-indigo-400 hover:underline">View Profile</a>
                    </div>
                </div>
            @empty
                <p>No players added yet.</p>
            @endforelse
        </div>
    </div>
@endsection
