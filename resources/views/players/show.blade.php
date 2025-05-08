@extends('layouts.app')

@section('content')
    <div class="py-10 px-4 max-w-5xl mx-auto text-white">
        <div class="bg-gray-900 rounded-lg p-6 shadow-md space-y-6">

            {{-- Player Info --}}
            <div class="flex flex-col md:flex-row gap-6 items-center">
                {{-- Player Image --}}
                @if ($player->image && file_exists(public_path('images/' . $player->image)))
                    <img src="{{ asset('images/' . $player->image) }}" alt="{{ $player->name }}"
                         class="w-64 h-64 object-cover rounded border border-gray-700">
                @else
                    <div class="w-64 h-64 flex items-center justify-center bg-gray-800 text-gray-400 rounded">
                        No Image Available
                    </div>
                @endif

                {{-- Player Stats --}}
                <div class="space-y-2 text-center md:text-left">
                    <h2 class="text-2xl font-bold">{{ $player->name }}</h2>
                    <p class="text-sm text-gray-400">{{ $player->team }} — {{ $player->position }}</p>
                    <p><strong>Afrobeats Track:</strong> {{ $player->afrobeats_track ?? 'N/A' }}</p>
                    <p><strong>Points/Game:</strong> {{ $player->points_per_game ?? 'N/A' }}</p>
                    <p><strong>Assists/Game:</strong> {{ $player->assists_per_game ?? 'N/A' }}</p>
                    <p><strong>Rebounds/Game:</strong> {{ $player->rebounds_per_game ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- YouTube Highlight --}}
            @php
                $youtubeId = null;
                if ($player->highlight_url) {
                    if (str_contains($player->highlight_url, 'youtu.be/')) {
                        $youtubeId = substr($player->highlight_url, strrpos($player->highlight_url, '/') + 1);
                    } elseif (preg_match('/v=([^&]+)/', $player->highlight_url, $matches)) {
                        $youtubeId = $matches[1];
                    }
                }
            @endphp

            @if ($youtubeId)
                <div class="mt-6">
                    <iframe class="w-full h-64 md:h-96 rounded"
                            src="https://www.youtube.com/embed/{{ $youtubeId }}"
                            title="Player Highlight"
                            frameborder="0"
                            allowfullscreen>
                    </iframe>
                </div>
            @else
                <p class="text-gray-400 italic">No highlight video available.</p>
            @endif
        </div>
    </div>
@endsection
