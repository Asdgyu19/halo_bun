@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- FAQ Header -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                            {{ $faq->category }}
                        </span>
                        @if($faq->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-400 text-yellow-800">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold mb-2">{{ $faq->question }}</h1>
                    <div class="flex items-center space-x-6 text-sm opacity-90">
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ number_format($faq->view_count) }} views</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-thumbs-up mr-1"></i>
                            <span>{{ number_format($faq->like_count) }} likes</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-1"></i>
                            <span>{{ $faq->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <i class="fas fa-question-circle text-6xl opacity-30"></i>
                </div>
            </div>
        </div>

        <!-- FAQ Answer -->
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-comment-dots text-blue-500 mr-2"></i>
                Jawaban
            </h2>
            <div class="prose max-w-none bg-gray-50 rounded-lg p-6">
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $faq->answer }}
                </div>
            </div>

            <!-- Tags -->
            @if($faq->tags)
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-tags text-purple-500 mr-2"></i>
                    Kata Kunci
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($faq->tags_array as $tag)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            #{{ trim($tag) }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Like Section -->
            <div class="mt-6 border-t pt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button data-faq-id="{{ $faq->id }}" onclick="likeFaq(this.dataset.faqId)" 
                                class="flex items-center space-x-2 text-green-600 hover:text-green-700 transition-colors">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Helpful ({{ number_format($faq->like_count) }})</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-700 transition-colors">
                            <i class="fas fa-share"></i>
                            <span>Share</span>
                        </button>
                    </div>
                    <div class="text-sm text-gray-500">
                        Dilihat {{ number_format($faq->view_count) }} kali
                    </div>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="mt-4">
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($faq->question) }}" 
                       target="_blank"
                       class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($faq->question . ' - ' . request()->fullUrl()) }}" 
                       target="_blank"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                    <button data-url="{{ request()->fullUrl() }}" onclick="copyToClipboard(this.dataset.url)"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                        <i class="fas fa-link mr-2"></i> Copy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related FAQs -->
    @if($relatedFaqs->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">FAQ Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($relatedFaqs as $relatedFaq)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $relatedFaq->category }}
                    </span>
                    @if($relatedFaq->is_featured)
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-800 mb-3 line-clamp-2">{{ $relatedFaq->question }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($relatedFaq->answer), 120) }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span>{{ number_format($relatedFaq->view_count) }} views</span>
                    <span>{{ $relatedFaq->created_at->diffForHumans() }}</span>
                </div>
                <a href="{{ route('faq.show', $relatedFaq) }}" 
                   class="block bg-[var(--blue)] hover:bg-blue-700 text-white text-center py-2 rounded-lg transition-colors">
                    Baca Jawaban
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Navigation -->
    <div class="text-center">
        <a href="{{ route('faq.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar FAQ
        </a>
    </div>
</div>

<script>
function likeFaq(faqId) {
    // You can implement AJAX call to like FAQ here
    alert('Terima kasih atas feedback Anda!');
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link berhasil disalin!');
    }, function(err) {
        console.error('Gagal menyalin link: ', err);
    });
}
</script>
@endsection