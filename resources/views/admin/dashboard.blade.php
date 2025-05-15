@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6 text-white">
        <h2 class="text-3xl font-bold mb-6">Welcome, Admin {{ auth()->user()->name }}</h2>
        <p class="mb-8 text-gray-400">You have full access: manage users, roles, content, and settings.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- User Management -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">User Management</h3>
                <p class="text-gray-400 mb-4">View and manage registered users.</p>
                <a href="{{ route('admin.users.index') }}" class="text-blue-400 hover:underline">View all users</a>
            </div>

            <!-- Content Approval -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Content Approval</h3>
                <p class="text-gray-400 mb-4">Review and approve pending user-submitted content.</p>
                <a href="{{ route('admin.content.pending') }}" class="text-blue-400 hover:underline">Review Pending Content</a>
            </div>

            <!-- Reports -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Reports</h3>
                <p class="text-gray-400 mb-4">Review reported users, comments, or posts.</p>
                <a href="{{ route('admin.reports') }}" class="text-blue-400 hover:underline">Go to Reports</a>
            </div>

            <!-- Activity Logs -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Activity Logs</h3>
                <p class="text-gray-400 mb-4">View login activity, user actions, and system changes.</p>
                <a href="{{ route('admin.logs') }}" class="text-blue-400 hover:underline">View Logs</a>
            </div>

            <!-- Announcements -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Send Announcement</h3>
                <p class="text-gray-400 mb-4">Broadcast news or alerts to all users.</p>
                <a href="{{ route('admin.announcements.create') }}" class="text-blue-400 hover:underline">Create Announcement</a>
            </div>
        </div>
    </div>
@endsection
