@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10 px-6 bg-gray-900 rounded-lg shadow-md text-white">
        <h1 class="text-3xl font-bold mb-8 border-b border-gray-700 pb-2">📢 Create Announcement</h1>

        @if ($errors->any())
            <div class="mb-6 bg-red-800 text-white p-4 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-200">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    class="mt-1 block w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-200">Content</label>
                <textarea
                    name="content"
                    id="content"
                    rows="6"
                    required
                    class="mt-1 block w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ old('content') }}</textarea>
            </div>

            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="is_active"
                    id="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded"
                >
                <label for="is_active" class="ml-2 block text-sm text-gray-300">Active</label>
            </div>

            <div>
                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow transition duration-200"
                >
                    ➕ Create Announcement
                </button>
            </div>
        </form>
    </div>
@endsection
