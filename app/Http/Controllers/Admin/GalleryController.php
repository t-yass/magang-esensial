<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderBy('sort_order')->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'nullable|string|max:200',
            'category' => 'required|string|max:100',
            'file'     => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:20480',
        ]);

        $file     = $request->file('file');
        $mimeType = $file->getMimeType();
        $type     = str_starts_with($mimeType, 'video/') ? 'video' : 'image';
        $path     = $file->store('gallery', 'public');

        Gallery::create([
            'title'      => $request->title,
            'file_path'  => $path,
            'type'       => $type,
            'category'   => $request->category,
            'sort_order' => Gallery::max('sort_order') + 1,
            'is_visible' => true,
        ]);

        return back()->with('success', 'Media berhasil diupload!');
    }

    public function destroy(Gallery $gallery)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->file_path);
        $gallery->delete();
        return back()->with('success', 'Media berhasil dihapus.');
    }
}