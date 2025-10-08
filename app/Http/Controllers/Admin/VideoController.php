<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('user')->latest()->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'video_type' => 'required|in:youtube,tiktok,vimeo',
            'thumbnail' => 'nullable|image|max:2048',
            'trimester' => 'nullable|in:1,2,3',
            'category' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'is_featured' => 'boolean'
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('video-thumbnails', 'public');
        }

        Video::create($data);
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'video_type' => 'required|in:youtube,tiktok,vimeo',
            'thumbnail' => 'nullable|image|max:2048',
            'trimester' => 'nullable|in:1,2,3',
            'category' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'is_featured' => 'boolean'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('video-thumbnails', 'public');
        }

        $video->update($data);
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        // Hapus thumbnail jika ada
        if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus.');
    }
}
