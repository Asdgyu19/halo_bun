@extends('layouts.app')

@section('content')
    {{-- Bagian utama dari halaman pregnancy tracker --}}
    <section class="py-10 md:py-14 pt-24 md:pt-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Title --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent mb-4">
                    Pregnancy Tracker
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Pantau perkembangan kehamilan Anda dengan kalkulator dan informasi trimester lengkap
                </p>
            </div>

            {{-- Navigation Tabs --}}
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 mb-8">
                <div class="flex flex-wrap justify-center border-b border-blue-100">
                    <button onclick="showTab('calculator')" 
                            class="tab-button active px-6 py-4 font-semibold text-blue-700 border-b-2 border-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Kalkulator Kehamilan
                    </button>
                    <button onclick="showTab('trimester')" 
                            class="tab-button px-6 py-4 font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Perkembangan Janin
                    </button>
                    <button onclick="showTab('weekly')" 
                            class="tab-button px-6 py-4 font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Trimester Per Minggu
                    </button>
                </div>
            </div>

            {{-- Tab Content: Calculator --}}
            <div id="calculator-tab" class="tab-content">
                <div class="rounded-2xl border border-blue-100 bg-white p-6 md:p-8 shadow-sm">
                    {{-- Judul Kalkulator --}}
                    <h2 class="text-2xl md:text-3xl font-semibold text-center text-gray-900 border-b border-blue-100 pb-4 mb-6">
                        Kalkulator Kehamilan
                    </h2>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    {{-- Kolom Input --}}
                    <div class="space-y-4">
                        {{-- Input HPHT --}}
                        <div class="form-group">
                            <label for="hpht" class="block text-sm font-medium text-gray-700 mb-1">Hari Pertama Haid
                                Terakhir (HPHT)</label>
                            <input type="date" id="hpht" name="hpht"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 text-base">
                        </div>

                        {{-- Input Siklus --}}
                        <div class="form-group">
                            <label for="siklus" class="block text-sm font-medium text-gray-700 mb-1">Lama Siklus
                                Menstruasi (Hari)</label>
                            <select id="siklus" name="siklus"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 text-base">
                                <option value="21">21 hari</option>
                                <option value="22">22 hari</option>
                                <option value="23">23 hari</option>
                                <option value="24">24 hari</option>
                                <option value="25">25 hari</option>
                                <option value="26">26 hari</option>
                                <option value="27">27 hari</option>
                                <option value="28" selected>28 hari (Normal)</option>
                                <option value="29">29 hari</option>
                                <option value="30">30 hari</option>
                                <option value="31">31 hari</option>
                                <option value="32">32 hari</option>
                                <option value="33">33 hari</option>
                                <option value="34">34 hari</option>
                                <option value="35">35 hari</option>
                            </select>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="button-group flex flex-col sm:flex-row gap-3">
                            <button
                                class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium hover:opacity-95 transition"
                                onclick="hitungKehamilan()" type="button">Hitung Kehamilan</button>
                            <button
                                class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition"
                                onclick="resetForm()" type="button">Reset</button>
                        </div>
                    </div>

                    {{-- Kolom Hasil --}}
                    <div id="hasil"
                        class="result-container mt-6 md:mt-0 rounded-xl border border-blue-100 bg-blue-50/60 p-5"
                        style="display: none;">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Hasil Perhitungan</h2>
                        <div id="hasil-detail" class="space-y-3">
                            {{-- Hasil akan dimasukkan oleh JavaScript di sini --}}
                        </div>
                    </div>
                </div>

                {{-- Semua konten informasi lainnya --}}
                <div class="mt-10 space-y-8">
                    <div class="info-section bg-white p-6 rounded-xl border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Tentang Kalkulator Kehamilan</h3>
                        <p class="text-gray-600">Kalkulator kehamilan adalah alat yang membantu menghitung usia kehamilan
                            dan memperkirakan Hari Perkiraan Lahir (HPL) berdasarkan Hari Pertama Haid Terakhir (HPHT) dan
                            lama siklus menstruasi. Perhitungan ini menggunakan metode Naegele yang telah terbukti akurat
                            untuk sebagian besar kehamilan.</p>
                        <ul class="info-list mt-4 space-y-2">
                            <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                    class="text-gray-700">Menghitung usia kehamilan dalam minggu dan hari</span></li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                    class="text-gray-700">Memperkirakan Hari Perkiraan Lahir (HPL)</span></li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                    class="text-gray-700">Menentukan trimester kehamilan saat ini</span></li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                    class="text-gray-700">Memberikan perkiraan tanggal konsepsi</span></li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                    class="text-gray-700">Menampilkan informasi perkembangan janin</span></li>
                        </ul>
                    </div>

                    <div class="tips-grid grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="tip-card bg-white p-6 rounded-xl border border-gray-200">
                            <h4 class="font-semibold text-blue-600 mb-3">Tips Trimester Pertama</h4>
                            <ul class="info-list space-y-2 text-sm">
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Konsumsi asam folat 400-600 mcg per hari</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Hindari alkohol dan merokok</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Perbanyak istirahat</span></li>
                            </ul>
                        </div>
                        <div class="tip-card bg-white p-6 rounded-xl border border-gray-200">
                            <h4 class="font-semibold text-blue-600 mb-3">Tips Trimester Kedua</h4>
                            <ul class="info-list space-y-2 text-sm">
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Mulai olahraga ringan</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Lakukan USG detail</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Jaga kenaikan berat badan</span></li>
                            </ul>
                        </div>
                        <div class="tip-card bg-white p-6 rounded-xl border border-gray-200">
                            <h4 class="font-semibold text-blue-600 mb-3">Tips Trimester Ketiga</h4>
                            <ul class="info-list space-y-2 text-sm">
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Siapkan tas persalinan</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Ikuti kelas laktasi</span></li>
                                <li class="flex items-start"><span class="text-blue-500 mr-2">✓</span><span
                                        class="text-gray-700">Pantau gerakan janin</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="warning bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded-r-lg">
                        <h4 class="font-bold">Penting untuk Diingat</h4>
                        <p>Hasil perhitungan ini hanya berupa perkiraan. Selalu konsultasikan dengan dokter kandungan untuk
                            pemantauan kehamilan yang lebih akurat.</p>
                    </div>
                </div>
            </div>
            </div>

            {{-- Tab Content: Trimester Development --}}
            <div id="trimester-tab" class="tab-content hidden">
                <div class="rounded-2xl border border-blue-100 bg-white p-6 md:p-8 shadow-sm">
                    <h2 class="text-2xl md:text-3xl font-semibold text-center text-gray-900 border-b border-blue-100 pb-4 mb-8">
                        Perkembangan Janin per Trimester
                    </h2>

                    <div class="space-y-12">
                        {{-- Trimester 1 --}}
                        <div class="trimester-card bg-gradient-to-r from-pink-50 to-rose-50 rounded-2xl p-8 border border-pink-100">
                            <div class="flex items-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    1
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Trimester Pertama</h3>
                                    <p class="text-gray-600">Minggu 1-12 (0-3 bulan)</p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Perkembangan Janin:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 1-4: Pembuahan dan implantasi</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 5-8: Organ utama mulai terbentuk</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 9-12: Jantung mulai berdetak, ukuran sekitar 6cm</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Gejala Ibu:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Morning sickness (mual muntah)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Kelelahan berlebihan</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-pink-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Payudara sensitif dan membesar</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Trimester 2 --}}
                        <div class="trimester-card bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-8 border border-purple-100">
                            <div class="flex items-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    2
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Trimester Kedua</h3>
                                    <p class="text-gray-600">Minggu 13-27 (4-6 bulan)</p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Perkembangan Janin:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 13-16: Jenis kelamin mulai terlihat</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 17-20: Gerakan janin mulai terasa</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 21-27: Berat sekitar 1kg, panjang 35cm</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Kondisi Ibu:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Energi mulai kembali</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Perut mulai membesar</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Nafsu makan meningkat</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Trimester 3 --}}
                        <div class="trimester-card bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-8 border border-blue-100">
                            <div class="flex items-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    3
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Trimester Ketiga</h3>
                                    <p class="text-gray-600">Minggu 28-40 (7-9 bulan)</p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Perkembangan Janin:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 28-32: Paru-paru berkembang pesat</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 33-36: Posisi kepala di bawah</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Minggu 37-40: Siap dilahirkan, berat 2.5-4kg</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Kondisi Ibu:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Sesak nafas karena tekanan diafragma</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Sering buang air kecil</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-3 mt-1">•</span>
                                            <span class="text-gray-700">Persiapan persalinan</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Content: Weekly Progress --}}
            <div id="weekly-tab" class="tab-content hidden">
                <div class="rounded-2xl border border-blue-100 bg-white p-6 md:p-8 shadow-sm">
                    <h2 class="text-2xl md:text-3xl font-semibold text-center text-gray-900 border-b border-blue-100 pb-4 mb-8">
                        Perkembangan Trimester Per Minggu
                    </h2>

                    {{-- Week Selector --}}
                    <div class="mb-8 bg-gray-50 p-6 rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Minggu Kehamilan:</h3>
                        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2">
                            @for ($week = 1; $week <= 40; $week++)
                                <button onclick="showWeekInfo({{ $week }})" 
                                        class="week-btn px-3 py-2 rounded-lg border text-sm font-medium transition-all duration-200
                                               {{ $week <= 12 ? 'border-pink-300 text-pink-600 hover:bg-pink-50' : 
                                                  ($week <= 27 ? 'border-purple-300 text-purple-600 hover:bg-purple-50' : 
                                                                  'border-blue-300 text-blue-600 hover:bg-blue-50') }}">
                                    {{ $week }}
                                </button>
                            @endfor
                        </div>
                    </div>

                    {{-- Week Information Display --}}
                    <div id="week-info" class="hidden">
                        <div id="week-content" class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                            {{-- Content will be populated by JavaScript --}}
                        </div>
                    </div>

                    {{-- Default message --}}
                    <div id="week-default" class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Pilih Minggu Kehamilan</h3>
                        <p class="text-gray-500">Klik salah satu nomor minggu di atas untuk melihat informasi perkembangan janin</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="weekly-guide" class="py-10 md:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<!-- 
            <header class="text-center max-w-3xl mx-auto">
                <h2 id="weekly-guide" class="text-3xl md:text-4xl font-semibold text-gray-900">
                    Panduan Perkembangan Janin per Minggu
                </h2>
                <p class="mt-3 text-gray-600">
                    Ikuti perjalanan menakjubkan si kecil dari minggu ke minggu, mulai dari pembuahan hingga menjelang
                    persalinan.
                </p>
            </header> -->

            <div class="mt-10 space-y-12">
                {{-- Loop untuk setiap Trimester --}}
                @foreach ($pregnancyData as $trimesterName => $trimesterData)
                    <div class="trimester-section">
                        <div class="sticky top-0  backdrop-blur-sm py-4 z-10 border-b-2 border-blue-200">
                            <h3 class="text-2xl font-bold text-blue-700">{{ $trimesterName }}</h3>
                            <p class="text-sm text-gray-600">{{ $trimesterData['range'] }}</p>
                        </div>

                        <div class="mt-6 space-y-8">
                            {{-- Loop untuk setiap Minggu di dalam Trimester --}}
                            @foreach ($trimesterData['weeks'] as $weekNumber => $weekData)
                                <div id="minggu-{{ $weekNumber }}"
                                    class="week-card grid grid-cols-1 md:grid-cols-3 gap-6 items-start bg-white p-5 rounded-2xl border border-blue-100 shadow-sm">

                                    {{-- Kolom Gambar --}}
                                    <div class="md:col-span-1 text-center">
                                        <h4 class="text-xl font-semibold text-gray-800">{{ $weekData['title'] }}</h4>
                                        <div class="w-full h-48 bg-blue-100 rounded-lg flex items-center justify-center my-4">
                                            <span class="text-blue-500 text-sm">Gambar Perkembangan</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-base font-medium text-gray-700">Bayi Bunda Seukuran
                                                {{ $weekData['size'] }}</p>
                                            <div class="mt-2 flex justify-center divide-x text-sm">
                                                <div class="px-3">
                                                    <p class="font-semibold text-blue-600">{{ $weekData['weight'] }}</p>
                                                    <p class="text-gray-500">Berat</p>
                                                </div>
                                                <div class="px-3">
                                                    <p class="font-semibold text-blue-600">{{ $weekData['height'] }}</p>
                                                    <p class="text-gray-500">Tinggi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Kolom Penjelasan --}}
                                    <div
                                        class="md:col-span-2 prose max-w-none prose-p:text-gray-600 prose-headings:text-gray-900 prose-strong:text-blue-600">
                                        {!! $weekData['content'] !!}

                                        @if (!empty($weekData['mom_tips']))
                                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                                <strong>Bunda Jangan Lupa</strong>
                                                <ul class="list-disc pl-5 mt-2 space-y-1">
                                                    @foreach ($weekData['mom_tips'] as $tip)
                                                        <li>{{ $tip }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (!empty($weekData['dad_tips']))
                                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                                <strong class="text-blue-600">Ayah Hebat</strong>
                                                <ul class="list-disc pl-5 mt-2 space-y-1">
                                                    @foreach ($weekData['dad_tips'] as $tip)
                                                        <li>{{ $tip }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Script untuk tab navigation dan weekly information --}}
    <script>
        // Tab Navigation
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
                button.classList.add('text-gray-600');
            });

            // Show selected tab content
            const selectedTab = document.getElementById(tabName + '-tab');
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Add active class to clicked button
            event.target.classList.add('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
            event.target.classList.remove('text-gray-600');
        }

        // Weekly Information Data
        const weeklyData = {
            1: { title: "Minggu 1 - Persiapan Tubuh", trimester: "Trimester 1", color: "pink", size: "Sel telur siap dibuahi", weight: "-", development: "Tubuh mempersiapkan diri untuk kehamilan. Ovulasi akan terjadi sekitar 2 minggu dari HPHT.", motherChanges: "Menstruasi berlangsung normal. Tubuh mempersiapkan lapisan rahim untuk kemungkinan kehamilan.", tips: "Mulai konsumsi asam folat, hindari alkohol dan rokok, jaga pola makan sehat." },
            4: { title: "Minggu 4 - Implantasi", trimester: "Trimester 1", color: "pink", size: "Sebesar biji poppy (2mm)", weight: "< 1 gram", development: "Blastokista menempel pada dinding rahim. Sel-sel mulai membelah dengan cepat.", motherChanges: "Mungkin mengalami bercak implantasi, payudara mulai sensitif, mood swing.", tips: "Lakukan tes kehamilan jika terlambat haid. Hindari stres berlebihan." },
            8: { title: "Minggu 8 - Pembentukan Organ", trimester: "Trimester 1", color: "pink", size: "Sebesar buah raspberry (1.6cm)", weight: "1 gram", development: "Organ vital mulai terbentuk. Jantung berdetak, tunas lengan dan kaki muncul.", motherChanges: "Morning sickness mencapai puncak, kelelahan, payudara membesar.", tips: "Makan dalam porsi kecil tapi sering, istirahat cukup, konsumsi vitamin prenatal." },
            12: { title: "Minggu 12 - Akhir Trimester 1", trimester: "Trimester 1", color: "pink", size: "Sebesar buah jeruk nipis (5-6cm)", weight: "14 gram", development: "Semua organ utama sudah terbentuk. Jari tangan dan kaki terpisah jelas.", motherChanges: "Morning sickness mulai berkurang, energi mulai kembali.", tips: "Waktu yang tepat untuk memberitahu kehamilan ke keluarga dan teman." },
            16: { title: "Minggu 16 - Jenis Kelamin Terlihat", trimester: "Trimester 2", color: "purple", size: "Sebesar buah alpukat (11cm)", weight: "100 gram", development: "Jenis kelamin mulai dapat terlihat di USG. Sistem saraf berkembang pesat.", motherChanges: "Energi meningkat, morning sickness berkurang, perut mulai membesar.", tips: "Waktu yang baik untuk olahraga ringan dan mulai prenatal yoga." },
            20: { title: "Minggu 20 - Pertengahan Kehamilan", trimester: "Trimester 2", color: "purple", size: "Sebesar buah pisang (16cm)", weight: "300 gram", development: "Gerakan janin mulai terasa. Rambut halus (lanugo) mulai tumbuh.", motherChanges: "Quickening - gerakan janin pertama kali terasa, nafsu makan meningkat.", tips: "USG detail untuk cek anomali. Mulai persiapkan kamar bayi." },
            24: { title: "Minggu 24 - Viabilitas", trimester: "Trimester 2", color: "purple", size: "Sebesar buah jagung (30cm)", weight: "600 gram", development: "Paru-paru mulai berkembang. Pendengaran mulai berfungsi.", motherChanges: "Perut semakin membesar, mungkin mengalami sakit punggung.", tips: "Tes glukosa untuk diabetes gestasional. Mulai kelas prenatal." },
            28: { title: "Minggu 28 - Awal Trimester 3", trimester: "Trimester 3", color: "blue", size: "Sebesar terong (35cm)", weight: "1 kg", development: "Mata mulai bisa membuka dan menutup. Otak berkembang pesat.", motherChanges: "Sesak nafas mulai terasa, kaki mungkin bengkak.", tips: "Mulai hitung gerakan janin, tidur dengan posisi miring kiri." },
            32: { title: "Minggu 32 - Perkembangan Paru-paru", trimester: "Trimester 3", color: "blue", size: "Sebesar kelapa (40cm)", weight: "1.7 kg", development: "Paru-paru semakin matang. Tulang mengeras kecuali tengkorak.", motherChanges: "Heartburn, susah tidur, sering buang air kecil.", tips: "Siapkan tas persalinan, diskusikan birth plan dengan dokter." },
            36: { title: "Minggu 36 - Hampir Cukup Bulan", trimester: "Trimester 3", color: "blue", size: "Sebesar melon (46cm)", weight: "2.6 kg", development: "Posisi kepala di bawah. Lemak terakumulasi untuk persiapan lahir.", motherChanges: "Kontraksi Braxton Hicks lebih sering, pernapasan mungkin lebih lega.", tips: "Kontrol rutin lebih sering, persiapan mental untuk persalinan." },
            40: { title: "Minggu 40 - Siap Lahir", trimester: "Trimester 3", color: "blue", size: "Sebesar semangka (50cm)", weight: "3.2 kg", development: "Janin sudah cukup bulan dan siap dilahirkan. Semua organ sudah matang.", motherChanges: "Kontraksi persalinan bisa dimulai kapan saja.", tips: "Waspada tanda-tanda persalinan, siap ke rumah sakit kapan saja." }
        };

        // Show week information
        function showWeekInfo(week) {
            const weekInfo = document.getElementById('week-info');
            const weekDefault = document.getElementById('week-default');
            const weekContent = document.getElementById('week-content');
            
            // Hide default message
            weekDefault.classList.add('hidden');
            weekInfo.classList.remove('hidden');

            // Get week data
            const data = weeklyData[week] || getWeekData(week);
            
            // Update content
            weekContent.innerHTML = `
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-${data.color}-500 to-${data.color}-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                        ${week}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">${data.title}</h3>
                        <p class="text-gray-600">${data.trimester}</p>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Ukuran Janin:</h4>
                            <p class="text-gray-700 bg-white p-4 rounded-lg border">${data.size}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Perkiraan Berat:</h4>
                            <p class="text-gray-700 bg-white p-4 rounded-lg border">${data.weight}</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Perkembangan Janin:</h4>
                            <p class="text-gray-700 bg-white p-4 rounded-lg border">${data.development}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Perubahan pada Ibu:</h4>
                            <p class="text-gray-700 bg-white p-4 rounded-lg border">${data.motherChanges}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Tips untuk Minggu Ini:</h4>
                    <div class="bg-${data.color}-50 border border-${data.color}-200 p-4 rounded-lg">
                        <p class="text-gray-700">${data.tips}</p>
                    </div>
                </div>
            `;

            // Update button states
            document.querySelectorAll('.week-btn').forEach(btn => {
                btn.classList.remove('bg-pink-500', 'bg-purple-500', 'bg-blue-500', 'text-white');
            });
            event.target.classList.add(`bg-${data.color}-500`, 'text-white');
        }

        // Generate data for weeks not explicitly defined
        function getWeekData(week) {
            let trimester, color, development, motherChanges, tips;
            
            if (week <= 12) {
                trimester = "Trimester 1";
                color = "pink";
                development = "Organ-organ vital sedang berkembang pesat.";
                motherChanges = "Mungkin mengalami morning sickness dan kelelahan.";
                tips = "Konsumsi asam folat, istirahat cukup, hindari alkohol dan rokok.";
            } else if (week <= 27) {
                trimester = "Trimester 2"; 
                color = "purple";
                development = "Sistem organ semakin matang, gerakan janin semakin aktif.";
                motherChanges = "Energi mulai kembali, perut semakin membesar.";
                tips = "Olahraga ringan, kontrol rutin, mulai persiapan kelahiran.";
            } else {
                trimester = "Trimester 3";
                color = "blue"; 
                development = "Janin semakin besar dan bersiap untuk kelahiran.";
                motherChanges = "Sesak nafas, sering buang air kecil, kontraksi palsu.";
                tips = "Persiapan persalinan, pantau gerakan janin, siap tas rumah sakit.";
            }

            const weightEstimate = week < 12 ? "< 30 gram" : week < 24 ? `${Math.round(week * 50)} gram` : `${Math.round(week * 100)} gram`;
            const sizeEstimate = week < 12 ? "sangat kecil" : week < 24 ? "sebesar buah kecil" : "semakin besar";
            
            return {
                title: `Minggu ${week}`,
                trimester,
                color,
                size: sizeEstimate,
                weight: weightEstimate,
                development,
                motherChanges, 
                tips
            };
        }

        // Calculator functions (existing code)
        function hitungKehamilan() {
            console.log('Function hitungKehamilan dipanggil');
            
            const hphtInput = document.getElementById('hpht').value;
            const siklusInput = parseInt(document.getElementById('siklus').value);

            console.log('HPHT Input:', hphtInput);
            console.log('Siklus Input:', siklusInput);

            if (!hphtInput) {
                alert('Silakan masukkan tanggal HPHT terlebih dahulu.');
                return;
            }

            const hpht = new Date(hphtInput);
            const hariIni = new Date();

            console.log('HPHT Date:', hpht);
            console.log('Hari Ini:', hariIni);

            // Validasi tanggal
            if (hpht > hariIni) {
                alert('Tanggal HPHT tidak boleh lebih dari hari ini');
                return;
            }

            const adjustmentDays = siklusInput - 28;
            const hpl = new Date(hpht);
            hpl.setDate(hpl.getDate() + 280 + adjustmentDays);

            const selisihHari = Math.floor((hariIni - hpht) / (1000 * 60 * 60 * 24));
            const usiaKehamilan = Math.max(0, selisihHari);
            const usiaMinggu = Math.floor(usiaKehamilan / 7);
            const usiaHari = usiaKehamilan % 7;

            console.log('Usia Minggu:', usiaMinggu);
            console.log('Usia Hari:', usiaHari);

            let trimester = '';
            let infoTrimester = '';
            if (usiaMinggu <= 12) {
                trimester = 'Trimester Pertama';
                infoTrimester =
                    'Periode pembentukan organ-organ vital bayi. Penting untuk mengonsumsi asam folat dan menjaga pola makan yang sehat.';
            } else if (usiaMinggu <= 27) {
                trimester = 'Trimester Kedua';
                infoTrimester =
                    'Periode yang paling nyaman. Anda mulai dapat merasakan gerakan janin dan melakukan USG untuk mengetahui jenis kelamin bayi.';
            } else {
                trimester = 'Trimester Ketiga';
                infoTrimester =
                    'Periode persiapan persalinan. Pastikan Anda sudah menyiapkan tas persalinan dan rencana melahirkan.';
            }

            const konsepsi = new Date(hpht);
            konsepsi.setDate(konsepsi.getDate() + (siklusInput - 14));

            const sisaHari = Math.ceil((hpl - hariIni) / (1000 * 60 * 60 * 24));

            const formatTanggal = (tanggal) => {
                const bulanIndonesia = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                return `${tanggal.getDate()} ${bulanIndonesia[tanggal.getMonth()]} ${tanggal.getFullYear()}`;
            };

            let beratJanin = '';
            if (usiaMinggu >= 20) {
                const beratEstimasi = Math.pow(usiaMinggu - 5.6, 3) / 100;
                beratJanin = `Perkiraan berat janin: ${Math.round(beratEstimasi)} gram`;
            }

            // Menggunakan style dari Tailwind untuk hasil
            let hasilHTML = `
            <div class="flex justify-between py-2 border-b border-blue-200">
                <span class="text-sm font-medium text-gray-600">Usia Kehamilan:</span>
                <span class="text-sm font-semibold text-blue-600">${usiaMinggu} minggu ${usiaHari} hari</span>
            </div>
            <div class="flex justify-between py-2 border-b border-blue-200">
                <span class="text-sm font-medium text-gray-600">HPL:</span>
                <span class="text-sm font-semibold text-blue-600">${formatTanggal(hpl)}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-blue-200">
                <span class="text-sm font-medium text-gray-600">Trimester:</span>
                <span class="text-sm font-semibold text-blue-600">${trimester}</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-sm font-medium text-gray-600">Sisa Waktu:</span>
                <span class="text-sm font-semibold text-blue-600">${sisaHari > 0 ? sisaHari + ' hari lagi' : 'Sudah melewati HPL'}</span>
            </div>
        `;

            if (beratJanin) {
                hasilHTML += `
                <div class="flex justify-between py-2 border-t border-blue-200 mt-2">
                    <span class="text-sm font-medium text-gray-600">Estimasi Berat Janin:</span>
                    <span class="text-sm font-semibold text-blue-600">${Math.round(Math.pow(usiaMinggu - 5.6, 3) / 100)} gram</span>
                </div>
            `;
            }

            console.log('Hasil HTML:', hasilHTML);

            const hasilDetailElement = document.getElementById('hasil-detail');
            const hasilElement = document.getElementById('hasil');
            
            console.log('Element hasil-detail:', hasilDetailElement);
            console.log('Element hasil:', hasilElement);

            if (hasilDetailElement && hasilElement) {
                hasilDetailElement.innerHTML = hasilHTML;
                hasilElement.style.display = 'block';

                hasilElement.scrollIntoView({
                    behavior: 'smooth'
                });
                
                console.log('Hasil berhasil ditampilkan');
            } else {
                console.error('Element tidak ditemukan!');
                alert('Error: Element hasil tidak ditemukan');
            }
        }

        function resetForm() {
            console.log('Reset form dipanggil');
            document.getElementById('hpht').value = '';
            document.getElementById('siklus').value = '28';
            const hasilElement = document.getElementById('hasil');
            if (hasilElement) {
                hasilElement.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            const hariIni = new Date().toISOString().split('T')[0];
            const hphtInput = document.getElementById('hpht');
            if (hphtInput) {
                hphtInput.max = hariIni;
                console.log('Set max date untuk HPHT:', hariIni);
            }
        });
    </script>
@endpush