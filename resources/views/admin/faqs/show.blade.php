@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--blue)]">Detail FAQ Kesehatan</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.faqs.edit', $faq) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.faqs.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                            {{ $faq->category }}
                        </span>
                        @if($faq->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-400 text-yellow-800">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        @endif
                        @if($faq->status === 'published')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-400 text-green-800">
                                <i class="fas fa-eye mr-1"></i> Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-400 text-yellow-800">
                                <i class="fas fa-edit mr-1"></i> Draft
                            </span>
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold mb-2">{{ $faq->question }}</h2>
                    <div class="flex items-center space-x-6 text-sm opacity-90">
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ number_format($faq->views_count) }} views</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-thumbs-up mr-1"></i>
                            <span>{{ number_format($faq->likes) }} likes</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-1"></i>
                            <span>{{ $faq->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <i class="fas fa-question-circle text-6xl opacity-30"></i>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Answer -->
                <div class="lg:col-span-2">
                    <!-- Answer Content -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-comment-dots text-blue-500 mr-2"></i>
                            Jawaban
                        </h3>
                        <div class="prose max-w-none bg-gray-50 rounded-lg p-6">
                            <div class="text-gray-700 leading-relaxed">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($faq->tags)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-tags text-purple-500 mr-2"></i>
                            Kata Kunci
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($faq->tags_array as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    #{{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Content Analysis -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-md font-semibold text-gray-800 mb-3">Analisis Konten</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Panjang Pertanyaan:</span>
                                <span class="font-medium ml-2">{{ strlen($faq->question) }} karakter</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Panjang Jawaban:</span>
                                <span class="font-medium ml-2">{{ strlen(strip_tags($faq->answer)) }} karakter</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Jumlah Kata:</span>
                                <span class="font-medium ml-2">{{ str_word_count(strip_tags($faq->answer)) }} kata</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Estimated Reading Time:</span>
                                <span class="font-medium ml-2">{{ ceil(str_word_count(strip_tags($faq->answer)) / 200) }} menit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Metadata & Actions -->
                <div class="lg:col-span-1">
                    <!-- FAQ Details -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail FAQ</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID:</span>
                                <span class="font-medium">#{{ $faq->id }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-medium">{{ $faq->category }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">
                                    @if($faq->status === 'published')
                                        <span class="text-green-600">Dipublikasi</span>
                                    @else
                                        <span class="text-yellow-600">Draft</span>
                                    @endif
                                </span>
                            </div>
                            
                            @if($faq->order_position)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Urutan:</span>
                                <span class="font-medium">{{ $faq->order_position }}</span>
                            </div>
                            @endif
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Featured:</span>
                                <span class="font-medium">
                                    @if($faq->is_featured)
                                        <span class="text-yellow-600">Ya</span>
                                    @else
                                        <span class="text-gray-600">Tidak</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Views:</span>
                                <span class="font-medium">{{ number_format($faq->views_count) }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Likes:</span>
                                <span class="font-medium">{{ number_format($faq->likes) }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span class="font-medium">{{ $faq->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diupdate:</span>
                                <span class="font-medium">{{ $faq->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Oleh:</span>
                                <span class="font-medium">{{ $faq->user->name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Engagement Stats -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Statistik Engagement</h3>
                        
                        <div class="space-y-3">
                            @php
                                $totalEngagement = $faq->views_count + $faq->likes;
                                $likeRate = $faq->views_count > 0 ? ($faq->likes / $faq->views_count) * 100 : 0;
                            @endphp
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Total Engagement:</span>
                                <span class="font-bold text-blue-600">{{ number_format($totalEngagement) }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Like Rate:</span>
                                <span class="font-bold text-green-600">{{ number_format($likeRate, 1) }}%</span>
                            </div>
                            
                            <!-- Visual bar -->
                            @php 
                                $barWidth = min($likeRate, 100);
                                $widthClass = 'w-full';
                                if ($barWidth <= 10) $widthClass = 'w-1/12';
                                elseif ($barWidth <= 20) $widthClass = 'w-2/12';
                                elseif ($barWidth <= 25) $widthClass = 'w-1/4';
                                elseif ($barWidth <= 33) $widthClass = 'w-1/3';
                                elseif ($barWidth <= 50) $widthClass = 'w-1/2';
                                elseif ($barWidth <= 66) $widthClass = 'w-2/3';
                                elseif ($barWidth <= 75) $widthClass = 'w-3/4';
                                elseif ($barWidth <= 90) $widthClass = 'w-11/12';
                                else $widthClass = 'w-full';
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-2 relative overflow-hidden">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300 {{ $widthClass }}">
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ number_format($barWidth, 1) }}% engagement rate
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-2">
                        @if($faq->status === 'draft')
                        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="published">
                            <input type="hidden" name="question" value="{{ $faq->question }}">
                            <input type="hidden" name="answer" value="{{ $faq->answer }}">
                            <input type="hidden" name="category" value="{{ $faq->category }}">
                            <button type="submit" 
                                    class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-eye mr-2"></i> Publikasikan FAQ
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="draft">
                            <input type="hidden" name="question" value="{{ $faq->question }}">
                            <input type="hidden" name="answer" value="{{ $faq->answer }}">
                            <input type="hidden" name="category" value="{{ $faq->category }}">
                            <button type="submit" 
                                    class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit mr-2"></i> Jadikan Draft
                            </button>
                        </form>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash mr-2"></i> Hapus FAQ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection