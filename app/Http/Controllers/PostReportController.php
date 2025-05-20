<?php

use App\Models\Post;
use App\Models\PostReport;
use Illuminate\Http\Request;

class PostReportController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        PostReport::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Report submitted.');
    }

    public function index()
    {
        $reports = PostReport::with('post', 'user')->latest()->get();
        return view('admin.reports', compact('reports'));
    }
}

