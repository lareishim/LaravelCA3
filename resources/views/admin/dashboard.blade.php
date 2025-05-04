@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Welcome, Admin {{ auth()->user()->name }}</h1>
    <p>You have full access: manage users, roles, and approve content.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">User Management</h2>
            <a href="{{ url('/admin/users') }}" class="text-blue-400 underline">View all users</a>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">Content Approval</h2>
            <a href="{{ url('/admin/approvals') }}" class="text-blue-400 underline">Review Pending Content</a>
        </div>
    </div>
@endsection
