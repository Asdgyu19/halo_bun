@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[var(--blue)]">Kelola Video Edukasi</h1>
        <a href="{{ route('admin.videos.create') }}" class="bg-[var(--yellow)] hover:bg-yellow-600 px-6 py-3 rounded-lg text-[var(--blue)] font-semibold transition duration-200">
            + Tambah Video
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($videos->count() > 0)
            <table class="w-full">
                <thead class="bg-[var(--blue)] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Video</th>
                        <th class="px-6 py-4 text-left">Judul</th>
                        <th class="px-6 py-4 text-left">Platform</th>
                        <th class="px-6 py-4 text-left">Trimester</th>
                        <th class="px-6 py-4 text-left">Kategori</th>
                        <th class="px-6 py-4 text-left">Views</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="{{ $video->thumbnail_url }}" alt="Thumbnail" class="w-20 h-12 object-cover rounded">
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $video->title }}</div>
                            @if($video->description)
                                <div class="text-sm text-gray-500 mt-1">{{ Str::limit($video->description, 60) }}</div>
                            @endif
                            @if($video->is_featured)
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mt-1">Featured</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded capitalize">
                                {{ $video->video_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($video->trimester)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Trimester {{ $video->trimester }}
                                </span>
                            @else
                                <span class="text-gray-400">Umum</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">
                                {{ $video->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ number_format($video->views_count) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('videos.show', $video->slug) }}" 
                                   class="text-green-600 hover:text-green-900 text-sm font-medium" 
                                   target="_blank" 
                                   title="Lihat di Frontend">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('admin.videos.edit', $video) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" 
                                      class="inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus video: {{ $video->title }}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">🎥</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada video</h3>
                <p class="text-gray-500 mb-4">Mulai tambahkan video edukasi pertama untuk memberikan konten edukatif kepada pengguna.</p>
                <a href="{{ route('admin.videos.create') }}" 
                   class="bg-[var(--blue)] text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Tambah Video Pertama
                </a>
            </div>
        @endif
    </div>

    @if($videos->hasPages())
        <div class="mt-6">
            {{ $videos->links() }}
        </div>
    @endif
</div>
@endsection