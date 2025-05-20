@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-4">All Posts</h1>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($posts as $post)
            <div class="mb-8 p-4 bg-gray-800 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                <p class="text-gray-300 mt-2">{{ $post->content }}</p>
                <p class="text-gray-400 text-sm mt-1">
                    Posted by {{ $post->user->name ?? 'Unknown' }}
                    @if($post->player)
                        about {{ $post->player->name }}
                    @endif
                    on {{ $post->created_at->format('M d, Y') }}
                </p>

                {{-- Comments --}}
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Comments ({{ $post->comments->count() }})</h3>

                    @if ($post->comments->isEmpty())
                        <p class="text-gray-400 text-sm">No comments yet.</p>
                    @else
                        <ul>
                            @foreach ($post->comments as $comment)
                                <li class="border-t border-gray-700 py-2">
                                    <p class="text-gray-300"><strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>:</p>
                                    <p class="text-gray-400">{{ $comment->content }}</p>
                                    <p class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Comment Form for Fans --}}
                @auth
                    @if(auth()->user()->role === 'fan')
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="content" required placeholder="Add a comment..." class="w-full p-2 rounded bg-gray-700 text-white"></textarea>
                            @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                Submit Comment
                            </button>
                        </form>
                    @endif
                @endauth

                {{-- Report Form --}}
                @auth
                    @if(auth()->id() !== $post->user_id)
                        <form action="{{ route('posts.report', $post->id) }}" method="POST" class="mt-6">
                            @csrf
                            <label for="reason-{{ $post->id }}" class="text-sm text-gray-300 block mb-1">Report this post:</label>
                            <textarea name="reason" id="reason-{{ $post->id }}" required class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Reason for reporting..."></textarea>
                            <button type="submit" class="mt-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                Submit Report
                            </button>
                        </form>
                    @endif
                @endauth

            </div>
        @empty
            <p class="text-gray-400">No posts found.</p>
        @endforelse
    </div>
@endsection
