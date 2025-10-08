<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeederNew extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Pastikan ada admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => 'Admin',
            'username' => 'admin', 
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Buat contoh artikel
        $articles = [
            [
                'title' => 'Nutrisi Penting di Trimester Pertama',
                'trimester' => 1,
                'category' => 'Nutrisi',
                'excerpt' => 'Mengetahui nutrisi yang diperlukan saat memasuki trimester pertama kehamilan sangat penting untuk perkembangan janin.',
                'body' => 'Trimester pertama adalah periode yang sangat penting dalam kehamilan. Pada masa ini, perkembangan organ vital janin dimulai. Oleh karena itu, asupan nutrisi yang tepat sangat diperlukan...',
                'user_id' => $admin->id
            ],
            [
                'title' => 'Perkembangan Janin di Trimester Kedua',
                'trimester' => 2,
                'category' => 'Perkembangan',
                'excerpt' => 'Fase trimester kedua adalah masa paling nyaman dalam kehamilan. Ketahui perkembangan janin pada periode ini.',
                'body' => 'Trimester kedua seringkali disebut sebagai "golden period" kehamilan. Morning sickness biasanya mulai berkurang dan energi kembali pulih...',
                'user_id' => $admin->id
            ],
            [
                'title' => 'Persiapan Persalinan Trimester Ketiga',
                'trimester' => 3,
                'category' => 'Persalinan',
                'excerpt' => 'Tips dan persiapan yang perlu dilakukan menjelang persalinan di trimester ketiga.',
                'body' => 'Memasuki trimester ketiga, Anda perlu mempersiapkan diri untuk persalinan. Mulai dari persiapan mental, fisik, hingga kebutuhan bayi...',
                'user_id' => $admin->id
            ],
            [
                'title' => 'Olahraga Aman untuk Ibu Hamil',
                'trimester' => null,
                'category' => 'Olahraga',
                'excerpt' => 'Panduan olahraga yang aman dan bermanfaat untuk ibu hamil di semua trimester.',
                'body' => 'Olahraga selama kehamilan memiliki banyak manfaat, seperti mengurangi risiko diabetes gestasional dan memperbaiki mood...',
                'user_id' => $admin->id
            ],
            [
                'title' => 'Mengatasi Morning Sickness',
                'trimester' => 1,
                'category' => 'Kesehatan',
                'excerpt' => 'Cara efektif mengatasi mual muntah di awal kehamilan.',
                'body' => 'Morning sickness adalah kondisi yang umum dialami ibu hamil, terutama di trimester pertama. Berikut tips mengatasinya...',
                'user_id' => $admin->id
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }
    }
}