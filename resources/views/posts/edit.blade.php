@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block mb-1 font-semibold">Title</label>
                <input
                    type="text"
                    name="title"
                    class="w-full bg-gray-800 rounded p-2 text-white"
                    value="{{ old('title', $post->title) }}"
                    required
                >
                @error('title')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Player (optional) -->
            <div>
                <label class="block mb-1 font-semibold">Related Player (optional)</label>
                <select name="player_id" class="w-full bg-gray-800 rounded p-2 text-white">
                    <option value="">-- None --</option>
                    @foreach($players as $player)
                        <option
                            value="{{ $player->id }}"
                            {{ old('player_id', $post->player_id) == $player->id ? 'selected' : '' }}
                        >
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
                @error('player_id')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block mb-1 font-semibold">Content</label>
                <textarea
                    name="content"
                    rows="6"
                    class="w-full bg-gray-800 rounded p-2 text-white"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded"
            >
                Update Post
            </button>
        </form>
    </div>
@endsection
