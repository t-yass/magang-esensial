<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;

class PublicBlogController extends Controller
{
    public function index()
    {
        $s = SiteSetting::all_settings();
        $posts = BlogPost::published()->get();

        return view('blog.index', compact('s', 'posts'));
    }

    public function show(string $slug)
    {
        $s = SiteSetting::all_settings();
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $relatedPosts = BlogPost::published()->where('id', '!=', $post->id)->latest()->limit(3)->get();

        return view('blog.show', compact('s', 'post', 'relatedPosts'));
    }
}
