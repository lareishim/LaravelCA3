@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6 text-white">
        <h2 class="text-3xl font-bold mb-6">User Management</h2>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-4 text-green-400">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-400">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto rounded shadow border border-gray-700">
            <table class="min-w-full bg-gray-800 text-sm text-left">
                <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            @if(auth()->id() !== $user->id)
                                {{-- Update Role --}}
                                <form action="{{ route('admin.users.updateRole', $user->id) }}"
                                      method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()"
                                            class="bg-gray-700 text-white rounded px-2 py-1 text-sm">
                                        <option value="fan" {{ $user->role === 'fan' ? 'selected' : '' }}>Fan</option>
                                        <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')"
                                            class="text-red-400 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-sm italic">This is you</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
