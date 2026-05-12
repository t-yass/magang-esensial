<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoContent;
use Illuminate\Http\Request;

class VideoContentController extends Controller
{
    public function index()
    {
        $videos = VideoContent::orderByRaw("CASE WHEN section = 'training' THEN 0 ELSE 1 END")
            ->orderByDesc('created_at')
            ->get();
        return view('admin.video-content.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|in:training,testimonial',
            'title' => 'nullable|string|max:200',
            'url' => 'required|url|string|max:500',
            'is_visible' => 'nullable',
        ]);

        VideoContent::create([
            'section' => $request->section,
            'title' => $request->title,
            'url' => $request->url,
            'is_visible' => $request->has('is_visible'),
        ]);

        return back()->with('success', 'Video berhasil ditambahkan.');
    }

    public function destroy(VideoContent $video)
    {
        $video->delete();

        return back()->with('success', 'Video berhasil dihapus.');
    }
}
