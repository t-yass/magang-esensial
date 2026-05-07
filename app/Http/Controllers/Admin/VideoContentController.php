<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoContentController extends Controller
{
    public function index()
    {
        $videos = VideoContent::orderBy('section')->orderBy('sort_order')->get();
        return view('admin.video-content.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|in:training,testimonial',
            'source_type' => 'required|in:link,upload',
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'url' => 'nullable|required_if:source_type,link|string|max:500',
            'file' => 'nullable|required_if:source_type,upload|file|mimes:mp4,webm,ogv|max:51200',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $filePath = null;
        if ($request->source_type === 'upload' && $request->hasFile('file')) {
            $filePath = $request->file('file')->store('video-contents', 'public');
        }

        VideoContent::create([
            'section' => $request->section,
            'source_type' => $request->source_type,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->source_type === 'link' ? $request->url : null,
            'file_path' => $filePath,
            'sort_order' => $request->input('sort_order', 0),
            'is_visible' => $request->has('is_visible'),
        ]);

        return back()->with('success', 'Video berhasil ditambahkan.');
    }

    public function update(Request $request, VideoContent $video)
    {
        $request->validate([
            'section' => 'required|in:training,testimonial',
            'source_type' => 'required|in:link,upload',
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'url' => 'nullable|required_if:source_type,link|string|max:500',
            'file' => 'nullable|file|mimes:mp4,webm,ogv|max:51200',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $filePath = $video->file_path;
        if ($request->source_type === 'upload' && $request->hasFile('file')) {
            Storage::disk('public')->delete($video->file_path);
            $filePath = $request->file('file')->store('video-contents', 'public');
        }

        $video->update([
            'section' => $request->section,
            'source_type' => $request->source_type,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->source_type === 'link' ? $request->url : null,
            'file_path' => $filePath,
            'sort_order' => $request->input('sort_order', 0),
            'is_visible' => $request->has('is_visible'),
        ]);

        return back()->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(VideoContent $video)
    {
        Storage::disk('public')->delete($video->file_path);
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus.');
    }
}
