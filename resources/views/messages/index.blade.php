@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Messages</h1>

        @php
            $seenIds = $user->seenAnnouncements->pluck('id')->toArray();
        @endphp

        @forelse ($announcements as $announcement)
            <a href="{{ route('messages.show', $announcement->id) }}">
                <div class="mb-4 p-4 border rounded flex justify-between items-center hover:bg-gray-800 transition
                            {{ in_array($announcement->id, $seenIds) ? 'border-gray-700' : 'border-blue-500' }}">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $announcement->title }}</h2>
                        <p class="text-sm text-gray-400">
                            {{ \Illuminate\Support\Str::limit($announcement->content, 80) }}
                        </p>
                    </div>
                    @if (!in_array($announcement->id, $seenIds))
                        <span class="text-blue-400 text-xl">🔵</span>
                    @endif
                </div>
            </a>
        @empty
            <p class="text-gray-400">No messages available.</p>
        @endforelse

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection
