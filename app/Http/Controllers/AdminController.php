<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Store a report submitted by a user.
     */
    public function storeReport(Request $request, Post $post)
    {
        DB::table('post_reports')->insert([
            'post_id'    => $post->id,
            'user_id'    => auth()->id(),
            'reason'     => $request->input('reason', 'No reason provided'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Post reported successfully.');
    }

    /**
     * Show reported posts to admin.
     */
    public function showReports()
    {
        $reports = DB::table('post_reports')
            ->join('users', 'post_reports.user_id', '=', 'users.id')
            ->join('posts', 'post_reports.post_id', '=', 'posts.id')
            ->select('post_reports.*', 'users.name as reporter_name', 'posts.title as post_title')
            ->orderByDesc('post_reports.created_at')
            ->get();

        return view('admin.reports', compact('reports'));
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
