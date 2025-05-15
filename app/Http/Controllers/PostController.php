<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  // Add this import

class PostController extends Controller
{
    use AuthorizesRequests;  // Add this trait

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

    /**
     * Display a listing of the user's own posts.
     */
    public function myPosts()
    {
        $posts = auth()->user()->posts()->with('player')->latest()->get();
        return view('posts.mine', compact('posts'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $players = Player::all();
        return view('posts.edit', compact('post', 'players'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'player_id' => 'nullable|exists:players,id',
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'player_id' => $validated['player_id'],
            'approved' => false, // mark as unapproved after edit
        ]);

        return redirect()->route('posts.mine')->with('success', 'Post updated and sent for re-approval.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.mine')->with('success', 'Post deleted.');
    }
}
