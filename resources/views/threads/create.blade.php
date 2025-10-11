@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Thread Baru</h1>
            <p class="text-gray-600">Bagikan pengalaman dan tips Anda dengan sesama ibu hamil</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            @if (!Auth::check())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 018.618 8.04c.094.267.145.565.145.872a3.01 3.01 0 01-3.01 3.01H5.247a3.01 3.01 0 01-3.01-3.01c0-.307.051-.605.145-.872z"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Login Diperlukan</h3>
                            <p class="mt-1 text-sm text-yellow-700">
                                Anda perlu login terlebih dahulu untuk membuat thread. 
                                <a href="{{ route('login') }}" class="font-semibold underline">Login di sini</a> atau 
                                <a href="{{ route('register') }}" class="font-semibold underline">daftar akun baru</a>.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('threads.store') }}" class="space-y-6">
                @csrf
                
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Thread
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                           placeholder="Contoh: Tips mengatasi morning sickness"
                           maxlength="255" required @if(!Auth::check()) disabled @endif>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Thread
                    </label>
                    <textarea name="content" id="content" rows="6" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent @error('content') border-red-500 @enderror" 
                              placeholder="Bagikan pengalaman, tips, atau pertanyaan Anda di sini..."
                              maxlength="1000" required @if(!Auth::check()) disabled @endif>{{ old('content') }}</textarea>
                    <div class="flex justify-between mt-2">
                        @error('content')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @else
                            <p class="text-sm text-gray-500">Maksimal 1000 karakter</p>
                        @enderror
                        <p class="text-sm text-gray-500" id="char-count">0/1000</p>
                    </div>
                </div>

                <!-- Guidelines -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Panduan Forum</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Gunakan bahasa yang sopan dan saling mendukung</li>
                        <li>• Bagikan pengalaman atau tips yang bermanfaat</li>
                        <li>• Hindari memberikan saran medis yang tidak berdasar</li>
                        <li>• Gunakan hashtag untuk memudahkan pencarian (contoh: #trimester1)</li>
                        <li>• Selalu konsultasi dengan dokter untuk masalah kesehatan</li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('threads.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            @if(!Auth::check()) disabled @endif>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Posting Thread
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Character counter
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');
        
        if (textarea && charCount) {
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count + '/1000';
                
                if (count > 1000) {
                    charCount.classList.add('text-red-500');
                    charCount.classList.remove('text-gray-500');
                } else {
                    charCount.classList.add('text-gray-500');
                    charCount.classList.remove('text-red-500');
                }
            });
        }
    });
</script>
@endsection
