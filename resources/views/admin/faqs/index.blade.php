@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--blue)]">Kelola FAQ Kesehatan</h1>
        <a href="{{ route('admin.faqs.create') }}" 
           class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah FAQ
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.faqs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" 
                       name="search" 
                       placeholder="Cari pertanyaan atau jawaban..." 
                       value="{{ request('search') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
            </div>
            <div>
                <select name="category" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Dipublikasi</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-[var(--blue)] hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-question-circle text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Total FAQ</p>
                    <p class="text-lg font-semibold">{{ $stats['total'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-eye text-green-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Dipublikasi</p>
                    <p class="text-lg font-semibold">{{ $stats['published'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-edit text-yellow-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Draft</p>
                    <p class="text-lg font-semibold">{{ $stats['draft'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-star text-purple-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Featured</p>
                    <p class="text-lg font-semibold">{{ $stats['featured'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($faqs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statistik</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($faqs as $faq)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <div class="text-sm font-medium text-gray-900 mb-1">
                                        {{ Str::limit($faq->question, 60) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit(strip_tags($faq->answer), 80) }}
                                    </div>
                                    @if($faq->tags)
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach($faq->tags_array as $tag)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                    #{{ trim($tag) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $faq->category }}
                                </span>
                                @if($faq->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                        <i class="fas fa-star mr-1"></i> Featured
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($faq->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-eye mr-1"></i> Dipublikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-edit mr-1"></i> Draft
                                    </span>
                                @endif
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $faq->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <i class="fas fa-eye text-blue-500 mr-1"></i>
                                        <span>{{ number_format($faq->view_count) }} views</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-thumbs-up text-green-500 mr-1"></i>
                                        <span>{{ number_format($faq->like_count) }} likes</span>
                                    </div>
                                    @if($faq->order_position)
                                    <div class="text-xs text-gray-500 mt-1">
                                        Urutan: {{ $faq->order_position }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-1">
                                <a href="{{ route('admin.faqs.show', $faq) }}" 
                                   class="text-[var(--blue)] hover:text-blue-900 inline-flex items-center bg-blue-100 hover:bg-blue-200 px-2 py-1 rounded">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                                <a href="{{ route('admin.faqs.edit', $faq) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 inline-flex items-center bg-yellow-100 hover:bg-yellow-200 px-2 py-1 rounded">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 inline-flex items-center bg-red-100 hover:bg-red-200 px-2 py-1 rounded">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $faqs->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-question-circle text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada FAQ</h3>
                <p class="text-gray-500 mb-4">Mulai dengan menambahkan FAQ pertama untuk membantu pengguna.</p>
                <a href="{{ route('admin.faqs.create') }}" 
                   class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah FAQ Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection