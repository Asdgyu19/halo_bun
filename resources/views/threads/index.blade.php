@extends('layouts.app')

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="hero-fullwidth bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100 pt-24 pb-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a3 3 0 01-3-3V6a3 3 0 013-3h8a2 2 0 012 2v2z"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-4">
                Forum Bunda
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Komunitas hangat untuk berbagi pengalaman, tips, dan dukungan selama perjalanan kehamilan Anda
            </p>
            <div class="flex items-center justify-center mt-6 space-x-8 text-sm text-gray-500">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    500+ Ibu Hamil
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    1000+ Diskusi
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Saling Mendukung
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-gray-50 min-h-screen pb-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Search and Create Thread Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-12 relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-pink-200 to-purple-200 rounded-full opacity-50 transform translate-x-16 -translate-y-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-indigo-200 to-blue-200 rounded-full opacity-50 transform -translate-x-12 translate-y-12"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row gap-6 items-center">
                    <!-- Search Section -->
                    <div class="flex-1 w-full">
                        <form method="GET" action="{{ route('threads.index') }}" class="relative">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Cari topik, pengalaman, atau tips..." 
                                       class="w-full pl-12 pr-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/90 backdrop-blur text-lg placeholder-gray-400 transition-all duration-200">
                                <svg class="w-6 h-6 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Create Thread Button -->
                    <div class="w-full lg:w-auto">
                        <a href="{{ route('threads.create') }}" 
                           class="w-full lg:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-2xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg group">
                            <svg class="w-6 h-6 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Thread Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Categories -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300 cursor-pointer">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">Tips & Pengalaman</h3>
                </div>
                <p class="text-pink-100">Berbagi tips praktis dan pengalaman pribadi</p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300 cursor-pointer">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">Tanya Jawab</h3>
                </div>
                <p class="text-purple-100">Bertanya dan dapat jawaban dari komunitas</p>
            </div>
            
            <div class="bg-gradient-to-br from-indigo-500 to-blue-500 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300 cursor-pointer">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">Dukungan</h3>
                </div>
                <p class="text-indigo-100">Saling memberi semangat dan dukungan</p>
            </div>
        </div>

        <!-- Threads List -->
        <div class="space-y-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Diskusi Terbaru</h2>
                <p class="text-gray-600">Temukan dan bergabung dalam percakapan yang menarik</p>
            </div>
            
            @foreach($threads as $thread)
                <article class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-8 hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 group relative overflow-hidden">
                    <!-- Decorative Element -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-pink-200/30 to-purple-200/30 rounded-full transform translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative z-10">
                        <!-- Thread Header -->
                        <div class="flex items-start space-x-4 mb-6">
                            <div class="relative">
                                <img src="{{ $thread['user_avatar'] }}" alt="{{ $thread['user_name'] }}" 
                                     class="w-14 h-14 rounded-full ring-3 ring-pink-100 shadow-lg">
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $thread['user_name'] }}</h3>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $thread['created_at'] }}
                                    </div>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-pink-600 transition-colors duration-200">
                                    {{ $thread['title'] }}
                                </h2>
                            </div>
                        </div>

                        <!-- Thread Content -->
                        <div class="mb-6">
                            <p class="text-gray-700 leading-relaxed text-lg line-clamp-3">{{ $thread['content'] }}</p>
                        </div>

                        <!-- Tags -->
                        @if(!empty($thread['tags']))
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($thread['tags'] as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-pink-100 to-purple-100 text-pink-700 hover:from-pink-200 hover:to-purple-200 transition-colors cursor-pointer">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Thread Stats and Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                            <div class="flex items-center space-x-8">
                                <!-- Likes -->
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-pink-600 transition-colors group/btn">
                                    <div class="relative">
                                        <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold">{{ $thread['likes_count'] }}</span>
                                    <span class="hidden sm:inline">Suka</span>
                                </button>
                                
                                <!-- Comments -->
                                <a href="{{ route('threads.show', $thread['id']) }}" 
                                   class="flex items-center space-x-2 text-gray-600 hover:text-purple-600 transition-colors group/btn">
                                    <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span class="font-semibold">{{ $thread['comments_count'] }}</span>
                                    <span class="hidden sm:inline">Komentar</span>
                                </a>
                            </div>

                            <div class="flex items-center space-x-4">
                                <!-- Share -->
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 transition-colors group/btn">
                                    <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Bagikan</span>
                                </button>
                                
                                <!-- Read More -->
                                <a href="{{ route('threads.show', $thread['id']) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-medium rounded-full hover:shadow-lg transition-all duration-200 text-sm">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Load More -->
        <div class="text-center mt-16">
            <button class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-pink-100 hover:to-purple-100 border border-gray-300 rounded-2xl text-gray-700 font-semibold hover:text-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl group">
                <svg class="w-5 h-5 mr-3 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Muat Diskusi Lainnya
            </button>
        </div>

        <!-- Call to Action -->
        <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-3xl p-8 mt-16 text-white text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-40 h-40 bg-white/10 rounded-full transform -translate-x-20 -translate-y-20"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/10 rounded-full transform translate-x-16 translate-y-16"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-4">Bergabunglah dengan Komunitas Kami!</h3>
                <p class="text-pink-100 mb-6 max-w-2xl mx-auto">
                    Dapatkan dukungan, berbagi pengalaman, dan temukan jawaban dari ribuan ibu hamil lainnya.
                </p>
                <a href="{{ route('threads.create') }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Mulai Diskusi Pertama
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Floating Create Button (Mobile) -->
<div class="fixed bottom-6 right-6 lg:hidden z-50">
    <a href="{{ route('threads.create') }}" 
       class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 group">
        <svg class="w-7 h-7 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
        </svg>
    </a>
</div>

<!-- Additional Styles -->
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom scrollbar for better aesthetics */
/* ::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #ec4899, #8b5cf6);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #db2777, #7c3aed);
} */

/* Enhance floating button with pulse animation */
@keyframes pulse-ring {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(2.5);
        opacity: 0;
    }
}

.floating-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50%;
    background: linear-gradient(45deg, #ec4899, #8b5cf6);
    animation: pulse-ring 2s infinite;
    z-index: -1;
}
</style>
@endsection