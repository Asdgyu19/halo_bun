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
        // Ambil data real dari database
        $threadsFromDB = Thread::with(['user'])
            ->latest()
            ->get();

        // Jika ada data dari database, gunakan itu. Jika tidak, gunakan dummy
        if ($threadsFromDB->count() > 0) {
            $threads = $threadsFromDB->map(function($thread) {
                return [
                    'id' => $thread->id,
                    'title' => $thread->title ?? 'Thread tanpa judul',
                    'user_name' => $thread->user->name ?? 'Anonymous',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($thread->user->name ?? 'Anonymous') . '&background=3b82f6&color=ffffff',
                    'content' => $thread->content,
                    'created_at' => $thread->created_at->diffForHumans(),
                    'comments_count' => $thread->comments()->count(),
                    'likes_count' => $thread->reactions()->count(),
                    'is_liked' => Auth::check() ? $thread->reactions()->where('user_id', Auth::id())->exists() : false,
                ];
            })->toArray();
        } else {
            // Data dummy threads untuk demo jika database kosong
            $threads = [
                [
                    'id' => 1,
                    'title' => 'Tips Mengatasi Anxiety Sebelum Persalinan',
                    'user_name' => 'Sari Melati',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=Sari+Melati&background=ec4899&color=ffffff',
                    'content' => 'Hai Bunda-bunda! Mau sharing nih, aku lagi hamil 8 bulan dan mulai deg-degan menjelang persalinan. Ada tips buat mengatasi anxiety sebelum melahirkan? 🤱',
                    'created_at' => '2 jam yang lalu',
                    'comments_count' => 15,
                    'likes_count' => 23,
                    'is_liked' => false,
                ],
                [
                    'id' => 2,
                    'title' => 'Pengalaman Senam Hamil dan Yoga Prenatal',
                    'user_name' => 'Maya Sari',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=Maya+Sari&background=8b5cf6&color=ffffff',
                    'content' => 'Sharing pengalaman nih bun, selama hamil aku rutin senam hamil dan yoga prenatal. Rasanya badan lebih fit dan pikiran jadi lebih tenang. Recommended banget! 🧘‍♀️✨',
                    'created_at' => '5 jam yang lalu',
                    'comments_count' => 8,
                    'likes_count' => 31,
                    'is_liked' => true,
                ],
                [
                    'id' => 3,
                    'title' => 'Rekomendasi Dokter Kandungan Jakarta Selatan',
                    'user_name' => 'Rina Putri',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=Rina+Putri&background=06b6d4&color=ffffff',
                    'content' => 'Bunda-bunda, ada yang punya rekomendasi dokter kandungan yang bagus di area Jakarta Selatan? Butuh second opinion nih untuk kondisi kehamilanku. Thanks! 🏥',
                    'created_at' => '1 hari yang lalu',
                    'comments_count' => 12,
                    'likes_count' => 7,
                    'is_liked' => false,
                ],
                [
                    'id' => 4,
                    'title' => 'Alhamdulillah Baby Lahir Sehat! 💕',
                    'user_name' => 'Dewi Lestari',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=Dewi+Lestari&background=f59e0b&color=ffffff',
                    'content' => 'Alhamdulillah, baby ku lahir sehat! Proses persalinan 8 jam, normal tanpa jahitan. Buat bunda-bunda yang lagi deg-degan, semua akan baik-baik saja kok! 💕👶',
                    'created_at' => '2 hari yang lalu',
                    'comments_count' => 45,
                    'likes_count' => 89,
                    'is_liked' => true,
                ],
                [
                    'id' => 5,
                    'title' => 'Morning Sickness Parah di Trimester Pertama',
                    'user_name' => 'Lisa Anggraini',
                    'user_avatar' => 'https://ui-avatars.com/api/?name=Lisa+Anggraini&background=ef4444&color=ffffff',
                    'content' => 'Morning sickness parah banget nih bun, udah 12 minggu tapi masih sering mual muntah. Ada yang mengalami hal serupa? Gimana cara mengatasinya? 🤢',
                    'created_at' => '3 hari yang lalu',
                    'comments_count' => 18,
                    'likes_count' => 14,
                    'is_liked' => false,
                ]
            ];
        }

        return view('threads.index', compact('threads'));
    }

    // ✅ Show single thread with comments
    public function show($id)
    {
        // Ambil data real thread dari database
        $thread = Thread::with(['user', 'comments.user', 'reactions'])
            ->findOrFail($id);

        // Format data thread untuk view
        $threadData = [
            'id' => $thread->id,
            'title' => $thread->title,
            'user_name' => $thread->user->name,
            'user_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($thread->user->name) . '&background=3b82f6&color=ffffff',
            'content' => $thread->content,
            'created_at' => $thread->created_at->diffForHumans(),
            'comments_count' => $thread->comments->count(),
            'likes_count' => $thread->reactions->count(),
            'is_liked' => Auth::check() ? $thread->reactions()->where('user_id', Auth::id())->exists() : false,
        ];

        // Format data comments untuk view
        $comments = $thread->comments->map(function($comment) {
            return [
                'id' => $comment->id,
                'user_name' => $comment->user->name,
                'user_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=3b82f6&color=ffffff',
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
            ];
        });

        return view('threads.show', compact('threadData', 'comments'));
    }

    // ✅ Create new thread form
    public function create()
    {
        return view('threads.create');
    }

    // ✅ 2. Simpan thread baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('threads.index')->with('success', 'Thread berhasil ditambahkan dan muncul di diskusi terbaru!');
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
