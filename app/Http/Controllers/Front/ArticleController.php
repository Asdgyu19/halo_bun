<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->byTrimester($request->trimester)
            ->search($request->search)
            ->when($request->category, function($query) use ($request) {
                return $query->where('category', $request->category);
            })
            ->latest()
            ->paginate(9);

        // Get available categories for filter
        $categories = Article::distinct()->pluck('category')->filter();
        
        return view('front.articles.index', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        return view('front.articles.show', compact('article'));
    }
}
