@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('threads.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Forum
            </a>
        </div>

        <!-- Thread Detail -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <!-- Thread Header -->
            <div class="flex items-start space-x-4 mb-6">
                <img src="{{ $threadData['user_avatar'] }}" alt="{{ $threadData['user_name'] }}" 
                     class="w-14 h-14 rounded-full ring-2 ring-blue-100">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900 text-lg">{{ $threadData['user_name'] }}</h3>
                        <span class="text-sm text-gray-500">{{ $threadData['created_at'] }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mt-2 mb-3">{{ $threadData['title'] }}</h1>
                </div>
            </div>

            <!-- Thread Content -->
            <div class="mb-6">
                <p class="text-gray-700 leading-relaxed text-lg">{{ $threadData['content'] }}</p>
            </div>

            <!-- Tags -->
            @if(!empty($threadData['tags']))
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($threadData['tags'] as $tag)
                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Thread Stats and Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <div class="flex items-center space-x-6">
                    <!-- Likes -->
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="font-medium">{{ $threadData['likes_count'] }} Suka</span>
                    </button>
                    
                    <!-- Comments Count -->
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span class="font-medium">{{ $threadData['comments_count'] }} Komentar</span>
                    </div>
                </div>

                <!-- Share -->
                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    <span class="font-medium">Bagikan</span>
                </button>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Komentar ({{ count($comments) }})</h2>

            <!-- Add Comment Form -->
            @auth
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <form action="{{ route('threads.comment', $threadData['id']) }}" method="POST" class="space-y-4">
                        @csrf
                        <textarea name="content" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  placeholder="Tulis komentar Anda..." required maxlength="500"></textarea>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Maksimal 500 karakter</span>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-medium rounded-lg hover:opacity-90 transition-opacity">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800">
                        <a href="{{ route('login') }}" class="font-semibold underline">Login</a> atau 
                        <a href="{{ route('register') }}" class="font-semibold underline">daftar</a> 
                        untuk memberikan komentar.
                    </p>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-6">
                @foreach($comments as $comment)
                    <div class="flex space-x-4">
                        <img src="{{ $comment['user_avatar'] }}" alt="{{ $comment['user_name'] }}" 
                             class="w-10 h-10 rounded-full ring-2 ring-gray-100">
                        <div class="flex-1 min-w-0">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-gray-900">{{ $comment['user_name'] }}</h4>
                                    <span class="text-sm text-gray-500">{{ $comment['created_at'] }}</span>
                                </div>
                                <p class="text-gray-700">{{ $comment['content'] }}</p>
                            </div>
                            
                            <!-- Comment Actions -->
                            <div class="flex items-center space-x-4 mt-2 ml-4">
                                <button class="text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                    Suka
                                </button>
                                <button class="text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                    Balas
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if(count($comments) == 0)
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection