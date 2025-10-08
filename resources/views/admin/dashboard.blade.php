@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg shadow-lg">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="font-semibold">{{ now()->format('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Articles Stats -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Artikel</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Article::count() }}</p>
                    <p class="text-blue-100 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +{{ \App\Models\Article::where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                    </p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Videos Stats -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Video</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Video::count() }}</p>
                    <p class="text-purple-100 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +{{ \App\Models\Video::where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                    </p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-play-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- FAQs Stats -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total FAQ</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Faq::count() }}</p>
                    <p class="text-green-100 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +{{ \App\Models\Faq::where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                    </p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-question-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Facilities Stats -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total Faskes</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Facility::count() }}</p>
                    <p class="text-orange-100 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +{{ \App\Models\Facility::where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                    </p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-hospital text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Management Cards -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kelola Konten</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Articles Management -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 rounded-lg p-2">
                                <i class="fas fa-newspaper text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Artikel Kesehatan</h3>
                                <p class="text-blue-100 text-sm">Kelola artikel & tips kehamilan</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.articles.index') }}" 
                               class="flex items-center text-gray-700 hover:text-blue-600 transition-colors">
                                <i class="fas fa-list-ul w-5 mr-3"></i>
                                <span>Lihat Semua Artikel</span>
                            </a>
                            <a href="{{ route('admin.articles.create') }}" 
                               class="flex items-center text-gray-700 hover:text-blue-600 transition-colors">
                                <i class="fas fa-plus-circle w-5 mr-3"></i>
                                <span>Tambah Artikel Baru</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Artikel Published</span>
                                <span class="font-semibold">{{ \App\Models\Article::whereIn('status', ['published', null])->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Videos Management -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 rounded-lg p-2">
                                <i class="fas fa-play-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Video Edukasi</h3>
                                <p class="text-purple-100 text-sm">Kelola video pembelajaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.videos.index') }}" 
                               class="flex items-center text-gray-700 hover:text-purple-600 transition-colors">
                                <i class="fas fa-list-ul w-5 mr-3"></i>
                                <span>Lihat Semua Video</span>
                            </a>
                            <a href="{{ route('admin.videos.create') }}" 
                               class="flex items-center text-gray-700 hover:text-purple-600 transition-colors">
                                <i class="fas fa-plus-circle w-5 mr-3"></i>
                                <span>Tambah Video Baru</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Video Published</span>
                                <span class="font-semibold">{{ \App\Models\Video::where('status', 'published')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQs Management -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 rounded-lg p-2">
                                <i class="fas fa-question-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">FAQ Kesehatan</h3>
                                <p class="text-green-100 text-sm">Kelola pertanyaan umum</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.faqs.index') }}" 
                               class="flex items-center text-gray-700 hover:text-green-600 transition-colors">
                                <i class="fas fa-list-ul w-5 mr-3"></i>
                                <span>Lihat Semua FAQ</span>
                            </a>
                            <a href="{{ route('admin.faqs.create') }}" 
                               class="flex items-center text-gray-700 hover:text-green-600 transition-colors">
                                <i class="fas fa-plus-circle w-5 mr-3"></i>
                                <span>Tambah FAQ Baru</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>FAQ Published</span>
                                <span class="font-semibold">{{ \App\Models\Faq::where('status', 'published')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities Management -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 rounded-lg p-2">
                                <i class="fas fa-hospital text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Fasilitas Kesehatan</h3>
                                <p class="text-orange-100 text-sm">Kelola data faskes</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.facilities.index') }}" 
                               class="flex items-center text-gray-700 hover:text-orange-600 transition-colors">
                                <i class="fas fa-list-ul w-5 mr-3"></i>
                                <span>Lihat Semua Faskes</span>
                            </a>
                            <a href="{{ route('admin.facilities.create') }}" 
                               class="flex items-center text-gray-700 hover:text-orange-600 transition-colors">
                                <i class="fas fa-plus-circle w-5 mr-3"></i>
                                <span>Tambah Faskes Baru</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Faskes Verified</span>
                                <span class="font-semibold">{{ \App\Models\Facility::where('is_verified', true)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Info -->
        <div class="space-y-6">
            <!-- Recent Content -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Konten Terbaru</h3>
                <div class="space-y-4">
                    @forelse(\App\Models\Article::latest()->take(3)->get() as $article)
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="bg-blue-500 rounded-full p-2">
                            <i class="fas fa-newspaper text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $article->title }}</p>
                            <p class="text-xs text-gray-500">{{ $article->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada artikel</p>
                    @endforelse
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Laravel Version</span>
                        <span class="text-sm font-semibold text-gray-900">{{ app()->version() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">PHP Version</span>
                        <span class="text-sm font-semibold text-gray-900">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Database</span>
                        <span class="text-sm font-semibold text-gray-900">MySQL</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="/" 
                       class="flex items-center space-x-3 bg-white bg-opacity-20 rounded-lg p-3 hover:bg-opacity-30 transition-colors">
                        <i class="fas fa-home"></i>
                        <span>Lihat Website</span>
                    </a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="flex items-center space-x-3 bg-white bg-opacity-20 rounded-lg p-3 hover:bg-opacity-30 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}
</style>
@endsection
