<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'programs'     => Program::count(),
            'posts'        => BlogPost::count(),
            'unpublished'  => BlogPost::whereNull('published_at')->count(),
            'partners'     => Partner::count(),
            'galleries'    => Gallery::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}