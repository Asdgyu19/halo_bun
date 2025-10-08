@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Video Player Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <!-- Video Player -->
        <div class="bg-gray-900 relative">
            @if($video->video_type === 'youtube')
                <div class="aspect-w-16 aspect-h-9">
                    <iframe 
                        src="{{ $video->embed_url }}" 
                        frameborder="0" 
                        allowfullscreen
                        class="w-full h-full"
                        style="min-height: 400px;"
                    ></iframe>
                </div>
            @elseif($video->video_type === 'tiktok')
                <div class="flex items-center justify-center bg-black" style="min-height: 400px;">
                    <div class="text-center text-white">
                        <i class="fab fa-tiktok text-6xl mb-4"></i>
                        <p class="text-xl mb-4">Video TikTok</p>
                        <a href="{{ $video->video_url }}" target="_blank" 
                           class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-lg">
                            Buka di TikTok
                        </a>
                    </div>
                </div>
            @elseif($video->video_type === 'vimeo')
                <div class="aspect-w-16 aspect-h-9">
                    <iframe 
                        src="{{ $video->embed_url }}" 
                        frameborder="0" 
                        allowfullscreen
                        class="w-full h-full"
                        style="min-height: 400px;"
                    ></iframe>
                </div>
            @else
                <div class="flex items-center justify-center bg-gray-600" style="min-height: 400px;">
                    <div class="text-center text-white">
                        <i class="fas fa-video text-6xl mb-4"></i>
                        <p class="text-xl mb-4">Video tidak dapat diputar</p>
                        <a href="{{ $video->video_url }}" target="_blank" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                            Buka Link Video
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Video Info -->
        <div class="p-6">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <!-- Platform Badge -->
                @if($video->video_type === 'youtube')
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fab fa-youtube mr-1"></i> YouTube
                    </span>
                @elseif($video->video_type === 'tiktok')
                    <span class="bg-gray-900 text-white px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fab fa-tiktok mr-1"></i> TikTok
                    </span>
                @elseif($video->video_type === 'vimeo')
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fab fa-vimeo mr-1"></i> Vimeo
                    </span>
                @endif

                <!-- Trimester Badge -->
                @if($video->trimester)
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-baby mr-1"></i> Trimester {{ $video->trimester }}
                    </span>
                @endif

                <!-- Category Badge -->
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fas fa-tag mr-1"></i> {{ $video->category }}
                </span>

                <!-- Featured Badge -->
                @if($video->is_featured)
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-star mr-1"></i> Unggulan
                    </span>
                @endif
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $video->title }}</h1>
            
            <!-- Video Stats -->
            <div class="flex items-center space-x-6 mb-6 text-gray-600">
                <div class="flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    <span>{{ number_format($video->views_count) }} views</span>
                </div>
                @if($video->duration)
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ gmdate('H:i:s', $video->duration) }}</span>
                </div>
                @endif
                <div class="flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>{{ $video->created_at->format('d M Y') }}</span>
                </div>
            </div>

            @if($video->description)
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">{{ $video->description }}</p>
            </div>
            @endif

            <!-- Share Buttons -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Bagikan Video</h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($video->title) }}" 
                       target="_blank"
                       class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($video->title . ' - ' . request()->fullUrl()) }}" 
                       target="_blank"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                    <button onclick="copyToClipboard('{{ request()->fullUrl() }}')"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-link mr-2"></i> Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Videos -->
    @if($relatedVideos->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Video Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedVideos as $relatedVideo)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                    @if($relatedVideo->thumbnail)
                        <img src="{{ Storage::url($relatedVideo->thumbnail) }}" 
                             alt="{{ $relatedVideo->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <i class="fas fa-play text-white text-3xl"></i>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="flex flex-wrap items-center gap-1 mb-2">
                        @if($relatedVideo->video_type === 'youtube')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">
                                <i class="fab fa-youtube"></i>
                            </span>
                        @elseif($relatedVideo->video_type === 'tiktok')
                            <span class="bg-gray-900 text-white px-2 py-1 rounded text-xs">
                                <i class="fab fa-tiktok"></i>
                            </span>
                        @endif
                        @if($relatedVideo->trimester)
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">
                                T{{ $relatedVideo->trimester }}
                            </span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $relatedVideo->title }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $relatedVideo->description }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>{{ number_format($relatedVideo->views_count) }} views</span>
                        <span>{{ $relatedVideo->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('videos.show', $relatedVideo) }}" 
                       class="block mt-3 bg-[var(--blue)] hover:bg-blue-700 text-white text-center py-2 rounded-lg transition-colors">
                        Tonton Video
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Navigation -->
    <div class="text-center">
        <a href="{{ route('videos.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Video
        </a>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link berhasil disalin!');
    }, function(err) {
        console.error('Gagal menyalin link: ', err);
    });
}
</script>
@endsection