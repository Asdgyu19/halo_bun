@extends('layouts.app')
@section('content')

<!-- Hero Section - Full Width & Full Height (1 page) -->
<div class="hero-fullwidth relative w-full overflow-hidden" style="height: calc(100vh + 20px); margin-top: -60px;">
    <img src="{{ asset('images/Hamil.jpg') }}" 
         alt="Ibu hamil dan bayi" 
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-center px-4" style="padding-top: 60px;">
        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg mb-6">
            Perjalanan Menjadi Bunda Hebat
        </h1>
        <p class="mt-4 text-lg md:text-2xl font-light max-w-4xl mx-auto text-white drop-shadow-lg leading-relaxed">
            Temukan semua yang Anda butuhkan, dari tips kehamilan, video informatif, hingga forum untuk berbagi cerita.
        </p>
        
        <!-- Optional: Add CTA buttons -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4">
            <a href="/articles" class="bg-[var(--blue)] text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 transition-colors">
                Baca Artikel
            </a>
            <a href="/videos" class="bg-white text-[var(--blue)] px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                Tonton Video
            </a>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="container mx-auto px-4 mt-8">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-8">
            <div class="p-6 rounded-3xl bg-white border border-gray-200 shadow-md">
                <h2 class="text-2xl font-bold text-[var(--blue)] mb-4">Info Terbaru</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestArticles as $a)
                        <a href="{{ route('articles.show', $a->slug) }}" class="block group">
                            <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                                <img src="{{ $a->thumbnail_url }}" alt="{{ $a->title }}" class="w-full h-40 object-cover rounded-t-2xl">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-[var(--blue)] group-hover:text-blue-600 transition-colors duration-300">{{ $a->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit($a->excerpt, 80) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-gray-200 shadow-md">
                <h2 class="text-2xl font-bold text-[var(--blue)] mb-4">Video Terbaru</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($latestVideos as $v)
                        <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-md">
                            <iframe class="w-full h-full" src="{{ $v->embed_url }}" allowfullscreen></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <aside class="space-y-8">
            <div class="p-6 rounded-3xl bg-amber-50/50 shadow-md border border-amber-200">
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ asset('images/2102727.png') }}" alt="Ikon Bayi" class="w-10 h-10 text-amber-500">
                    <h3 class="font-bold text-xl text-[var(--blue)]">Tips Kehamilan Mingguan</h3>
                </div>
                <p class="text-base text-gray-700 mt-2">Pantau perkembangan janin & cek nutrisi sesuai trimester.</p>
                <button class="mt-4 w-full py-2 px-4 bg-[var(--blue)] text-white font-semibold rounded-full hover:bg-blue-600 transition-colors">Lihat Detail</button>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-gray-200 shadow-md">
                <h3 class="font-bold text-xl text-[var(--blue)] mb-4">Navigasi</h3>
                <ul class="space-y-3">
                    <li>
                        <a class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors" href="/articles">
                            <img src="{{ asset('images/Artikel.png') }}" alt="Ikon Article" class="w-10 h-10 text-blue-500">
                            <span class="font-medium text-blue-700">Artikel</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors" href="/videos">
                            <img src="{{ asset('images/Video.png') }}" class="w-10 h-10 text-blue-500">
                            <span class="font-medium text-blue-700">Video</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors" href="/facilities">
                            <img src="{{ asset('images/Faskes.png') }}" class="w-10 h-10 text-blue-500">
                            <span class="font-medium text-blue-700">Faskes Terdekat</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors" href="/faq">
                            <img src="{{ asset('images/FAQ.png') }}" class="w-10 h-10 text-blue-500">
                            <span class="font-medium text-blue-700">FAQ</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors" href="/threads">
                            <img src="{{ asset('images/Forum.png') }}" class="w-10 h-10 text-blue-500">
                            <span class="font-medium text-blue-700">Forum Bunda</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection

