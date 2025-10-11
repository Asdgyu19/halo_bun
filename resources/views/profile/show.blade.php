@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent mb-4">
                Profile Saya
            </h1>
            <p class="text-xl text-gray-600">
                Kelola informasi profile dan foto Anda
            </p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Profile Info Card --}}
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 text-center">
                    <div class="mb-6">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 alt="Avatar" 
                                 class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-blue-100 shadow-lg">
                        @else
                            <div class="w-32 h-32 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full mx-auto flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $user->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                    
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h3 class="font-semibold text-blue-900 mb-2">Informasi Akun</h3>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p><span class="font-medium">Bergabung:</span> {{ $user->created_at->format('d M Y') }}</p>
                            <p><span class="font-medium">Status:</span> {{ $user->role == 'admin' ? 'Administrator' : 'Member' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Profile Form --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h3>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        {{-- Nama --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email (Read Only) --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" 
                                   id="email" 
                                   value="{{ $user->email }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-500 cursor-not-allowed"
                                   readonly>
                            <p class="mt-1 text-sm text-gray-500">Email tidak dapat diubah</p>
                        </div>

                        {{-- Upload Avatar --}}
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Profile
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                                             alt="Current Avatar" 
                                             class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" 
                                           id="avatar" 
                                           name="avatar" 
                                           accept="image/*"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <p class="mt-1 text-sm text-gray-500">
                                        Format yang didukung: JPEG, PNG, JPG, GIF (Max: 2MB)
                                    </p>
                                </div>
                            </div>
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ url()->previous() }}" 
                               class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Additional Info Card --}}
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-blue-900">Tips Profile</h3>
                    <p class="text-blue-700 mt-1">
                        Gunakan foto profile yang jelas dan profesional. Nama yang Anda gunakan akan ditampilkan di forum diskusi dan komentar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection