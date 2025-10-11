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
                <a href="{{ route('pregnancy-tracker.index') }}" class="mt-4 w-full py-2 px-4 bg-[var(--blue)] text-white font-semibold rounded-full hover:bg-blue-600 transition-colors inline-block text-center">Lihat Detail</a>
            </div>

           

            {{-- Section Threads Statis --}}
            <div class="p-6 rounded-3xl bg-white border border-gray-200 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-xl text-[var(--blue)]">Forum Diskusi Terbaru</h3>
                    <a href="{{ route('threads.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                </div>
                
                <div class="space-y-4">
                    {{-- Thread 1 --}}
                    <a href="{{ route('threads.index') }}" class="block p-4 rounded-xl bg-gradient-to-r from-pink-50 to-rose-50 border border-pink-100 hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                S
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 text-sm group-hover:text-pink-600 transition-colors line-clamp-1">
                                    Tips Mengatasi Morning Sickness
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    Sharing pengalaman mengatasi mual di trimester pertama...
                                </p>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <span>Sari M.</span>
                                    <span class="mx-2">•</span>
                                    <span>2 jam lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Thread 2 --}}
                    <a href="{{ route('threads.index') }}" class="block p-4 rounded-xl bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                M
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 text-sm group-hover:text-purple-600 transition-colors line-clamp-1">
                                    Rekomendasi Vitamin Ibu Hamil
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    Ada yang punya rekomendasi vitamin yang bagus untuk...
                                </p>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <span>Maya K.</span>
                                    <span class="mx-2">•</span>
                                    <span>5 jam lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Thread 3 --}}
                    <a href="{{ route('threads.index') }}" class="block p-4 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                R
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 text-sm group-hover:text-blue-600 transition-colors line-clamp-1">
                                    Persiapan Persalinan Normal
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    Mau sharing pengalaman persiapan menjelang persalinan...
                                </p>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <span>Rina P.</span>
                                    <span class="mx-2">•</span>
                                    <span>1 hari lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- CTA Button --}}
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('threads.index') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a3 3 0 01-3-3V6a3 3 0 013-3h8a2 2 0 012 2v2z"></path>
                        </svg>
                        Bergabung dalam Diskusi
                    </a>
                </div>
            </div>
        </aside>
    </div>
</div>

{{-- Custom CSS untuk line-clamp --}}
<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection

