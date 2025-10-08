@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-[var(--blue)] mb-6">Tambah Video Edukasi</h1>
    
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

    <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Judul Video *
            </label>
            <input 
                name="title" 
                id="title"
                type="text"
                placeholder="Masukkan judul video" 
                value="{{ old('title') }}"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                required
            />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Deskripsi
            </label>
            <textarea 
                name="description" 
                id="description"
                placeholder="Deskripsi singkat video" 
                rows="3"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
            >{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="video_type">
                    Platform Video *
                </label>
                <select name="video_type" id="video_type" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" required>
                    <option value="">Pilih Platform</option>
                    <option value="youtube" {{ old('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="tiktok" {{ old('video_type') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                    <option value="vimeo" {{ old('video_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="video_url">
                    URL Video *
                </label>
                <input 
                    name="video_url" 
                    id="video_url"
                    type="url"
                    placeholder="https://www.youtube.com/watch?v=..." 
                    value="{{ old('video_url') }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    required
                />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="trimester">
                    Trimester
                </label>
                <select name="trimester" id="trimester" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Pilih Trimester (Opsional)</option>
                    <option value="1" {{ old('trimester') == '1' ? 'selected' : '' }}>Trimester 1</option>
                    <option value="2" {{ old('trimester') == '2' ? 'selected' : '' }}>Trimester 2</option>
                    <option value="3" {{ old('trimester') == '3' ? 'selected' : '' }}>Trimester 3</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Kategori *
                </label>
                <input 
                    name="category" 
                    id="category"
                    type="text"
                    placeholder="Contoh: Senam Hamil, Nutrisi, Perkembangan Janin" 
                    value="{{ old('category') }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    required
                />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                    Durasi (detik)
                </label>
                <input 
                    name="duration" 
                    id="duration"
                    type="number"
                    placeholder="300" 
                    value="{{ old('duration') }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    min="1"
                />
                <p class="text-sm text-gray-500 mt-1">Durasi video dalam detik (opsional)</p>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                    Custom Thumbnail
                </label>
                <input 
                    type="file" 
                    name="thumbnail" 
                    id="thumbnail"
                    accept="image/*"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                />
                <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB. (Opsional - akan otomatis dari platform jika kosong)</p>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="is_featured" 
                    id="is_featured"
                    value="1"
                    {{ old('is_featured') ? 'checked' : '' }}
                    class="mr-2"
                />
                <label for="is_featured" class="text-gray-700 text-sm font-bold">
                    Jadikan Video Unggulan
                </label>
            </div>
            <p class="text-sm text-gray-500 mt-1">Video unggulan akan ditampilkan lebih menonjol di halaman utama</p>
        </div>

        <div class="flex items-center justify-between">
            <button 
                type="submit"
                class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Simpan Video
            </button>
            <a 
                href="{{ route('admin.videos.index') }}" 
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Batal
            </a>
        </div>
    </form>
</div>

<script>
// Auto detect video type based on URL
document.getElementById('video_url').addEventListener('input', function() {
    const url = this.value;
    const typeSelect = document.getElementById('video_type');
    
    if (url.includes('youtube.com') || url.includes('youtu.be')) {
        typeSelect.value = 'youtube';
    } else if (url.includes('tiktok.com')) {
        typeSelect.value = 'tiktok';
    } else if (url.includes('vimeo.com')) {
        typeSelect.value = 'vimeo';
    }
});
</script>
@endsection