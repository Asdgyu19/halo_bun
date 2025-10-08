@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--blue)]">Kelola Fasilitas Kesehatan</h1>
        <a href="{{ route('admin.facilities.create') }}" 
           class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.facilities.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" 
                       name="search" 
                       placeholder="Cari nama fasilitas..." 
                       value="{{ request('search') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
            </div>
            <div>
                <select name="type" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Tipe</option>
                    <option value="hospital" {{ request('type') === 'hospital' ? 'selected' : '' }}>Rumah Sakit</option>
                    <option value="clinic" {{ request('type') === 'clinic' ? 'selected' : '' }}>Klinik</option>
                    <option value="pharmacy" {{ request('type') === 'pharmacy' ? 'selected' : '' }}>Apotek</option>
                    <option value="laboratory" {{ request('type') === 'laboratory' ? 'selected' : '' }}>Laboratorium</option>
                    <option value="emergency" {{ request('type') === 'emergency' ? 'selected' : '' }}>UGD</option>
                </select>
            </div>
            <div>
                <select name="city" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[var(--blue)]">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-[var(--blue)] hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                <a href="{{ route('admin.facilities.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-hospital text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Rumah Sakit</p>
                    <p class="text-lg font-semibold">{{ $stats['hospital'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-clinic-medical text-green-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Klinik</p>
                    <p class="text-lg font-semibold">{{ $stats['clinic'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-pills text-purple-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Apotek</p>
                    <p class="text-lg font-semibold">{{ $stats['pharmacy'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-flask text-yellow-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Lab</p>
                    <p class="text-lg font-semibold">{{ $stats['laboratory'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-ambulance text-red-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">UGD</p>
                    <p class="text-lg font-semibold">{{ $stats['emergency'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilities Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($facilities->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($facilities as $facility)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        @if($facility->image)
                                            <img class="h-16 w-16 rounded-lg object-cover" 
                                                 src="{{ Storage::url($facility->image) }}" 
                                                 alt="{{ $facility->name }}">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-hospital-alt text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $facility->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($facility->description, 50) }}
                                        </div>
                                        @if($facility->is_24_hours)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mt-1">
                                                <i class="fas fa-clock mr-1"></i> 24 Jam
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $typeConfig = [
                                        'hospital' => ['icon' => 'fas fa-hospital', 'class' => 'bg-blue-100 text-blue-800', 'label' => 'Rumah Sakit'],
                                        'clinic' => ['icon' => 'fas fa-clinic-medical', 'class' => 'bg-green-100 text-green-800', 'label' => 'Klinik'],
                                        'pharmacy' => ['icon' => 'fas fa-pills', 'class' => 'bg-purple-100 text-purple-800', 'label' => 'Apotek'],
                                        'laboratory' => ['icon' => 'fas fa-flask', 'class' => 'bg-yellow-100 text-yellow-800', 'label' => 'Laboratorium'],
                                        'emergency' => ['icon' => 'fas fa-ambulance', 'class' => 'bg-red-100 text-red-800', 'label' => 'UGD']
                                    ];
                                    $config = $typeConfig[$facility->type] ?? ['icon' => 'fas fa-building', 'class' => 'bg-gray-100 text-gray-800', 'label' => ucfirst($facility->type)];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
                                    <i class="{{ $config['icon'] }} mr-1"></i>
                                    {{ $config['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $facility->city }}</div>
                                <div class="text-sm text-gray-500">{{ $facility->address }}</div>
                                @if($facility->latitude && $facility->longitude)
                                    <div class="text-xs text-gray-400 mt-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ number_format($facility->latitude, 6) }}, {{ number_format($facility->longitude, 6) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($facility->phone)
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-phone mr-1"></i> {{ $facility->phone }}
                                    </div>
                                @endif
                                @if($facility->website)
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-globe mr-1"></i> 
                                        <a href="{{ $facility->website }}" target="_blank" class="hover:text-[var(--blue)]">Website</a>
                                    </div>
                                @endif
                                @if($facility->operating_hours)
                                    <div class="text-xs text-gray-400 mt-1">
                                        <i class="fas fa-clock mr-1"></i> {{ $facility->operating_hours }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($facility->is_verified)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                @endif
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $facility->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-1">
                                <a href="{{ route('admin.facilities.show', $facility) }}" 
                                   class="text-[var(--blue)] hover:text-blue-900 inline-flex items-center bg-blue-100 hover:bg-blue-200 px-2 py-1 rounded">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                                <a href="{{ route('admin.facilities.edit', $facility) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 inline-flex items-center bg-yellow-100 hover:bg-yellow-200 px-2 py-1 rounded">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.facilities.destroy', $facility) }}" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')" 
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
                {{ $facilities->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-hospital-alt text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada fasilitas kesehatan</h3>
                <p class="text-gray-500 mb-4">Mulai dengan menambahkan fasilitas kesehatan pertama.</p>
                <a href="{{ route('admin.facilities.create') }}" 
                   class="bg-[var(--blue)] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Fasilitas Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection