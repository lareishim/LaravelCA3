@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Welcome, {{ auth()->user()->name }} 👋</h1>
    <p>Here’s your personalized feed of players, highlights, and music picks.</p>
    <div class="mt-6">
        <h2 class="text-xl">Your Liked Players</h2>
        <!-- Show liked player cards here -->
    </div>
@endsection
