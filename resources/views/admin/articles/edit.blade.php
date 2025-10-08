@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-[var(--blue)] mb-6">Edit Artikel</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Judul Artikel *
            </label>
            <input 
                name="title" 
                id="title"
                type="text"
                placeholder="Masukkan judul artikel" 
                value="{{ old('title', $article->title) }}"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                required
            />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="trimester">
                Trimester
            </label>
            <select name="trimester" id="trimester" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]">
                <option value="">Pilih Trimester (Opsional)</option>
                <option value="1" {{ old('trimester', $article->trimester) == '1' ? 'selected' : '' }}>Trimester 1</option>
                <option value="2" {{ old('trimester', $article->trimester) == '2' ? 'selected' : '' }}>Trimester 2</option>
                <option value="3" {{ old('trimester', $article->trimester) == '3' ? 'selected' : '' }}>Trimester 3</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                Kategori *
            </label>
            <input 
                name="category" 
                id="category"
                type="text"
                placeholder="Contoh: Nutrisi, Olahraga, Kesehatan Mental" 
                value="{{ old('category', $article->category) }}"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                required
            />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="excerpt">
                Ringkasan
            </label>
            <textarea 
                name="excerpt" 
                id="excerpt"
                placeholder="Ringkasan singkat artikel (opsional)" 
                rows="3"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
            >{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                Konten Artikel
            </label>
            <textarea 
                name="body" 
                id="body"
                placeholder="Tulis konten artikel di sini..." 
                rows="10"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
            >{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="notion_url">
                Link Notion
            </label>
            <input 
                type="url" 
                name="notion_url" 
                id="notion_url"
                placeholder="https://notion.so/your-page (opsional)" 
                value="{{ old('notion_url', $article->notion_url) }}"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
            />
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                Thumbnail
            </label>
            @if($article->thumbnail)
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">Thumbnail saat ini:</p>
                    <img src="{{ $article->thumbnail_url }}" alt="Current thumbnail" class="w-32 h-20 object-cover rounded">
                </div>
            @endif
            <input 
                type="file" 
                name="thumbnail" 
                id="thumbnail"
                accept="image/*"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
            />
            <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
        </div>

        <div class="flex items-center justify-between">
            <button 
                type="submit"
                class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Update Artikel
            </button>
            <a 
                href="{{ route('admin.articles.index') }}" 
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection