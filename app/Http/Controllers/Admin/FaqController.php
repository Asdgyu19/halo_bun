<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $q = Faq::with('user');

        // Search functionality
        if ($request->search) {
            $q->where('question', 'like', '%' . $request->search . '%')
              ->orWhere('answer', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->category) {
            $q->where('category', $request->category);
        }

        // Filter by status
        if ($request->status) {
            $q->where('status', $request->status);
        }

        $faqs = $q->latest()->paginate(10);
        
        // Get statistics
        $stats = [
            'total' => Faq::count(),
            'published' => Faq::where('status', 'published')->count(),
            'draft' => Faq::where('status', 'draft')->count(),
            'featured' => Faq::where('is_featured', true)->count(),
        ];
        
        // Get categories for filter dropdown
        $categories = Faq::distinct()->pluck('category')->filter();

        return view('admin.faqs.index', compact('faqs', 'stats', 'categories'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'order_position' => 'nullable|integer|min:1',
            'view_count' => 'nullable|integer|min:0',
            'like_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean'
        ]);

        $data['user_id'] = Auth::id();

        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'order_position' => 'nullable|integer|min:1',
            'view_count' => 'nullable|integer|min:0',
            'like_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean'
        ]);

        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus.');
    }
}
