@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Video Edukasi Kesehatan</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Temukan video edukatif tentang kesehatan ibu hamil dan bayi
        </p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('videos.index') }}" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari judul video atau kata kunci..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" 
                        class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Trimester Filter -->
                <select name="trimester" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Trimester</option>
                    <option value="1" {{ request('trimester') == '1' ? 'selected' : '' }}>Trimester 1</option>
                    <option value="2" {{ request('trimester') == '2' ? 'selected' : '' }}>Trimester 2</option>
                    <option value="3" {{ request('trimester') == '3' ? 'selected' : '' }}>Trimester 3</option>
                </select>

                <!-- Category Filter -->
                <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <!-- Sort Filter -->
                <select name="sort" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="most_viewed" {{ request('sort') == 'most_viewed' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                    <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>A-Z</option>
                </select>

                <!-- Status Filter -->
                <select name="status" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">
            Menampilkan {{ $videos->count() }} dari {{ $videos->total() }} video
            @if(request('search'))
                untuk "<strong>{{ request('search') }}</strong>"
            @endif
        </p>
        
        @if(request()->anyFilled(['search', 'trimester', 'category', 'sort', 'status']))
        <a href="{{ route('videos.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
            <i class="fas fa-times mr-1"></i> Reset Filter
        </a>
        @endif
    </div>

    <!-- Trimester Quick Filter -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter berdasarkan Trimester</h3>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('videos.index') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ !request('trimester') ? 'bg-[var(--blue)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors">
                Semua
            </a>
            <a href="{{ route('videos.index', ['trimester' => '1']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('trimester') == '1' ? 'bg-[var(--blue)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors">
                <i class="fas fa-baby mr-1"></i> Trimester 1
            </a>
            <a href="{{ route('videos.index', ['trimester' => '2']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('trimester') == '2' ? 'bg-[var(--blue)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors">
                <i class="fas fa-heart mr-1"></i> Trimester 2
            </a>
            <a href="{{ route('videos.index', ['trimester' => '3']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('trimester') == '3' ? 'bg-[var(--blue)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors">
                <i class="fas fa-baby-carriage mr-1"></i> Trimester 3
            </a>
        </div>
    </div>

    <!-- Videos Grid -->
    @if($videos->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($videos as $video)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Video Thumbnail -->
            <div class="relative">
                @if($video->thumbnail_url)
                    <img src="{{ $video->thumbnail_url }}" 
                         alt="{{ $video->title }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                        <i class="fas fa-play-circle text-white text-6xl"></i>
                    </div>
                @endif
                
                <!-- Play Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                    <a href="{{ route('videos.show', $video) }}" 
                       class="bg-white rounded-full p-4 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-play text-2xl text-gray-800"></i>
                    </a>
                </div>
                
                <!-- Duration Badge -->
                @if($video->duration)
                <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-xs">
                    {{ $video->duration }}
                </div>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-3">
                    <!-- Category -->
                    @if($video->category)
                    <span class="inline-block bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $video->category }}
                    </span>
                    @endif
                    
                    <!-- Trimester Badge -->
                    @if($video->trimester)
                    <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Trimester {{ $video->trimester }}
                    </span>
                    @endif
                </div>

                <!-- Title -->
                <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">
                    <a href="{{ route('videos.show', $video) }}" 
                       class="hover:text-[var(--blue)] transition-colors">
                        {{ $video->title }}
                    </a>
                </h3>

                <!-- Description -->
                @if($video->description)
                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                    {{ Str::limit(strip_tags($video->description), 120) }}
                </p>
                @endif

                <!-- Meta Information -->
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <div class="flex items-center space-x-3">
                        <!-- Author -->
                        <div class="flex items-center">
                            <i class="fas fa-user mr-1"></i>
                            <span>{{ $video->user->name ?? 'Admin' }}</span>
                        </div>
                        
                        <!-- Views -->
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ number_format($video->views) }}</span>
                        </div>
                    </div>
                    
                    <!-- Date -->
                    <span class="text-xs">{{ $video->created_at->format('d M Y') }}</span>
                </div>

                <!-- Video Source -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        @if(str_contains($video->video_url, 'youtube.com') || str_contains($video->video_url, 'youtu.be'))
                            <i class="fab fa-youtube text-red-500 mr-1"></i>
                            <span>YouTube</span>
                        @elseif(str_contains($video->video_url, 'tiktok.com'))
                            <i class="fab fa-tiktok text-black mr-1"></i>
                            <span>TikTok</span>
                        @elseif(str_contains($video->video_url, 'vimeo.com'))
                            <i class="fab fa-vimeo text-blue-500 mr-1"></i>
                            <span>Vimeo</span>
                        @else
                            <i class="fas fa-video mr-1"></i>
                            <span>Video</span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <!-- Share -->
                        <button data-title="{{ $video->title }}" data-url="{{ route('videos.show', $video) }}" 
                                onclick="shareVideo(this.dataset.title, this.dataset.url)"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded-lg text-sm">
                            <i class="fas fa-share"></i>
                        </button>
                        
                        <!-- Watch -->
                        <a href="{{ route('videos.show', $video) }}" 
                           class="bg-[var(--blue)] hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                            Tonton
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $videos->appends(request()->query())->links() }}
    </div>
    @else
    <!-- No Results -->
    <div class="text-center py-12">
        <div class="bg-white rounded-lg shadow-md p-8">
            <i class="fas fa-video text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada video ditemukan</h3>
            <p class="text-gray-500 mb-4">
                @if(request()->anyFilled(['search', 'trimester', 'category', 'sort', 'status']))
                    Coba ubah kriteria pencarian atau filter Anda
                @else
                    Belum ada video edukasi yang tersedia
                @endif
            </p>
            @if(request()->anyFilled(['search', 'trimester', 'category', 'sort', 'status']))
            <a href="{{ route('videos.index') }}" 
               class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Reset Pencarian
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- Popular Videos -->
    @if($popularVideos->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Video Populer</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($popularVideos as $popularVideo)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative">
                    @if($popularVideo->thumbnail_url)
                        <img src="{{ $popularVideo->thumbnail_url }}" 
                             alt="{{ $popularVideo->title }}" 
                             class="w-full h-32 object-cover">
                    @else
                        <div class="w-full h-32 bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                            <i class="fas fa-play-circle text-white text-3xl"></i>
                        </div>
                    @endif
                    
                    <!-- Play Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                        <a href="{{ route('videos.show', $popularVideo) }}" 
                           class="bg-white rounded-full p-2 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-play text-lg text-gray-800"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-4">
                    @if($popularVideo->trimester)
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full mb-2">
                        Trimester {{ $popularVideo->trimester }}
                    </span>
                    @endif
                    
                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">
                        <a href="{{ route('videos.show', $popularVideo) }}" 
                           class="hover:text-[var(--blue)] transition-colors">
                            {{ $popularVideo->title }}
                        </a>
                    </h3>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span><i class="fas fa-eye mr-1"></i>{{ number_format($popularVideo->views) }}</span>
                        <span>{{ $popularVideo->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function shareVideo(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        // Fallback
        copyToClipboard(url);
        alert('Link berhasil disalin!');
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        console.log('Link copied successfully');
    }, function(err) {
        console.error('Failed to copy link: ', err);
    });
}

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('select[name]');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>
@endsection
