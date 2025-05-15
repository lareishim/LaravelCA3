<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display all users.
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Delete a user (except self).
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted.');
    }

    /**
     * View reported content or users.
     */
    public function reports()
    {
        return view('admin.reports');
    }

    /**
     * View logs of user actions or system events.
     */
    public function logs()
    {
        return view('admin.logs');
    }

    /**
     * Show pending posts for approval.
     */
    public function pendingPosts()
    {
        $posts = Post::where('approved', false)->with(['user', 'player'])->get();
        return view('admin.pending', compact('posts'));
    }

    /**
     * Approve a submitted post.
     */
    public function approvePost(Post $post)
    {
        $post->approved = true;
        $post->save();

        return back()->with('success', 'Post approved.');
    }

    /**
     * (Optional) Legacy hook for pending content.
     */
    public function pendingContent()
    {
        return $this->pendingPosts();
    }

    /**
     * Show form to create a new site-wide announcement.
     */
    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }
}
