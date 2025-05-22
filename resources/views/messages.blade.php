@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Messages</h1>

        @forelse ($announcements as $announcement)
            <div class="mb-6 p-4 border border-gray-700 rounded hover:bg-gray-800">
                <h2 class="text-xl font-semibold">{{ $announcement->title }}</h2>
                <p class="text-gray-400 text-sm mb-2">Posted on {{ $announcement->created_at->format('M d, Y') }}</p>
                <p>{{ $announcement->content }}</p>
            </div>
        @empty
            <p>No messages available.</p>
        @endforelse

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection
