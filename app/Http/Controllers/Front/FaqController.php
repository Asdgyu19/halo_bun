<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::where('status', 'published');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'LIKE', "%{$search}%")
                  ->orWhere('answer', 'LIKE', "%{$search}%")
                  ->orWhere('tags', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort FAQs
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_liked':
                $query->orderBy('likes', 'desc');
                break;
            case 'alphabetical':
                $query->orderBy('question', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $faqs = $query->paginate(12);
        
        // Get categories for filter
        $categories = Faq::where('status', 'published')
                         ->distinct()
                         ->pluck('category')
                         ->filter()
                         ->sort()
                         ->values();

        // Get popular FAQs (most viewed)
        $popularFaqs = Faq::where('status', 'published')
                         ->orderBy('views_count', 'desc')
                         ->limit(6)
                         ->get();

        return view('front.faqs.index', compact('faqs', 'categories', 'popularFaqs'));
    }

    public function show(Faq $faq)
    {
        // Only show published FAQs
        if ($faq->status !== 'published') {
            abort(404);
        }

        // Increment view count
        $faq->increment('view_count');
        
        // Get related FAQs (same category)
        $relatedFaqs = Faq::where('status', 'published')
            ->where('id', '!=', $faq->id)
            ->where('category', $faq->category)
            ->limit(5)
            ->get();

        return view('front.faqs.show', compact('faq', 'relatedFaqs'));
    }
}
