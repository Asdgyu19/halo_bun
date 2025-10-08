<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\User;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::first();
        
        $facilities = [
            [
                'name' => 'RSUD Dr. Soetomo',
                'type' => 'hospital',
                'description' => 'Rumah sakit umum daerah terbesar di Jawa Timur dengan fasilitas lengkap untuk pelayanan ibu hamil dan persalinan. Memiliki NICU dan ruang bersalin modern.',
                'address' => 'Jl. Mayjen Prof. Dr. Moestopo No.6-8, Airlangga, Gubeng, Surabaya',
                'phone' => '(031) 5501078',
                'email' => 'info@rsuddrsoetomo.jatimprov.go.id',
                'website' => 'https://rsuddrsoetomo.jatimprov.go.id',
                'operating_hours' => '24 Jam',
                'latitude' => -7.2686,
                'longitude' => 112.7531,
                'services' => ['Konsultasi Kandungan', 'Persalinan Normal', 'Operasi Caesar', 'USG 4D', 'NICU', 'Rawat Inap', 'Laboratorium'],
                'is_emergency' => true,
                'rating' => 5,
                'status' => 'published',
            ],
            [
                'name' => 'Klinik Bunda Sejahtera',
                'type' => 'clinic',
                'description' => 'Klinik spesialis kebidanan dan kandungan dengan pelayanan ramah dan profesional. Fokus pada perawatan ibu hamil dan program kehamilan.',
                'address' => 'Jl. Raya Darmo No.123, Wonokromo, Surabaya',
                'phone' => '(031) 5555123',
                'email' => 'info@bundasejaahtera.com',
                'website' => 'https://bundasejaahtera.com',
                'operating_hours' => 'Sen-Jum: 08:00-20:00, Sab: 08:00-16:00',
                'latitude' => -7.2815,
                'longitude' => 112.7315,
                'services' => ['Konsultasi Kandungan', 'USG', 'Kelas Ibu Hamil', 'Imunisasi', 'KB'],
                'is_emergency' => false,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'Apotek Kimia Farma',
                'type' => 'pharmacy',
                'description' => 'Apotek terpercaya dengan stok lengkap obat-obatan dan vitamin untuk ibu hamil. Melayani konsultasi farmasi gratis.',
                'address' => 'Jl. Tunjungan No.45, Genteng, Surabaya',
                'phone' => '(031) 5316789',
                'email' => 'tunjungan@kimiafarma.co.id',
                'website' => 'https://kimiafarma.co.id',
                'operating_hours' => 'Sen-Sab: 07:00-22:00, Ming: 08:00-20:00',
                'latitude' => -7.2575,
                'longitude' => 112.7378,
                'services' => ['Obat Resep', 'Vitamin Ibu Hamil', 'Konsultasi Farmasi', 'Cek Kesehatan'],
                'is_emergency' => false,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'Laboratorium Prodia',
                'type' => 'laboratory',
                'description' => 'Laboratorium klinik dengan teknologi canggih untuk berbagai pemeriksaan kehamilan dan kesehatan ibu dan anak.',
                'address' => 'Jl. HR Muhammad No.88, Sukolilo, Surabaya',
                'phone' => '(031) 5927888',
                'email' => 'surabaya@prodia.co.id',
                'website' => 'https://prodia.co.id',
                'operating_hours' => 'Sen-Sab: 06:00-18:00, Ming: 06:00-12:00',
                'latitude' => -7.2819,
                'longitude' => 112.7952,
                'services' => ['Tes Darah', 'Tes Urine', 'Tes Kehamilan', 'TORCH', 'Gula Darah', 'Kolesterol'],
                'is_emergency' => false,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'RS Premier Surabaya',
                'type' => 'hospital',
                'description' => 'Rumah sakit swasta dengan fasilitas modern dan pelayanan kelas internasional. Memiliki unit khusus maternal dan neonatal.',
                'address' => 'Jl. Nginden Intan Timur No.1, Sukolilo, Surabaya',
                'phone' => '(031) 5993211',
                'email' => 'info@premiersurabaya.com',
                'website' => 'https://premiersurabaya.com',
                'operating_hours' => '24 Jam',
                'latitude' => -7.2894,
                'longitude' => 112.7847,
                'services' => ['Konsultasi Spesialis', 'Persalinan', 'NICU', 'ICU', 'Operasi', 'Rawat VIP'],
                'is_emergency' => true,
                'rating' => 5,
                'status' => 'published',
            ],
            [
                'name' => 'Klinik Pratama Sehat Bersama',
                'type' => 'clinic',
                'description' => 'Klinik umum dengan pelayanan kesehatan dasar untuk keluarga. Menyediakan pemeriksaan rutin ibu hamil dengan harga terjangkau.',
                'address' => 'Jl. Rungkut Mejoyo Utara No.15, Rungkut, Surabaya',
                'phone' => '(031) 8712345',
                'email' => 'info@sehatbersama.id',
                'website' => null,
                'operating_hours' => 'Sen-Sab: 08:00-21:00',
                'latitude' => -7.3147,
                'longitude' => 112.7831,
                'services' => ['Pemeriksaan Umum', 'Konsultasi Kehamilan', 'Imunisasi', 'KB', 'USG'],
                'is_emergency' => false,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'UGD RS Bhayangkara',
                'type' => 'emergency',
                'description' => 'Unit Gawat Darurat dengan tim medis berpengalaman siap 24 jam. Khusus untuk kasus emergency obstetrik dan neonatal.',
                'address' => 'Jl. Ahmad Yani No.116, Gayungan, Surabaya',
                'phone' => '(031) 8291717',
                'email' => 'ugd@rsbhayangkara-sby.com',
                'website' => 'https://rsbhayangkara-sby.com',
                'operating_hours' => '24 Jam',
                'latitude' => -7.3356,
                'longitude' => 112.7278,
                'services' => ['Gawat Darurat', 'Pertolongan Persalinan', 'Resusitasi', 'Ambulance'],
                'is_emergency' => true,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'Apotek Guardian',
                'type' => 'pharmacy',
                'description' => 'Apotek modern dengan sistem antrian online dan layanan delivery. Menyediakan produk kesehatan ibu dan anak terlengkap.',
                'address' => 'Jl. Diponegoro No.200, Gubeng, Surabaya',
                'phone' => '(031) 5030999',
                'email' => 'diponegoro@guardian.co.id',
                'website' => 'https://guardian.co.id',
                'operating_hours' => 'Sen-Ming: 08:00-22:00',
                'latitude' => -7.2743,
                'longitude' => 112.7592,
                'services' => ['Obat Resep', 'Vitamin', 'Susu Formula', 'Perlengkapan Bayi', 'Konsultasi'],
                'is_emergency' => false,
                'rating' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'Lab Klinik Pramita',
                'type' => 'laboratory',
                'description' => 'Laboratorium dengan layanan home service dan hasil online. Spesialisasi pemeriksaan kehamilan dan genetik.',
                'address' => 'Jl. Basuki Rahmat No.75, Embong Kaliasin, Surabaya',
                'phone' => '(031) 5345678',
                'email' => 'surabaya@pramita.co.id',
                'website' => 'https://pramita.co.id',
                'operating_hours' => 'Sen-Sab: 05:30-19:00, Ming: 06:00-15:00',
                'latitude' => -7.2456,
                'longitude' => 112.7441,
                'services' => ['NIPT', 'Double Test', 'Triple Test', 'TORCH', 'Home Service', 'Hasil Online'],
                'is_emergency' => false,
                'rating' => 5,
                'status' => 'published',
            ],
            [
                'name' => 'Bidan Praktek Mandiri Sari',
                'type' => 'clinic',
                'description' => 'Praktik bidan mandiri dengan pengalaman 15 tahun. Fokus pada persalinan normal dan perawatan post partum.',
                'address' => 'Jl. Bratang Binangun No.22, Wonokromo, Surabaya',
                'phone' => '0812-3456-7890',
                'email' => 'bidansari@gmail.com',
                'website' => null,
                'operating_hours' => 'Sen-Sab: 08:00-17:00, On Call 24 Jam',
                'latitude' => -7.2934,
                'longitude' => 112.7456,
                'services' => ['Persalinan Normal', 'ANC', 'Nifas', 'KB', 'Kelas Ibu Hamil'],
                'is_emergency' => false,
                'rating' => 5,
                'status' => 'draft',
            ],
        ];

        foreach ($facilities as $facilityData) {
            $facility = new Facility($facilityData);
            $facility->user_id = $adminUser->id;
            $facility->save();
        }
    }
}
