<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $threads = Thread::with(['user', 'comments', 'reactions'])
            ->when($search, function($query, $search) {
                return $query->where('content', 'like', "%{$search}%")
                           ->orWhere('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // Dummy data untuk sementara
        $dummyThreads = collect([
            [
                'id' => 1,
                'user_name' => 'Sari Melati',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Sari+Melati&color=7F9CF5&background=EBF4FF',
                'title' => 'Tips mengatasi morning sickness',
                'content' => 'Halo Bunda! Aku mau share tips yang berhasil banget buat aku mengatasi morning sickness di trimester pertama. Pertama, makan sedikit tapi sering. Kedua, minum air jahe hangat. Ketiga, hindari makanan berminyak. Semoga membantu ya Bun! 💕',
                'created_at' => '2 jam yang lalu',
                'likes_count' => 24,
                'comments_count' => 8,
                'tags' => ['#morningsickness', '#trimester1', '#tips']
            ],
            [
                'id' => 2,
                'user_name' => 'Rina Indah',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Rina+Indah&color=F093FB&background=FCEDF0',
                'title' => 'Pergerakan bayi di usia 20 minggu',
                'content' => 'Bunda-bunda, aku udah 20 minggu nih dan mulai kerasa gerakan si dedek! Rasanya seperti ada kupu-kupu di perut 🦋 Seneng banget! Ada yang udah ngerasa juga ga di usia segini?',
                'created_at' => '4 jam yang lalu',
                'likes_count' => 31,
                'comments_count' => 12,
                'tags' => ['#20minggu', '#gerakanbayi', '#hamil']
            ],
            [
                'id' => 3,
                'user_name' => 'Lisa Putri',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Lisa+Putri&color=68D391&background=F0FFF4',
                'title' => 'Rekomendasi bantal hamil yang nyaman',
                'content' => 'Hai Moms! Lagi cari bantal hamil yang bagus nih. Udah coba beberapa merk tapi belum nemu yang pas. Ada yang punya rekomendasi ga? Budget sekitar 200-500k. Makasih before! 🤗',
                'created_at' => '6 jam yang lalu',
                'likes_count' => 15,
                'comments_count' => 20,
                'tags' => ['#bantalhamil', '#rekomendasi', '#nyaman']
            ],
            [
                'id' => 4,
                'user_name' => 'Maya Sari',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Maya+Sari&color=FBD38D&background=FFFBF0',
                'title' => 'Baby shower planning - need ideas!',
                'content' => 'Mau bikin baby shower simple tapi memorable. Tema yang lagi in sekarang apa ya? Dan budget yang reasonable berapa kira-kira? Share dong pengalaman kalian! 👶✨',
                'created_at' => '8 jam yang lalu',
                'likes_count' => 22,
                'comments_count' => 16,
                'tags' => ['#babyshower', '#planning', '#ideas']
            ],
            [
                'id' => 5,
                'user_name' => 'Dina Kartika',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Dina+Kartika&color=FC8181&background=FFF5F5',
                'title' => 'Kontraksi palsu vs kontraksi asli',
                'content' => 'Bun, aku hamil 35 minggu dan sering ngerasain kontraksi. Tapi bingung ini kontraksi palsu atau asli. Gimana cara bedainnya ya? Agak worry nih sebagai FTM (first time mom) 😰',
                'created_at' => '12 jam yang lalu',
                'likes_count' => 28,
                'comments_count' => 25,
                'tags' => ['#kontraksi', '#35minggu', '#ftm']
            ],
            [
                'id' => 6,
                'user_name' => 'Indri Lestari',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Indri+Lestari&color=9F7AEA&background=FAF5FF',
                'title' => 'Yoga prenatal - worth it ga sih?',
                'content' => 'Ada yang udah coba yoga prenatal? Katanya bagus buat persiapan persalinan dan ngurangin stress. Tapi harganya lumayan mahal 😅 Worth it ga sih menurut kalian?',
                'created_at' => '1 hari yang lalu',
                'likes_count' => 19,
                'comments_count' => 14,
                'tags' => ['#yogaprenatal', '#exercise', '#persalinan']
            ]
        ]);

        return view('threads.index', compact('dummyThreads'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk membuat thread');
        }
        
        return view('threads.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk membuat thread');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:1000',
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('threads.index')->with('success', 'Thread berhasil dibuat!');
    }

    public function show($id)
    {
        // Dummy data untuk detail thread
        $thread = [
            'id' => $id,
            'user_name' => 'Sari Melati',
            'user_avatar' => 'https://ui-avatars.com/api/?name=Sari+Melati&color=7F9CF5&background=EBF4FF',
            'title' => 'Tips mengatasi morning sickness',
            'content' => 'Halo Bunda! Aku mau share tips yang berhasil banget buat aku mengatasi morning sickness di trimester pertama. Pertama, makan sedikit tapi sering. Kedua, minum air jahe hangat. Ketiga, hindari makanan berminyak. Semoga membantu ya Bun! 💕',
            'created_at' => '2 jam yang lalu',
            'likes_count' => 24,
            'comments_count' => 8,
            'tags' => ['#morningsickness', '#trimester1', '#tips']
        ];

        $comments = collect([
            [
                'id' => 1,
                'user_name' => 'Rina Indah',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Rina+Indah&color=F093FB&background=FCEDF0',
                'content' => 'Makasih Bun! Tips yang sangat membantu 😊',
                'created_at' => '1 jam yang lalu'
            ],
            [
                'id' => 2,
                'user_name' => 'Lisa Putri',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Lisa+Putri&color=68D391&background=F0FFF4',
                'content' => 'Aku juga pakai air jahe, emang works banget!',
                'created_at' => '30 menit yang lalu'
            ]
        ]);

        return view('threads.show', compact('thread', 'comments'));
    }
}
