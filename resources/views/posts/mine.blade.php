@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">My Posts</h1>

        @if(session('success'))
            <div class="mb-4 text-green-400">{{ session('success') }}</div>
        @endif

        @if($posts->isEmpty())
            <p class="text-gray-400">You haven’t posted anything yet.</p>
        @else
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="p-4 bg-gray-800 rounded shadow">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                            <span class="text-sm px-2 py-1 rounded
                            {{ $post->approved ? 'bg-green-700 text-green-200' : 'bg-yellow-700 text-yellow-200' }}">
                            {{ $post->approved ? 'Approved' : 'Pending' }}
                        </span>
                        </div>
                        <p class="text-gray-300 mt-2">{{ $post->content }}</p>
                        @if($post->player)
                            <p class="text-sm text-gray-400 mt-1">Related to: {{ $post->player->name }}</p>
                        @endif

                        <div class="mt-3 flex space-x-3">
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-400 hover:underline text-sm">Edit</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
