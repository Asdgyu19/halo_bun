<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    // ✅ 1. Tampilkan semua thread
    public function index()
    {
        $threads = Thread::with(['user', 'comments', 'reactions'])
            ->latest()
            ->paginate(10);

        return view('front.threads.index', compact('threads'));
    }

    // ✅ 2. Simpan thread baru
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('ok', 'Thread berhasil ditambahkan.');
    }

    // ✅ 3. Tambahkan komentar
    public function comment(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'thread_id' => $thread->id,
            'content' => $request->content,
        ]);

        return back()->with('ok', 'Komentar berhasil ditambahkan.');
    }

    // ✅ 4. Tambahkan reaksi (like/unlike)
    public function react(Request $request, Thread $thread)
    {
        $reaction = Reaction::where('user_id', Auth::id())
            ->where('thread_id', $thread->id)
            ->first();

        if ($reaction) {
            // toggle hapus jika sudah pernah react
            $reaction->delete();
            return back()->with('ok', 'Reaksi dihapus.');
        } else {
            Reaction::create([
                'user_id' => Auth::id(),
                'thread_id' => $thread->id,
                'type' => 'like', // default like
            ]);
            return back()->with('ok', 'Thread disukai.');
        }
    }
}
