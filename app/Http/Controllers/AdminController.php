<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // In a real app, you’d fetch reports from a reports table
        return view('admin.reports');
    }

    /**
     * View logs of user actions or system events.
     */
    public function logs()
    {
        // You could load logs from database or a log file
        return view('admin.logs');
    }

    /**
     * Show pending content for approval.
     */
    public function pendingContent()
    {
        // Retrieve pending posts or submissions
        return view('admin.pending');
    }

    /**
     * Show form to create a new site-wide announcement.
     */
    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }
}
