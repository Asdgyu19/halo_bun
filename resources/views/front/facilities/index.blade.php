@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Fasilitas Kesehatan Terdekat</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Temukan rumah sakit, klinik, apotek, dan fasilitas kesehatan lainnya di sekitar Anda
        </p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('facilities.index') }}" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari nama fasilitas, alamat, atau layanan..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" 
                        class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                <button type="button" 
                        onclick="getLocationAndSearch()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                    <i class="fas fa-location-arrow mr-2"></i> Cari Terdekat
                </button>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Type Filter -->
                <select name="type" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Jenis</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            @php
                                $typeLabels = [
                                    'hospital' => 'Rumah Sakit',
                                    'clinic' => 'Klinik', 
                                    'pharmacy' => 'Apotek',
                                    'laboratory' => 'Laboratorium',
                                    'emergency' => 'UGD'
                                ];
                            @endphp
                            {{ $typeLabels[$type] ?? ucfirst($type) }}
                        </option>
                    @endforeach
                </select>

                <!-- City Filter -->
                <select name="city" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>

                <!-- Verified Filter -->
                <select name="verified" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="yes" {{ request('verified') == 'yes' ? 'selected' : '' }}>Terverifikasi</option>
                </select>

                <!-- 24 Hours Filter -->
                <select name="hours_24" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Jam</option>
                    <option value="yes" {{ request('hours_24') == 'yes' ? 'selected' : '' }}>24 Jam</option>
                </select>

                <!-- Emergency Filter -->
                <select name="emergency" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Layanan</option>
                    <option value="yes" {{ request('emergency') == 'yes' ? 'selected' : '' }}>Gawat Darurat</option>
                </select>
            </div>

            <!-- Current Location Display -->
            <div id="location-status" class="hidden bg-green-50 border border-green-200 rounded-lg p-3">
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                    <span class="text-green-800">Mencari berdasarkan lokasi Anda...</span>
                </div>
            </div>

            <!-- Hidden location fields -->
            <input type="hidden" name="lat" id="user-lat" value="{{ request('lat') }}">
            <input type="hidden" name="lng" id="user-lng" value="{{ request('lng') }}">
        </form>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">
            Menampilkan {{ $facilities->count() }} dari {{ $facilities->total() }} fasilitas
            @if(request('search'))
                untuk "<strong>{{ request('search') }}</strong>"
            @endif
        </p>
        
        @if(request()->anyFilled(['search', 'type', 'city', 'verified', 'hours_24', 'emergency']))
        <a href="{{ route('facilities.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
            <i class="fas fa-times mr-1"></i> Reset Filter
        </a>
        @endif
    </div>

    <!-- Facilities Grid -->
    @if($facilities->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @php
            $typeConfig = [
                'hospital' => ['icon' => 'fas fa-hospital', 'class' => 'bg-blue-500', 'label' => 'Rumah Sakit'],
                'clinic' => ['icon' => 'fas fa-clinic-medical', 'class' => 'bg-green-500', 'label' => 'Klinik'],
                'pharmacy' => ['icon' => 'fas fa-pills', 'class' => 'bg-purple-500', 'label' => 'Apotek'],
                'laboratory' => ['icon' => 'fas fa-flask', 'class' => 'bg-yellow-500', 'label' => 'Laboratorium'],
                'emergency' => ['icon' => 'fas fa-ambulance', 'class' => 'bg-red-500', 'label' => 'UGD']
            ];
        @endphp
        
        @foreach($facilities as $facility)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Image -->
            @if($facility->image)
                <img src="{{ Storage::url($facility->image) }}" 
                     alt="{{ $facility->name }}" 
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                    @php $config = $typeConfig[$facility->type] ?? ['icon' => 'fas fa-hospital-alt', 'class' => 'bg-gray-500']; @endphp
                    <i class="{{ $config['icon'] }} text-white text-4xl"></i>
                </div>
            @endif

            <!-- Content -->
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-3">
                    @php $config = $typeConfig[$facility->type] ?? ['icon' => 'fas fa-building', 'class' => 'bg-gray-500', 'label' => ucfirst($facility->type)]; @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }} text-white">
                        <i class="{{ $config['icon'] }} mr-1"></i>
                        {{ $config['label'] }}
                    </span>
                    
                    <div class="flex space-x-1">
                        @if(request()->filled(['lat', 'lng']) && isset($facility->distance))
                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ number_format($facility->distance, 1) }} km
                            </span>
                        @endif
                        @if($facility->is_verified)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                        @endif
                        @if($facility->is_24_hours)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">24h</span>
                        @endif
                        @if($facility->is_emergency)
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Emergency</span>
                        @endif
                    </div>
                </div>

                <!-- Title -->
                <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">{{ $facility->name }}</h3>

                <!-- Address -->
                <div class="flex items-start text-gray-600 mb-3">
                    <i class="fas fa-map-marker-alt mt-1 mr-2 text-red-500"></i>
                    <div class="text-sm">
                        <p class="line-clamp-2">{{ $facility->address }}</p>
                        <p>{{ $facility->district ? $facility->district . ', ' : '' }}{{ $facility->city }}</p>
                    </div>
                </div>

                <!-- Distance (if available) -->
                @if(isset($facility->distance) && $facility->distance < 999)
                <div class="flex items-center text-gray-600 mb-3">
                    <i class="fas fa-route mr-2 text-blue-500"></i>
                    <span class="text-sm">{{ number_format($facility->distance, 1) }} km dari lokasi Anda</span>
                </div>
                @endif

                <!-- Contact Info -->
                <div class="space-y-2 mb-4">
                    @if($facility->phone)
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone mr-2 text-green-500 w-4"></i>
                        <span class="text-sm">{{ $facility->phone }}</span>
                    </div>
                    @endif
                    
                    @if($facility->operating_hours)
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-clock mr-2 text-purple-500 w-4"></i>
                        <span class="text-sm">{{ $facility->operating_hours }}</span>
                    </div>
                    @endif
                </div>

                <!-- Services Preview -->
                @if($facility->services && is_array($facility->services))
                <div class="mb-4">
                    <div class="flex flex-wrap gap-1">
                        @foreach(array_slice($facility->services, 0, 3) as $service)
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
                            {{ trim($service) }}
                        </span>
                        @endforeach
                        @if(count($facility->services) > 3)
                        <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs">
                            +{{ count($facility->services) - 3 }} lainnya
                        </span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('facilities.show', $facility) }}" 
                       class="flex-1 bg-[var(--blue)] hover:bg-blue-700 text-white text-center py-2 rounded-lg text-sm font-medium transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $facilities->appends(request()->query())->links() }}
    </div>
    @else
    <!-- No Results -->
    <div class="text-center py-12">
        <div class="bg-white rounded-lg shadow-md p-8">
            <i class="fas fa-hospital-alt text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada fasilitas ditemukan</h3>
            <p class="text-gray-500 mb-4">
                @if(request()->anyFilled(['search', 'type', 'city', 'verified', 'hours_24', 'emergency']))
                    Coba ubah kriteria pencarian atau filter Anda
                @else
                    Belum ada fasilitas kesehatan yang terdaftar
                @endif
            </p>
            @if(request()->anyFilled(['search', 'type', 'city', 'verified', 'hours_24', 'emergency']))
            <a href="{{ route('facilities.index') }}" 
               class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Reset Pencarian
            </a>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
function getLocationAndSearch() {
    const statusDiv = document.getElementById('location-status');
    const latInput = document.getElementById('user-lat');
    const lngInput = document.getElementById('user-lng');
    
    if (!navigator.geolocation) {
        alert('Geolokasi tidak didukung oleh browser Anda');
        return;
    }
    
    statusDiv.classList.remove('hidden');
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            latInput.value = position.coords.latitude;
            lngInput.value = position.coords.longitude;
            
            // Clear search field when doing location search to avoid conflicts
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.value = '';
            }
            
            // Submit form automatically
            document.querySelector('form').submit();
        },
        function(error) {
            statusDiv.classList.add('hidden');
            let errorMessage = 'Tidak dapat mengakses lokasi Anda';
            
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = 'Akses lokasi ditolak. Mohon izinkan akses lokasi untuk menggunakan fitur ini.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = 'Informasi lokasi tidak tersedia.';
                    break;
                case error.TIMEOUT:
                    errorMessage = 'Waktu tunggu habis saat mencoba mendapatkan lokasi.';
                    break;
            }
            
            alert(errorMessage);
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 60000
        }
    );
}

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('select[name]');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            // Delay submit to prevent conflicts
            setTimeout(() => {
                this.form.submit();
            }, 100);
        });
    });
});
</script>
@endsection