@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-3xl font-bold mb-6">Messages</h1>

        @if(session('success'))
            <div class="mb-4 bg-green-600 text-white px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($announcements->isEmpty())
            <p class="text-gray-400">No messages found.</p>
        @else
            <form action="{{ route('messages.clear') }}" method="POST" class="mb-4 text-right">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                    Clear Messages
                </button>
            </form>

            <div class="space-y-4">
                @foreach($announcements as $announcement)
                    @php
                        $isSeen = $announcement->pivot->seen ?? false;
                    @endphp

                    <a href="{{ route('messages.show', $announcement->id) }}"
                       class="block p-4 rounded-lg shadow-md transition hover:bg-gray-800
                   {{ $isSeen ? 'bg-gray-900 border border-gray-700' : 'bg-gray-900 border-l-4 border-red-500' }}">

                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <h2 class="text-lg font-bold">
                                    {{ $announcement->title }}
                                </h2>
                                @unless($isSeen)
                                    <span class="w-3 h-3 bg-red-600 rounded-full inline-block" title="Unread"></span>
                                @endunless
                            </div>
                            <small class="text-gray-500">
                                {{ $announcement->created_at->diffForHumans() }}
                            </small>
                        </div>

                        <p class="mt-2 text-gray-300">
                            {{ \Illuminate\Support\Str::limit($announcement->content, 120) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
