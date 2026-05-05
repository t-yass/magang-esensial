<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Program;
use App\Models\SiteSetting;

class WelcomeController extends Controller
{
    public function index()
{
    $s        = SiteSetting::all_settings();
    $programs = Program::active()->get();
    $partners = Partner::visible()->get();
    $posts    = BlogPost::published()->limit(3)->get();
    $gallery  = Gallery::visible()->get();
    $certs    = Certification::visible()->get();

    return view('welcome', compact(
        's', 'programs', 'partners', 'posts', 'gallery', 'certs'
    ));
}
}