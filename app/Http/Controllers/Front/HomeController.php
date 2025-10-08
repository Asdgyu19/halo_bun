<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::latest()->take(5)->get();
        $latestVideos = Video::latest()->take(3)->get();

        return view('front.home', compact('latestArticles', 'latestVideos'));
    }
}
