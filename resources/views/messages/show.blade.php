@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10 text-white">
        <h1 class="text-3xl font-bold mb-6">{{ $announcement->title }}</h1>
        <p class="text-sm text-gray-400 mb-4">Posted on {{ $announcement->created_at->format('M d, Y') }}</p>
        <div class="bg-gray-800 p-4 rounded text-lg leading-relaxed">
            {{ $announcement->content }}
        </div>
        <div class="mt-6">
            <a href="{{ route('messages.index') }}" class="text-blue-500 hover:underline">← Back to messages</a>
        </div>
    </div>
@endsection
