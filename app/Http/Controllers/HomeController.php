<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Service::active()->ordered()->get();
        $testimonials = Testimonial::active()->get();
        $latestPosts  = Post::published()->latest('published_at')->limit(3)->get();

        return view('home', compact('services', 'testimonials', 'latestPosts'));
    }
}
