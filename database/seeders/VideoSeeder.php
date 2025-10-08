<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::first();
        
        $videos = [
            [
                'title' => 'Panduan Nutrisi Trimester Pertama',
                'description' => 'Video panduan lengkap mengenai nutrisi yang diperlukan ibu hamil pada trimester pertama untuk mendukung pertumbuhan janin yang optimal.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_id' => 'dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'trimester' => 1,
                'category' => 'Nutrisi',
                'duration' => 630, // 10:30 dalam detik
                'status' => 'published',
                'is_featured' => true,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Senam Hamil untuk Pemula',
                'description' => 'Gerakan senam yang aman dan bermanfaat untuk ibu hamil pemula. Membantu menjaga kebugaran dan mempersiapkan persalinan.',
                'video_url' => 'https://www.youtube.com/watch?v=abc123def456',
                'video_id' => 'abc123def456',
                'video_type' => 'youtube',
                'trimester' => 2,
                'category' => 'Olahraga',
                'duration' => 945, // 15:45 dalam detik
                'status' => 'published',
                'is_featured' => false,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Persiapan Persalinan Normal',
                'description' => 'Tips dan panduan lengkap untuk mempersiapkan persalinan normal. Mulai dari persiapan fisik hingga mental.',
                'video_url' => 'https://youtu.be/xyz789abc123',
                'video_id' => 'xyz789abc123',
                'video_type' => 'youtube',
                'trimester' => 3,
                'category' => 'Persalinan',
                'duration' => 1215, // 20:15 dalam detik
                'status' => 'published',
                'is_featured' => true,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Perawatan Bayi Baru Lahir',
                'description' => 'Panduan lengkap perawatan bayi baru lahir, mulai dari menyusui, memandikan, hingga mengganti popok.',
                'video_url' => 'https://www.youtube.com/watch?v=newborn123',
                'video_id' => 'newborn123',
                'video_type' => 'youtube',
                'trimester' => null,
                'category' => 'Perawatan Bayi',
                'duration' => 1110, // 18:30 dalam detik
                'status' => 'published',
                'is_featured' => false,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Menyusui dengan Benar',
                'description' => 'Teknik menyusui yang benar untuk memastikan bayi mendapat ASI yang cukup dan ibu merasa nyaman.',
                'video_url' => 'https://vimeo.com/123456789',
                'video_id' => '123456789',
                'video_type' => 'vimeo',
                'trimester' => null,
                'category' => 'Menyusui',
                'duration' => 740, // 12:20 dalam detik
                'status' => 'published',
                'is_featured' => true,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Mengatasi Morning Sickness',
                'description' => 'Tips praktis untuk mengatasi mual dan muntah pada awal kehamilan. Solusi alami yang aman untuk ibu hamil.',
                'video_url' => 'https://www.youtube.com/watch?v=morning456',
                'video_id' => 'morning456',
                'video_type' => 'youtube',
                'trimester' => 1,
                'category' => 'Kesehatan',
                'duration' => 525, // 8:45 dalam detik
                'status' => 'published',
                'is_featured' => false,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Yoga Prenatal Relaxation',
                'description' => 'Gerakan yoga yang membantu relaksasi dan mengurangi stress selama kehamilan. Cocok untuk semua trimester.',
                'video_url' => 'https://www.tiktok.com/@username/video/1234567890',
                'video_id' => '1234567890',
                'video_type' => 'tiktok',
                'trimester' => 2,
                'category' => 'Olahraga',
                'duration' => 1500, // 25:00 dalam detik
                'status' => 'published',
                'is_featured' => false,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Perkembangan Janin Trimester 3',
                'description' => 'Penjelasan lengkap mengenai perkembangan janin pada trimester ketiga dan persiapan menuju persalinan.',
                'video_url' => 'https://youtu.be/development789',
                'video_id' => 'development789',
                'video_type' => 'youtube',
                'trimester' => 3,
                'category' => 'Perkembangan Janin',
                'duration' => 990, // 16:30 dalam detik
                'status' => 'published',
                'is_featured' => true,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'MPASI Pertama untuk Bayi',
                'description' => 'Panduan memulai MPASI (Makanan Pendamping ASI) yang tepat untuk bayi usia 6 bulan ke atas.',
                'video_url' => 'https://www.youtube.com/watch?v=mpasi123456',
                'video_id' => 'mpasi123456',
                'video_type' => 'youtube',
                'trimester' => null,
                'category' => 'MPASI',
                'duration' => 855, // 14:15 dalam detik
                'status' => 'published',
                'is_featured' => false,
                'views_count' => rand(100, 1000),
            ],
            [
                'title' => 'Tanda-tanda Persalinan',
                'description' => 'Mengenali tanda-tanda persalinan yang sesungguhnya dan kapan harus segera ke rumah sakit.',
                'video_url' => 'https://vimeo.com/signs789',
                'video_id' => 'signs789',
                'video_type' => 'vimeo',
                'trimester' => 3,
                'category' => 'Persalinan',
                'duration' => 700, // 11:40 dalam detik
                'status' => 'draft',
                'is_featured' => false,
                'views_count' => rand(10, 100),
            ],
        ];

        foreach ($videos as $videoData) {
            $video = new Video($videoData);
            $video->user_id = $adminUser->id;
            $video->save();
        }
    }
}
