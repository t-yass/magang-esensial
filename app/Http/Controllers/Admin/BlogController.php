<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:300',
            'category'  => 'required|string|max:100',
            'excerpt'   => 'nullable|string',
            'content'   => 'nullable|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blog', 'public');
        }

        BlogPost::create([
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'category'       => $request->category,
            'excerpt'        => $request->excerpt,
            'content'        => $request->content,
            'thumbnail_path' => $thumbnailPath,
            'status'         => $request->status,
            'published_at'   => $request->status === 'published' ? now() : null,
        ]);

        return back()->with('success', 'Artikel berhasil disimpan!');
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title'     => 'required|string|max:300',
            'category'  => 'required|string|max:100',
            'excerpt'   => 'nullable|string',
            'content'   => 'nullable|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = [
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'category'     => $request->category,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' && !$post->published_at ? now() : $post->published_at,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('blog', 'public');
        }

        $post->update($data);

        return back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}