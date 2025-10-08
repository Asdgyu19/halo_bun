<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::where('status', 'published');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        // Filter by trimester
        if ($request->filled('trimester')) {
            $query->where('trimester', $request->trimester);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort videos
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_viewed':
                $query->orderBy('views_count', 'desc');
                break;
            case 'alphabetical':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $videos = $query->paginate(12);
        
        // Get unique categories for filter dropdown
        $categories = Video::where('status', 'published')
                          ->distinct()
                          ->pluck('category')
                          ->filter()
                          ->sort()
                          ->values();

        // Get popular videos (most viewed)
        $popularVideos = Video::where('status', 'published')
                            ->orderBy('views_count', 'desc')
                            ->limit(8)
                            ->get();

        return view('front.videos.index', compact('videos', 'categories', 'popularVideos'));
    }

    public function show(Video $video)
    {
        // Only show published videos
        if ($video->status !== 'published') {
            abort(404);
        }
        
        // Increment view count
        $video->increment('views_count');
        
        // Get related videos (same category or trimester)
        $relatedVideos = Video::where('id', '!=', $video->id)
            ->where('status', 'published')
            ->where(function($query) use ($video) {
                $query->where('category', $video->category);
                if ($video->trimester) {
                    $query->orWhere('trimester', $video->trimester);
                }
            })
            ->orderBy('views_count', 'desc')
            ->limit(6)
            ->get();

        return view('front.videos.show', compact('video', 'relatedVideos'));
    }
}
