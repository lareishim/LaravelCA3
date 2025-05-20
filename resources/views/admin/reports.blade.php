@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Post Reports</h1>

        @forelse ($reports as $report)
            <div class="bg-gray-800 p-4 rounded mb-4">
                <p><strong>Reported Post:</strong> <a href="{{ route('posts.show', $report->post->id) }}" class="underline text-blue-400">{{ $report->post->title }}</a></p>
                <p><strong>Reported by:</strong> {{ $report->user->name }} ({{ $report->user->email }})</p>
                <p><strong>Reason:</strong> {{ $report->reason }}</p>
                <p><small class="text-gray-400">Reported on {{ $report->created_at->format('M d, Y H:i') }}</small></p>
            </div>
        @empty
            <p class="text-gray-400">No reports yet.</p>
        @endforelse
    </div>
@endsection
