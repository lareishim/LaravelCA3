<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Announcement;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        ActivityLogger::log(
            'Deleted user',
            'User ID: ' . $user->id . ' was deleted by admin.'
        );

        return back()->with('success', 'User deleted.');
    }

    public function storeReport(Request $request, Post $post)
    {
        DB::table('post_reports')->insert([
            'post_id'    => $post->id,
            'user_id'    => auth()->id(),
            'reason'     => $request->input('reason', 'No reason provided'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ActivityLogger::log(
            'Reported post',
            'Post ID: ' . $post->id . ' was reported with reason: ' . $request->input('reason', 'No reason provided')
        );

        return back()->with('status', 'Post reported successfully.');
    }

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

    public function logs()
    {
        $logs = \Spatie\Activitylog\Models\Activity::with('causer')->latest()->paginate(10);
        return view('admin.logs', compact('logs'));
    }

    public function clearLogs()
    {
        DB::table('activity_log')->truncate();

        ActivityLogger::log(
            'Admin cleared all activity logs.',
            'All activity logs were purged by admin ' . auth()->user()->name . '.'
        );

        return redirect()->back()->with('success', 'Activity logs cleared.');
    }

    public function pendingPosts()
    {
        $posts = Post::where('approved', false)->with(['user', 'player'])->get();
        return view('admin.pending', compact('posts'));
    }

    public function approvePost(Post $post)
    {
        $post->approved = true;
        $post->save();

        ActivityLogger::log(
            'Approved post',
            'Post ID: ' . $post->id . ' has been approved.'
        );

        return back()->with('success', 'Post approved.');
    }

    public function pendingContent()
    {
        return $this->pendingPosts();
    }

    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }

    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'is_active' => $request->has('is_active'),
            'user_id' => auth()->id(),
        ]);

        $allUsers = User::all();
        foreach ($allUsers as $user) {
            $announcement->users()->attach($user->id, [
                'seen' => false,
                'seen_at' => null,
            ]);
        }

        ActivityLogger::log(
            'Created announcement',
            'Announcement ID: ' . $announcement->id . ' was created by admin ' . auth()->user()->name
        );

        return redirect()->route('messages.index')->with('success', 'Announcement created and sent to all users.');
    }

    public function messages()
    {
        $announcements = auth()->user()->announcements()
            ->withPivot('seen', 'seen_at')
            ->orderByDesc('announcement_user.created_at')
            ->get();

        return view('messages.index', compact('announcements'));
    }

    public function showMessage(Announcement $announcement)
    {
        $user = auth()->user();

        if (! $user->seenAnnouncements->contains($announcement->id)) {
            $user->seenAnnouncements()->updateExistingPivot($announcement->id, [
                'seen' => true,
                'seen_at' => now(),
            ]);
        }

        return view('messages.show', compact('announcement'));
    }

    public function clearMessages()
    {
        auth()->user()->announcements()->detach();

        ActivityLogger::log(
            'Cleared inbox messages',
            auth()->user()->name . ' cleared all their announcements.'
        );

        return back()->with('success', 'Messages cleared.');
    }
}
