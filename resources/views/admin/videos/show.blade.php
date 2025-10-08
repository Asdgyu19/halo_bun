@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--blue)]">Detail Video Edukasi</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.videos.edit', $video) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.videos.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Video Player Section -->
        <div class="bg-gray-900 p-6">
            <div class="max-w-4xl mx-auto">
                @if($video->video_type === 'youtube')
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe 
                            src="{{ $video->embed_url }}" 
                            frameborder="0" 
                            allowfullscreen
                            class="w-full h-full rounded-lg"
                            style="min-height: 400px;"
                        ></iframe>
                    </div>
                @elseif($video->video_type === 'tiktok')
                    <div class="flex items-center justify-center bg-black rounded-lg" style="min-height: 400px;">
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
                            class="w-full h-full rounded-lg"
                            style="min-height: 400px;"
                        ></iframe>
                    </div>
                @else
                    <div class="flex items-center justify-center bg-gray-600 rounded-lg" style="min-height: 400px;">
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
        </div>

        <!-- Video Information -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $video->title }}</h2>
                    
                    <!-- Video Stats -->
                    <div class="flex items-center space-x-6 mb-4 text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            <span>{{ number_format($video->view_count) }} views</span>
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

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-6">
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

                    <!-- Description -->
                    @if($video->description)
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Deskripsi</h3>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed">{{ $video->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Thumbnail -->
                    @if($video->thumbnail)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Thumbnail</h3>
                        <img src="{{ Storage::url($video->thumbnail) }}" 
                             alt="Video thumbnail" 
                             class="w-full rounded-lg shadow-md">
                    </div>
                    @endif

                    <!-- Video Details -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Video</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Platform:</span>
                                <span class="font-medium capitalize">{{ $video->video_type }}</span>
                            </div>
                            
                            @if($video->trimester)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Trimester:</span>
                                <span class="font-medium">{{ $video->trimester }}</span>
                            </div>
                            @endif
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-medium">{{ $video->category }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Views:</span>
                                <span class="font-medium">{{ number_format($video->view_count) }}</span>
                            </div>
                            
                            @if($video->duration)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durasi:</span>
                                <span class="font-medium">{{ gmdate('H:i:s', $video->duration) }}</span>
                            </div>
                            @endif
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">
                                    @if($video->is_featured)
                                        <span class="text-yellow-600">Unggulan</span>
                                    @else
                                        <span class="text-green-600">Normal</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span class="font-medium">{{ $video->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diupdate:</span>
                                <span class="font-medium">{{ $video->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Oleh:</span>
                                <span class="font-medium">{{ $video->user->name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-2">
                        <a href="{{ $video->video_url }}" target="_blank"
                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center block">
                            <i class="fas fa-external-link-alt mr-2"></i> Buka Video Original
                        </a>
                        
                        <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?')"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash mr-2"></i> Hapus Video
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection