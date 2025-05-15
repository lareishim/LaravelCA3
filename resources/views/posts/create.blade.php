@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-4">Create a Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Title -->
            <div>
                <label class="block mb-1 font-semibold">Title</label>
                <input type="text" name="title" class="w-full bg-gray-800 rounded p-2 text-white" required>
            </div>

            <!-- Player (optional) -->
            <div>
                <label class="block mb-1 font-semibold">Related Player (optional)</label>
                <select name="player_id" class="w-full bg-gray-800 rounded p-2 text-white">
                    <option value="">-- None --</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Content -->
            <div>
                <label class="block mb-1 font-semibold">Content</label>
                <textarea name="content" class="w-full bg-gray-800 rounded p-2 text-white" rows="6" required></textarea>
            </div>

            <!-- Submit -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">
                Submit Post
            </button>
        </form>
    </div>
@endsection
