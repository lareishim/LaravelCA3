<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

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
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        // Log the comment creation
        ActivityLogger::log('comment.create', 'Commented on post ID: ' . $post->id . ', comment ID: ' . $comment->id);

        return back()->with('success', 'Comment added!');
    }
}
