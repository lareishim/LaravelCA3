@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Welcome, {{ auth()->user()->name }} (Editor)</h1>
    <p>You can edit player profiles, update stats, and manage song links.</p>

    <div class="mt-6">
        <h2 class="text-xl mb-2">Quick Access</h2>
        <ul class="list-disc ml-6 space-y-2">
            <li><a href="{{ url('/players') }}" class="text-blue-400 underline">Edit Players</a></li>
            <li><a href="{{ url('/teams') }}" class="text-blue-400 underline">Manage Teams</a></li>
            <li><a href="{{ url('/dashboard') }}" class="text-blue-400 underline">View Dashboard</a></li>
        </ul>
    </div>
@endsection
