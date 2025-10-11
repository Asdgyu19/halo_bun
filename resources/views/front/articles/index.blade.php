@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <h1 class="text-3xl font-bold text-[var(--blue)] mb-8">Artikel Kesehatan Kehamilan</h1>

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Trimester</label>
                <select name="trimester" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Trimester</option>
                    <option value="1" {{ request('trimester') == '1' ? 'selected' : '' }}>Trimester 1</option>
                    <option value="2" {{ request('trimester') == '2' ? 'selected' : '' }}>Trimester 2</option>
                    <option value="3" {{ request('trimester') == '3' ? 'selected' : '' }}>Trimester 3</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari artikel..." 
                    value="{{ request('search') }}" 
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[var(--blue)]"
                />
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full bg-[var(--blue)] hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Articles Grid -->
    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($articles as $article)
                <article class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    @if($article->thumbnail)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ $article->thumbnail_url }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-48 object-cover">
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                            <span class="text-4xl">📝</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            @if($article->trimester)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                    Trimester {{ $article->trimester }}
                                </span>
                            @endif
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">
                                {{ ucfirst($article->category) }}
                            </span>
                        </div>
                        
                        <h2 class="font-bold text-lg text-[var(--blue)] mb-3 line-clamp-2">
                            {{ $article->title }}
                        </h2>
                        
                        @if($article->excerpt)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $article->excerpt }}
                            </p>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('articles.show', $article->slug) }}" 
                               class="inline-flex items-center text-[var(--blue)] hover:text-blue-700 font-medium text-sm group transition duration-200">
                                Baca Selengkapnya 
                                <span class="ml-1 group-hover:translate-x-1 transition-transform duration-200">→</span>
                            </a>
                            <span class="text-xs text-gray-400">
                                {{ $article->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="flex justify-center">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">🔍</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada artikel ditemukan</h3>
            <p class="text-gray-500 mb-4">
                @if(request()->hasAny(['trimester', 'category', 'search']))
                    Coba ubah filter pencarian Anda atau 
                    <a href="{{ route('articles.index') }}" class="text-[var(--blue)] hover:underline">lihat semua artikel</a>
                @else
                    Belum ada artikel yang tersedia saat ini.
                @endif
            </p>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
