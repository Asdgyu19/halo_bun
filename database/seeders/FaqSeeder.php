<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\User;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::first();
        
        $faqs = [
            [
                'question' => 'Apa saja makanan yang harus dihindari selama kehamilan?',
                'answer' => 'Selama kehamilan, ibu hamil harus menghindari beberapa jenis makanan seperti: ikan mentah (sushi), daging mentah atau setengah matang, telur mentah, keju lunak yang tidak dipasteurisasi, alkohol, kafein berlebihan (lebih dari 200mg per hari), makanan kaleng yang mengandung BPA tinggi, dan ikan yang mengandung merkuri tinggi seperti hiu dan king mackerel.',
                'category' => 'Nutrisi',
                'tags' => 'makanan, nutrisi, pantangan, kehamilan, diet',
                'trimester' => null,
                'is_featured' => true,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Berapa kali sebaiknya kontrol kehamilan ke dokter?',
                'answer' => 'Frekuensi kontrol kehamilan yang direkomendasikan adalah: Trimester 1 (0-12 minggu): setiap 4 minggu sekali. Trimester 2 (13-27 minggu): setiap 4 minggu sekali. Trimester 3 (28-36 minggu): setiap 2 minggu sekali. Minggu 36 hingga persalinan: setiap minggu. Namun, frekuensi ini bisa berubah tergantung kondisi kesehatan ibu dan janin.',
                'category' => 'Pemeriksaan',
                'tags' => 'kontrol, dokter, pemeriksaan, kehamilan, jadwal',
                'trimester' => null,
                'is_featured' => true,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Apakah normal jika mengalami mual muntah di trimester pertama?',
                'answer' => 'Ya, mual muntah (morning sickness) sangat normal terjadi pada trimester pertama. Sekitar 70-80% wanita hamil mengalaminya. Biasanya dimulai sekitar minggu ke-6 kehamilan dan membaik pada minggu ke-12-14. Ini disebabkan oleh perubahan hormon, terutama peningkatan HCG dan estrogen. Namun, jika mual muntah sangat parah hingga tidak bisa makan dan minum, segera konsultasi ke dokter.',
                'category' => 'Gejala Kehamilan',
                'tags' => 'mual, muntah, morning sickness, trimester 1, normal',
                'trimester' => 1,
                'is_featured' => false,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Bagaimana cara mengatasi sembelit saat hamil?',
                'answer' => 'Untuk mengatasi sembelit saat hamil: 1) Perbanyak konsumsi serat dari buah, sayur, dan biji-bijian. 2) Minum air putih minimal 8-10 gelas per hari. 3) Olahraga ringan seperti jalan kaki. 4) Konsumsi probiotik alami seperti yogurt. 5) Hindari menahan BAB. 6) Jika perlu, konsultasi dengan dokter untuk mendapat suplemen serat yang aman.',
                'category' => 'Kesehatan',
                'tags' => 'sembelit, konstipasi, pencernaan, serat, air putih',
                'trimester' => null,
                'is_featured' => false,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Kapan waktu terbaik untuk USG 4D?',
                'answer' => 'Waktu terbaik untuk USG 4D adalah pada usia kehamilan 26-30 minggu. Pada periode ini, janin sudah cukup berkembang sehingga fitur wajahnya terlihat jelas, namun masih ada cukup cairan ketuban untuk menghasilkan gambar yang baik. Sebelum 26 minggu, janin masih terlalu kecil, sedangkan setelah 30 minggu, ruang di rahim semakin sempit sehingga sulit mendapat gambar yang optimal.',
                'category' => 'Pemeriksaan',
                'tags' => 'USG 4D, pemeriksaan, janin, trimester 2, imaging',
                'trimester' => 2,
                'is_featured' => true,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Apakah boleh berhubungan intim saat hamil?',
                'answer' => 'Berhubungan intim saat hamil umumnya aman jika kehamilan normal dan tidak ada komplikasi. Namun, hindari jika ada: perdarahan vagina, plasenta previa, riwayat keguguran berulang, serviks yang terbuka prematur, atau instruksi khusus dari dokter. Posisi yang nyaman dan komunikasi dengan pasangan sangat penting. Konsultasikan dengan dokter jika ada kekhawatiran.',
                'category' => 'Hubungan Intim',
                'tags' => 'hubungan intim, seks, kehamilan, aman, posisi',
                'trimester' => null,
                'is_featured' => false,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Bagaimana cara mempersiapkan persalinan normal?',
                'answer' => 'Persiapan persalinan normal meliputi: 1) Menjaga kesehatan dengan diet seimbang dan olahraga teratur. 2) Mengikuti kelas persiapan persalinan. 3) Belajar teknik pernapasan dan relaksasi. 4) Mempersiapkan tas persalinan sejak minggu ke-36. 5) Memilih posisi persalinan yang nyaman. 6) Menjaga berat badan ideal. 7) Komunikasi dengan tim medis tentang birth plan.',
                'category' => 'Persalinan',
                'tags' => 'persalinan normal, persiapan, birth plan, teknik pernapasan',
                'trimester' => 3,
                'is_featured' => true,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Berapa lama ASI eksklusif harus diberikan?',
                'answer' => 'ASI eksklusif harus diberikan selama 6 bulan pertama kehidupan bayi. Setelah usia 6 bulan, bayi mulai diperkenalkan dengan MPASI (Makanan Pendamping ASI) sambil tetap melanjutkan pemberian ASI hingga usia 2 tahun atau lebih. ASI eksklusif artinya bayi hanya mendapat ASI tanpa tambahan air, susu formula, atau makanan lain.',
                'category' => 'Menyusui',
                'tags' => 'ASI eksklusif, menyusui, 6 bulan, MPASI, nutrisi bayi',
                'trimester' => null,
                'is_featured' => false,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Apa tanda-tanda persalinan yang sesungguhnya?',
                'answer' => 'Tanda-tanda persalinan sesungguhnya: 1) Kontraksi teratur yang semakin kuat dan sering (setiap 5 menit atau kurang). 2) Kontraksi tidak hilang saat beristirahat atau berubah posisi. 3) Keluarnya lendir bercampur darah (bloody show). 4) Pecah ketuban. 5) Nyeri punggung bawah yang menjalar ke perut. 6) Pembukaan serviks yang progresif. Segera ke rumah sakit jika mengalami tanda-tanda ini.',
                'category' => 'Persalinan',
                'tags' => 'tanda persalinan, kontraksi, pecah ketuban, bloody show',
                'trimester' => 3,
                'is_featured' => true,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'published',
            ],
            [
                'question' => 'Kapan bayi mulai bisa diajak berkomunikasi?',
                'answer' => 'Bayi sudah bisa diajak berkomunikasi sejak lahir! Mereka merespons suara, sentuhan, dan kontak mata. Perkembangan komunikasi: 0-2 bulan (menangis, kontak mata), 2-4 bulan (tersenyum sosial, cooing), 4-6 bulan (tertawa, babbling), 6-12 bulan (kata pertama, meniru suara). Sering berbicara, membacakan buku, dan bernyanyi akan membantu perkembangan bahasa bayi.',
                'category' => 'Perkembangan Bayi',
                'tags' => 'komunikasi bayi, perkembangan bahasa, babbling, interaksi',
                'trimester' => null,
                'is_featured' => false,
                'views_count' => rand(500, 2000),
                'helpful_count' => rand(50, 200),
                'likes' => rand(30, 150),
                'status' => 'draft',
            ],
        ];

        foreach ($faqs as $faqData) {
            $faq = new Faq($faqData);
            $faq->user_id = $adminUser->id;
            $faq->save();
        }
    }
}
