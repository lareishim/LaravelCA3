@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Pending Posts</h1>

        @if($posts->isEmpty())
            <p class="text-gray-400">There are no pending posts right now.</p>
        @else
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="p-4 bg-gray-800 rounded shadow">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                        <p class="text-gray-300 mt-2">{{ $post->content }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            By {{ $post->user->name }}
                            @if($post->player)
                                · Related to: {{ $post->player->name }}
                            @endif
                        </p>
                        <form method="POST" action="{{ route('admin.posts.approve', $post->id) }}" class="mt-3">
                            @csrf
                            @method('PATCH')
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-sm">
                                Approve
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
