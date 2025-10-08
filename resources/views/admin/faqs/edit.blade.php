@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-[var(--blue)] mb-6">Edit FAQ Kesehatan</h1>
    
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

    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="question">
                    Pertanyaan *
                </label>
                <input 
                    name="question" 
                    id="question"
                    type="text"
                    placeholder="Tuliskan pertanyaan yang sering diajukan" 
                    value="{{ old('question', $faq->question) }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="answer">
                    Jawaban *
                </label>
                <textarea 
                    name="answer" 
                    id="answer"
                    placeholder="Berikan jawaban yang lengkap dan mudah dipahami" 
                    rows="6"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
                    required
                >{{ old('answer', $faq->answer) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Gunakan HTML sederhana untuk formatting (bold, italic, link, dll)</p>
            </div>
        </div>

        <!-- Categorization -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kategorisasi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Kategori *
                    </label>
                    <input 
                        name="category" 
                        id="category"
                        type="text"
                        placeholder="Contoh: Kehamilan, Persalinan, Nutrisi, Perkembangan Janin" 
                        value="{{ old('category', $faq->category) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        required
                        list="category-suggestions"
                    />
                    <datalist id="category-suggestions">
                        <option value="Kehamilan">
                        <option value="Persalinan">
                        <option value="Nutrisi">
                        <option value="Perkembangan Janin">
                        <option value="Komplikasi">
                        <option value="Gaya Hidup">
                        <option value="Pemeriksaan">
                        <option value="Obat-obatan">
                        <option value="Aktivitas Fisik">
                        <option value="Mental Health">
                    </datalist>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">
                        Tags (Kata Kunci)
                    </label>
                    <input 
                        name="tags" 
                        id="tags"
                        type="text"
                        placeholder="Contoh: kehamilan, trimester, mual, muntah, vitamin" 
                        value="{{ old('tags', is_array($faq->tags) ? implode(', ', $faq->tags) : $faq->tags) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                    <p class="text-sm text-gray-500 mt-1">Pisahkan dengan koma. Tags membantu pencarian.</p>
                </div>
            </div>
        </div>

        <!-- Display Settings -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Tampilan</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status Publikasi *
                    </label>
                    <select name="status" id="status" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" required>
                        <option value="draft" {{ old('status', $faq->status) == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                        <option value="published" {{ old('status', $faq->status) == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="order_position">
                        Urutan Tampilan
                    </label>
                    <input 
                        name="order_position" 
                        id="order_position"
                        type="number"
                        placeholder="1" 
                        value="{{ old('order_position', $faq->order_position) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        min="1"
                    />
                    <p class="text-sm text-gray-500 mt-1">Angka lebih kecil akan ditampilkan lebih dulu</p>
                </div>
            </div>

            <div class="mt-4">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        id="is_featured"
                        value="1"
                        {{ old('is_featured', $faq->is_featured) ? 'checked' : '' }}
                        class="mr-2"
                    />
                    <label for="is_featured" class="text-gray-700 text-sm font-bold">
                        Jadikan FAQ Unggulan
                    </label>
                </div>
                <p class="text-sm text-gray-500 mt-1">FAQ unggulan akan ditampilkan lebih menonjol dan mudah ditemukan</p>
            </div>
        </div>

        <!-- Statistics & Metadata -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik & Metadata</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="view_count">
                        Jumlah Views
                    </label>
                    <input 
                        name="view_count" 
                        id="view_count"
                        type="number"
                        placeholder="0" 
                        value="{{ old('view_count', $faq->view_count) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        min="0"
                    />
                    <p class="text-sm text-gray-500 mt-1">Views saat ini: {{ number_format($faq->view_count) }}</p>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="like_count">
                        Jumlah Likes
                    </label>
                    <input 
                        name="like_count" 
                        id="like_count"
                        type="number"
                        placeholder="0" 
                        value="{{ old('like_count', $faq->like_count) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        min="0"
                    />
                    <p class="text-sm text-gray-500 mt-1">Likes saat ini: {{ number_format($faq->like_count) }}</p>
                </div>
            </div>

            <!-- Preview Current FAQ -->
            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-md font-semibold text-gray-800 mb-2">Preview FAQ Saat Ini</h4>
                <div class="border-l-4 border-blue-500 pl-4">
                    <h5 class="font-medium text-gray-800 mb-2">{{ $faq->question }}</h5>
                    <div class="text-gray-700 text-sm">
                        {!! Str::limit(strip_tags($faq->answer), 200) !!}
                        @if(strlen(strip_tags($faq->answer)) > 200)
                            <span class="text-blue-500">... (truncated)</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button 
                type="submit"
                class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Update FAQ
            </button>
            <div class="space-x-2">
                <a 
                    href="{{ route('admin.faqs.show', $faq) }}" 
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
                >
                    Lihat FAQ
                </a>
                <a 
                    href="{{ route('admin.faqs.index') }}" 
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
                >
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
// Auto-suggest category based on question keywords (only if category is different)
document.getElementById('question').addEventListener('input', function() {
    const question = this.value.toLowerCase();
    const categoryInput = document.getElementById('category');
    const currentCategory = '{{ $faq->category }}';
    
    // Don't auto-suggest if user has manually changed the category
    if (categoryInput.value === currentCategory) {
        if (question.includes('mual') || question.includes('muntah') || question.includes('morning sickness')) {
            categoryInput.value = 'Komplikasi';
        } else if (question.includes('nutrisi') || question.includes('makanan') || question.includes('vitamin')) {
            categoryInput.value = 'Nutrisi';
        } else if (question.includes('persalinan') || question.includes('melahirkan') || question.includes('kontraksi')) {
            categoryInput.value = 'Persalinan';
        } else if (question.includes('trimester') || question.includes('perkembangan') || question.includes('janin')) {
            categoryInput.value = 'Perkembangan Janin';
        } else if (question.includes('olahraga') || question.includes('senam') || question.includes('aktivitas')) {
            categoryInput.value = 'Aktivitas Fisik';
        } else if (question.includes('obat') || question.includes('medication') || question.includes('suplemen')) {
            categoryInput.value = 'Obat-obatan';
        } else if (question.includes('pemeriksaan') || question.includes('usg') || question.includes('check')) {
            categoryInput.value = 'Pemeriksaan';
        } else if (question.includes('stress') || question.includes('cemas') || question.includes('depresi')) {
            categoryInput.value = 'Mental Health';
        } else if (question.includes('hamil') || question.includes('kehamilan')) {
            categoryInput.value = 'Kehamilan';
        }
    }
});
</script>
@endsection