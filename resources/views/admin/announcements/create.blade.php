@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Create Announcement</h1>

        @if(session('success'))
            <div class="mb-4 text-green-400 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-600 p-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.announcements.store') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="block mb-1 font-semibold">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full p-2 rounded text-black"
                >
            </div>

            <div class="mb-4">
                <label for="content" class="block mb-1 font-semibold">Content</label>
                <textarea
                    name="content"
                    id="content"
                    rows="6"
                    required
                    class="w-full p-2 rounded text-black"
                >{{ old('content') }}</textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded"
            >
                Create Announcement
            </button>
        </form>
    </div>
@endsection
