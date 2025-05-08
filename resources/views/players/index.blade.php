<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">Test Blade Injected</h2>
    </x-slot>

    <div class="p-6 text-white">
        <div class="bg-green-700 p-4 mb-4 rounded">
            ✅ Blade view is working — player count: {{ $players->count() }}
        </div>

        @foreach ($players as $player)
            <div class="bg-gray-800 rounded p-4 mb-4">
                <strong>{{ $player->name }}</strong><br>
                Team: {{ $player->team }} — {{ $player->position }}<br>
                🎧 Track: {{ $player->afrobeats_track }}<br>
                📊 {{ $player->points_per_game }} pts • {{ $player->assists_per_game }} ast • {{ $player->rebounds_per_game }} reb
            </div>
        @endforeach
    </div>
</x-app-layout>
