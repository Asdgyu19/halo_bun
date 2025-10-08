@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-[var(--blue)] mb-6">Edit Fasilitas Kesehatan</h1>
    
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

    <form method="POST" action="{{ route('admin.facilities.update', $facility) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama Fasilitas *
                    </label>
                    <input 
                        name="name" 
                        id="name"
                        type="text"
                        placeholder="Nama rumah sakit, klinik, apotek, dll" 
                        value="{{ old('name', $facility->name) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        required
                    />
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                        Tipe Fasilitas *
                    </label>
                    <select name="type" id="type" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" required>
                        <option value="">Pilih Tipe Fasilitas</option>
                        <option value="hospital" {{ old('type', $facility->type) == 'hospital' ? 'selected' : '' }}>Rumah Sakit</option>
                        <option value="clinic" {{ old('type', $facility->type) == 'clinic' ? 'selected' : '' }}>Klinik</option>
                        <option value="pharmacy" {{ old('type', $facility->type) == 'pharmacy' ? 'selected' : '' }}>Apotek</option>
                        <option value="laboratory" {{ old('type', $facility->type) == 'laboratory' ? 'selected' : '' }}>Laboratorium</option>
                        <option value="emergency" {{ old('type', $facility->type) == 'emergency' ? 'selected' : '' }}>Unit Gawat Darurat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Nomor Telepon
                    </label>
                    <input 
                        name="phone" 
                        id="phone"
                        type="tel"
                        placeholder="(021) 1234567 atau 0812-3456-7890" 
                        value="{{ old('phone', $facility->phone) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Deskripsi
                </label>
                <textarea 
                    name="description" 
                    id="description"
                    placeholder="Deskripsi singkat tentang fasilitas ini" 
                    rows="3"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
                >{{ old('description', $facility->description) }}</textarea>
            </div>
        </div>

        <!-- Location Information -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Lokasi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="city">
                        Kota *
                    </label>
                    <input 
                        name="city" 
                        id="city"
                        type="text"
                        placeholder="Jakarta, Bandung, Surabaya, dll" 
                        value="{{ old('city', $facility->city) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                        required
                    />
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="district">
                        Kecamatan
                    </label>
                    <input 
                        name="district" 
                        id="district"
                        type="text"
                        placeholder="Nama kecamatan" 
                        value="{{ old('district', $facility->district) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Alamat Lengkap *
                </label>
                <textarea 
                    name="address" 
                    id="address"
                    placeholder="Alamat lengkap fasilitas kesehatan" 
                    rows="2"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
                    required
                >{{ old('address', $facility->address) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">
                        Latitude (GPS)
                    </label>
                    <input 
                        name="latitude" 
                        id="latitude"
                        type="number"
                        step="any"
                        placeholder="-6.200000" 
                        value="{{ old('latitude', $facility->latitude) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">
                        Longitude (GPS)
                    </label>
                    <input 
                        name="longitude" 
                        id="longitude"
                        type="number"
                        step="any"
                        placeholder="106.816666" 
                        value="{{ old('longitude', $facility->longitude) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>
            </div>
            
            <div class="mt-2">
                <button type="button" onclick="getCurrentLocation()" 
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                    <i class="fas fa-map-marker-alt mr-2"></i> Update Lokasi Saat Ini
                </button>
                @if($facility->latitude && $facility->longitude)
                <a href="https://www.google.com/maps/@{{ $facility->latitude }},{{ $facility->longitude }},15z" 
                   target="_blank"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm ml-2">
                    <i class="fas fa-map mr-2"></i> Lihat di Google Maps
                </a>
                @endif
                <p class="text-sm text-gray-500 mt-1">GPS koordinat digunakan untuk pencarian fasilitas terdekat</p>
            </div>
        </div>

        <!-- Contact & Additional Info -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kontak & Informasi Tambahan</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                        Website
                    </label>
                    <input 
                        name="website" 
                        id="website"
                        type="url"
                        placeholder="https://www.example.com" 
                        value="{{ old('website', $facility->website) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="operating_hours">
                        Jam Operasional
                    </label>
                    <input 
                        name="operating_hours" 
                        id="operating_hours"
                        type="text"
                        placeholder="08:00 - 21:00 atau 24 Jam" 
                        value="{{ old('operating_hours', $facility->operating_hours) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                    />
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="services">
                    Layanan Tersedia
                </label>
                <textarea 
                    name="services" 
                    id="services"
                    placeholder="Contoh: IGD 24 jam, Rawat Inap, Poliklinik Umum, Laboratorium, Radiologi" 
                    rows="3"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]"
                >{{ old('services', is_array($facility->services) ? implode(', ', $facility->services) : $facility->services) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Pisahkan setiap layanan dengan koma</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Gambar Fasilitas
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="image"
                    accept="image/*"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:border-[var(--blue)]" 
                />
                <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB. (Kosongkan jika tidak ingin mengubah)</p>
                
                @if($facility->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                    <img src="{{ Storage::url($facility->image) }}" alt="Current image" class="w-32 h-24 object-cover rounded">
                </div>
                @endif
            </div>
        </div>

        <!-- Settings -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan</h3>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_24_hours" 
                        id="is_24_hours"
                        value="1"
                        {{ old('is_24_hours', $facility->is_24_hours) ? 'checked' : '' }}
                        class="mr-2"
                    />
                    <label for="is_24_hours" class="text-gray-700 text-sm font-bold">
                        Buka 24 Jam
                    </label>
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_emergency" 
                        id="is_emergency"
                        value="1"
                        {{ old('is_emergency', $facility->is_emergency) ? 'checked' : '' }}
                        class="mr-2"
                    />
                    <label for="is_emergency" class="text-gray-700 text-sm font-bold">
                        Memiliki Layanan Gawat Darurat
                    </label>
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_verified" 
                        id="is_verified"
                        value="1"
                        {{ old('is_verified', $facility->is_verified) ? 'checked' : '' }}
                        class="mr-2"
                    />
                    <label for="is_verified" class="text-gray-700 text-sm font-bold">
                        Tandai sebagai Terverifikasi
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button 
                type="submit"
                class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
            >
                Update Fasilitas
            </button>
            <div class="space-x-2">
                <a 
                    href="{{ route('admin.facilities.show', $facility) }}" 
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
                >
                    Lihat Detail
                </a>
                <a 
                    href="{{ route('admin.facilities.index') }}" 
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200"
                >
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            alert('Lokasi GPS berhasil diperbarui!');
        }, function(error) {
            alert('Gagal mendapatkan lokasi: ' + error.message);
        });
    } else {
        alert('Geolocation tidak didukung oleh browser ini.');
    }
}

// Auto set 24 hours when emergency is checked
document.getElementById('is_emergency').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('is_24_hours').checked = true;
    }
});
</script>
@endsection