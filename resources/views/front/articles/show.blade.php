@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-[var(--blue)]">Beranda</a></li>
            <li>→</li>
            <li><a href="{{ route('articles.index') }}" class="hover:text-[var(--blue)]">Artikel</a></li>
            <li>→</li>
            <li class="text-gray-900">{{ Str::limit($article->title, 30) }}</li>
        </ol>
    </nav>

    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Article Header -->
        <div class="p-8">
            <div class="flex items-center gap-3 mb-4">
                @if($article->trimester)
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded">
                        Trimester {{ $article->trimester }}
                    </span>
                @endif
                <span class="inline-block bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded">
                    {{ ucfirst($article->category) }}
                </span>
                <span class="text-sm text-gray-500">
                    {{ $article->created_at->format('d F Y') }}
                </span>
            </div>
            
            <h1 class="text-4xl font-bold text-[var(--blue)] mb-4 leading-tight">
                {{ $article->title }}
            </h1>

            @if($article->excerpt)
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    {{ $article->excerpt }}
                </p>
            @endif

            @if($article->user)
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span>Ditulis oleh: <strong>{{ $article->user->name }}</strong></span>
                </div>
            @endif
        </div>

        <!-- Article Thumbnail -->
        @if($article->thumbnail)
            <div class="px-8 mb-8">
                <img src="{{ $article->thumbnail_url }}" 
                     alt="{{ $article->title }}" 
                     class="w-full max-h-96 object-cover rounded-lg shadow-sm">
            </div>
        @endif

        <!-- Article Content -->
        <div class="px-8 pb-8">
            @if($article->notion_url)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Baca lengkap di Notion:</h3>
                    <iframe 
                        src="{{ $article->notion_url }}" 
                        class="w-full h-[70vh] border border-gray-200 rounded-lg"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                    <p class="text-sm text-gray-500 mt-2">
                        Jika iframe tidak muncul, 
                        <a href="{{ $article->notion_url }}" target="_blank" class="text-[var(--blue)] hover:underline">
                            klik di sini untuk membuka di tab baru
                        </a>
                    </p>
                </div>
            @endif

            @if($article->body)
                <div class="prose prose-lg max-w-none prose-headings:text-[var(--blue)] prose-links:text-[var(--blue)] prose-strong:text-gray-900">
                    {!! nl2br(e($article->body)) !!}
                </div>
            @endif
        </div>

        <!-- Article Footer -->
        <div class="bg-gray-50 px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Artikel ini bermanfaat? Bagikan kepada teman-teman Anda!
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Share buttons can be added here -->
                    <button onclick="history.back()" 
                            class="bg-[var(--blue)] text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        ← Kembali
                    </button>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
        <div class="mt-12">
            <h3 class="text-2xl font-bold text-[var(--blue)] mb-6">Artikel Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        @if($related->thumbnail)
                            <img src="{{ $related->thumbnail_url }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-[var(--blue)] mb-2 line-clamp-2">
                                {{ $related->title }}
                            </h4>
                            <a href="{{ route('articles.show', $related->slug) }}" 
                               class="text-sm text-blue-600 hover:underline">
                                Baca artikel →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
