<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Player;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show all approved posts.
     */
    public function index()
    {
        $posts = Post::where('approved', true)->with(['user', 'player'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form to create a post.
     */
    public function create()
    {
        $players = Player::all();
        return view('posts.create', compact('players'));
    }

    /**
     * Store a newly submitted post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'player_id' => 'nullable|exists:players,id',
        ]);

        auth()->user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'player_id' => $validated['player_id'] ?? null,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post submitted for review!');
    }
}
