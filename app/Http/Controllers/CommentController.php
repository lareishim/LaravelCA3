<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment for a given post.
     */
    public function store(Request $request, Post $post)
    {
        // Restrict commenting to users with role 'fan'
        if (auth()->user()->role !== 'fan') {
            return back()->with('error', 'Only fans can comment on posts.');
        }

        // Validate comment content
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Create the comment linked to the post and the authenticated user
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment added!');
    }
}
