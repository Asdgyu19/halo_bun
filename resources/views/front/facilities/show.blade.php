@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Facility Header -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
        <!-- Header Image -->
        @if($facility->image)
        <div class="h-64 bg-cover bg-center" style="background-image: url('{{ Storage::url($facility->image) }}');">
            <div class="h-full bg-black bg-opacity-50 flex items-end">
                <div class="p-6 text-white">
                    <h1 class="text-3xl font-bold mb-2">{{ $facility->name }}</h1>
                    <div class="flex items-center space-x-4">
                        @php
                            $typeConfig = [
                                'hospital' => ['icon' => 'fas fa-hospital', 'class' => 'bg-blue-500', 'label' => 'Rumah Sakit'],
                                'clinic' => ['icon' => 'fas fa-clinic-medical', 'class' => 'bg-green-500', 'label' => 'Klinik'],
                                'pharmacy' => ['icon' => 'fas fa-pills', 'class' => 'bg-purple-500', 'label' => 'Apotek'],
                                'laboratory' => ['icon' => 'fas fa-flask', 'class' => 'bg-yellow-500', 'label' => 'Laboratorium'],
                                'emergency' => ['icon' => 'fas fa-ambulance', 'class' => 'bg-red-500', 'label' => 'UGD']
                            ];
                            $config = $typeConfig[$facility->type] ?? ['icon' => 'fas fa-building', 'class' => 'bg-gray-500', 'label' => ucfirst($facility->type)];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $config['class'] }} text-white">
                            <i class="{{ $config['icon'] }} mr-1"></i>
                            {{ $config['label'] }}
                        </span>
                        @if($facility->is_verified)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500 text-white">
                                <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                            </span>
                        @endif
                        @if($facility->is_24_hours)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-500 text-white">
                                <i class="fas fa-clock mr-1"></i> 24 Jam
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="h-64 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
            <div class="text-center text-white">
                <i class="{{ $config['icon'] ?? 'fas fa-hospital-alt' }} text-6xl mb-4"></i>
                <h1 class="text-3xl font-bold">{{ $facility->name }}</h1>
                <p class="text-xl">{{ $config['label'] ?? ucfirst($facility->type) }}</p>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Main Info -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    @if($facility->description)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Tentang Fasilitas</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $facility->description }}</p>
                    </div>
                    @endif

                    <!-- Services -->
                    @if($facility->services && is_array($facility->services) && count($facility->services) > 0)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Layanan Tersedia</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($facility->services as $service)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">{{ trim($service) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Location -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Lokasi & Alamat</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-500 mt-1 mr-3"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $facility->address }}</p>
                                    <p class="text-gray-600">{{ $facility->district ? $facility->district . ', ' : '' }}{{ $facility->city }}</p>
                                    @if($facility->latitude && $facility->longitude)
                                    <div class="mt-3 space-x-2">
                                        <a href="https://www.google.com/maps/@{{ $facility->latitude }},{{ $facility->longitude }},15z" 
                                           target="_blank"
                                           class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded-lg">
                                            <i class="fas fa-map mr-2"></i> Lihat di Google Maps
                                        </a>
                                        <a href="https://maps.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}" 
                                           target="_blank"
                                           class="inline-flex items-center bg-green-500 hover:bg-green-700 text-white text-sm px-3 py-2 rounded-lg">
                                            <i class="fas fa-directions mr-2"></i> Petunjuk Arah
                                        </a>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        GPS: {{ number_format($facility->latitude, 6) }}, {{ number_format($facility->longitude, 6) }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact & Details -->
                <div class="lg:col-span-1">
                    <!-- Contact Information -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kontak</h3>
                        
                        @if($facility->phone)
                        <div class="flex items-center mb-4">
                            <i class="fas fa-phone text-blue-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-gray-700 font-medium">{{ $facility->phone }}</p>
                                <a href="tel:{{ $facility->phone }}" 
                                   class="text-blue-500 hover:underline text-sm">Telepon Sekarang</a>
                            </div>
                        </div>
                        @endif

                        @if($facility->website)
                        <div class="flex items-center mb-4">
                            <i class="fas fa-globe text-green-500 mr-3 w-5"></i>
                            <div>
                                <a href="{{ $facility->website }}" target="_blank" 
                                   class="text-blue-500 hover:underline">Website Resmi</a>
                            </div>
                        </div>
                        @endif

                        @if($facility->operating_hours)
                        <div class="flex items-center mb-4">
                            <i class="fas fa-clock text-purple-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-gray-700 font-medium">{{ $facility->operating_hours }}</p>
                                @if($facility->is_24_hours)
                                <span class="text-green-600 text-sm font-medium">Buka 24 Jam</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($facility->is_emergency)
                        <div class="flex items-center">
                            <i class="fas fa-ambulance text-red-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-red-600 font-medium">Layanan Gawat Darurat</p>
                                <span class="text-red-500 text-sm">Tersedia 24/7</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-3">
                        @if($facility->phone)
                        <a href="tel:{{ $facility->phone }}"
                           class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg text-center block">
                            <i class="fas fa-phone mr-2"></i> Hubungi Sekarang
                        </a>
                        @endif
                        
                        @if($facility->latitude && $facility->longitude)
                        <a href="https://www.google.com/maps/search/{{ urlencode($facility->name) }}/@{{ $facility->latitude }},{{ $facility->longitude }},15z" 
                           target="_blank"
                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg text-center block">
                            <i class="fas fa-map-marked-alt mr-2"></i> Buka di Maps
                        </a>
                        @endif

                        <button onclick="shareFacility()" 
                                class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-lg">
                            <i class="fas fa-share mr-2"></i> Bagikan Fasilitas
                        </button>
                    </div>

                    <!-- Rating & Reviews (Future Feature) -->
                    <div class="bg-gray-50 rounded-lg p-4 mt-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Rating & Ulasan</h4>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-600 text-sm">4.0 dari 5</span>
                        </div>
                        <p class="text-gray-500 text-sm">Berdasarkan ulasan pengguna</p>
                        <button class="mt-2 text-blue-500 hover:underline text-sm">
                            Tulis Ulasan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nearby Facilities -->
    @if($nearbyFacilities->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Fasilitas Terdekat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($nearbyFacilities as $nearbyFacility)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($nearbyFacility->image)
                    <img src="{{ Storage::url($nearbyFacility->image) }}" 
                         alt="{{ $nearbyFacility->name }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <i class="{{ $typeConfig[$nearbyFacility->type]['icon'] ?? 'fas fa-hospital-alt' }} text-white text-3xl"></i>
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeConfig[$nearbyFacility->type]['class'] ?? 'bg-gray-500' }} text-white">
                            {{ $typeConfig[$nearbyFacility->type]['label'] ?? ucfirst($nearbyFacility->type) }}
                        </span>
                        @if($nearbyFacility->is_24_hours)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">24 Jam</span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $nearbyFacility->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $nearbyFacility->address }}</p>
                    <p class="text-gray-500 text-xs mb-3">{{ $nearbyFacility->city }}</p>
                    <a href="{{ route('facilities.show', $nearbyFacility) }}" 
                       class="block bg-[var(--blue)] hover:bg-blue-700 text-white text-center py-2 rounded-lg transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Navigation -->
    <div class="text-center">
        <a href="{{ route('facilities.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Fasilitas
        </a>
    </div>
</div>

<script>
function shareFacility() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $facility->name }}',
            text: '{{ $facility->description }}',
            url: window.location.href
        });
    } else {
        // Fallback
        copyToClipboard(window.location.href);
        alert('Link berhasil disalin!');
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        console.log('Link copied successfully');
    }, function(err) {
        console.error('Failed to copy link: ', err);
    });
}
</script>
@endsection