@extends('layouts.app')

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

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--blue)]">Detail Fasilitas Kesehatan</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.facilities.edit', $facility) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.facilities.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Image -->
        @if($facility->image)
        <div class="h-64 bg-cover bg-center" style="background-image: url('{{ Storage::url($facility->image) }}');">
            <div class="h-full bg-black bg-opacity-50 flex items-end">
                <div class="p-6 text-white">
                    <h2 class="text-3xl font-bold mb-2">{{ $facility->name }}</h2>
                    <div class="flex items-center space-x-4">
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
                <h2 class="text-3xl font-bold">{{ $facility->name }}</h2>
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
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Deskripsi</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $facility->description }}</p>
                    </div>
                    @endif

                    <!-- Services -->
                    @if($facility->services && is_array($facility->services) && count($facility->services) > 0)
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Layanan Tersedia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($facility->services as $service)
                            <div class="flex items-center p-2 bg-gray-50 rounded">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">{{ trim($service) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Location -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Lokasi</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-500 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $facility->address }}</p>
                                    <p class="text-gray-600">{{ $facility->district ? $facility->district . ', ' : '' }}{{ $facility->city }}</p>
                                    @if($facility->latitude && $facility->longitude)
                                    <div class="mt-2 space-x-2">
                                        <a href="https://www.google.com/maps/@{{ $facility->latitude }},{{ $facility->longitude }},15z" 
                                           target="_blank"
                                           class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">
                                            <i class="fas fa-map mr-1"></i> Google Maps
                                        </a>
                                        <a href="https://maps.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}" 
                                           target="_blank"
                                           class="inline-flex items-center bg-green-500 hover:bg-green-700 text-white text-sm px-3 py-1 rounded">
                                            <i class="fas fa-directions mr-1"></i> Petunjuk Arah
                                        </a>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        GPS: {{ $facility->latitude ?? 'N/A' }}, {{ $facility->longitude ?? 'N/A' }}
                                    </p>
                                    @else
                                    <p class="text-xs text-gray-500 mt-1">Koordinat GPS belum diatur</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact & Details -->
                <div class="lg:col-span-1">
                    <!-- Contact Information -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Kontak</h3>
                        
                        @if($facility->phone)
                        <div class="flex items-center mb-3">
                            <i class="fas fa-phone text-blue-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-gray-700">{{ $facility->phone }}</p>
                                <a href="tel:{{ $facility->phone }}" 
                                   class="text-blue-500 hover:underline text-sm">Telepon Sekarang</a>
                            </div>
                        </div>
                        @endif

                        @if($facility->website)
                        <div class="flex items-center mb-3">
                            <i class="fas fa-globe text-green-500 mr-3 w-5"></i>
                            <div>
                                <a href="{{ $facility->website }}" target="_blank" 
                                   class="text-blue-500 hover:underline">Website Resmi</a>
                            </div>
                        </div>
                        @endif

                        @if($facility->operating_hours)
                        <div class="flex items-center">
                            <i class="fas fa-clock text-purple-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-gray-700">{{ $facility->operating_hours }}</p>
                                @if($facility->is_24_hours)
                                <span class="text-green-600 text-sm font-medium">Buka 24 Jam</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Facility Details -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Fasilitas</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tipe:</span>
                                <span class="font-medium">{{ $config['label'] }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kota:</span>
                                <span class="font-medium">{{ $facility->city }}</span>
                            </div>
                            
                            @if($facility->district)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kecamatan:</span>
                                <span class="font-medium">{{ $facility->district }}</span>
                            </div>
                            @endif
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Gawat Darurat:</span>
                                <span class="font-medium">
                                    @if($facility->is_emergency)
                                        <span class="text-green-600">Tersedia</span>
                                    @else
                                        <span class="text-red-600">Tidak</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">
                                    @if($facility->is_verified)
                                        <span class="text-green-600">Terverifikasi</span>
                                    @else
                                        <span class="text-yellow-600">Belum Terverifikasi</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span class="font-medium">{{ $facility->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diupdate:</span>
                                <span class="font-medium">{{ $facility->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Oleh:</span>
                                <span class="font-medium">{{ $facility->user->name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-2">
                        @if($facility->latitude && $facility->longitude)
                        <a href="https://www.google.com/maps/search/{{ urlencode($facility->name) }}/@{{ $facility->latitude }},{{ $facility->longitude }},15z" 
                           target="_blank"
                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center block">
                            <i class="fas fa-map-marked-alt mr-2"></i> Cari di Google Maps
                        </a>
                        @endif
                        
                        @if($facility->phone)
                        <a href="tel:{{ $facility->phone }}"
                           class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center block">
                            <i class="fas fa-phone mr-2"></i> Hubungi Sekarang
                        </a>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.facilities.destroy', $facility) }}" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash mr-2"></i> Hapus Fasilitas
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection