<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PregnancyTrackerController extends Controller
{
    public function index()
    {
        $pregnancyData = [
            'Trimester 1' => [
                'range' => 'Minggu 1-12',
                'weeks' => [
                    1 => [
                        'title' => 'Minggu 1: Awal Perjalanan',
                        'image' => 'img/weeks/week1.svg',
                        'size' => 'Seukuran Biji Poppy',
                        'weight' => '~1 gr',
                        'height' => '~0.1 cm',
                        'content' => '<p>Pada minggu pertama, tubuh Anda bersiap untuk ovulasi. Meskipun pembuahan belum terjadi, minggu ini dihitung sebagai bagian dari 40 minggu kehamilan Anda.</p>',
                        'mom_tips' => [
                            'Mulai konsumsi vitamin prenatal, terutama asam folat.',
                            'Jaga pola makan sehat dan seimbang.',
                            'Hindari alkohol dan merokok.',
                        ],
                        'dad_tips' => [
                            'Berikan dukungan emosional pada pasangan.',
                            'Ikut serta dalam gaya hidup sehat bersama.',
                        ],
                    ],
                    2 => [
                        'title' => 'Minggu 2: Ovulasi & Pembuahan',
                        'image' => 'img/weeks/week2.svg',
                        'size' => 'Seukuran Biji Apel',
                        'weight' => '~2 gr',
                        'height' => '~0.2 cm',
                        'content' => '<p>Ovulasi terjadi, dan jika sel telur bertemu dengan sperma, pembuahan akan dimulai. Zigot akan terbentuk dan mulai membelah diri sambil bergerak menuju rahim.</p>',
                        'mom_tips' => [
                            'Perhatikan tanda-tanda ovulasi.',
                            'Lanjutkan gaya hidup sehat.',
                        ],
                        'dad_tips' => [
                            'Pahami siklus kesuburan pasangan.',
                            'Jaga komunikasi yang baik.',
                        ],
                    ],
                    4 => [
                        'title' => 'Minggu 4: Implantasi',
                        'image' => 'img/weeks/week4.svg',
                        'size' => 'Seukuran Biji Wijen',
                        'weight' => '< 1 gram',
                        'height' => '2 mm',
                        'content' => '<p>Pada minggu ke-4, embrio Anda seukuran biji wijen. Jantung kecil mulai berdetak dan sistem saraf pusat mulai berkembang.</p>',
                        'mom_tips' => [
                            'Mulai konsumsi asam folat 400-600 mcg per hari',
                            'Hindari alkohol dan merokok',
                            'Konsultasi dengan dokter kandungan'
                        ],
                        'dad_tips' => [
                            'Dukung pasangan untuk hidup sehat',
                            'Pelajari tentang kehamilan bersama'
                        ]
                    ],
                    8 => [
                        'title' => 'Minggu 8: Perkembangan Organ',
                        'image' => 'img/weeks/week8.svg',
                        'size' => 'Seukuran Buah Blueberry',
                        'weight' => '1 gram',
                        'height' => '16 mm',
                        'content' => '<p>Embrio mulai terlihat seperti bayi kecil. Jari tangan dan kaki mulai terbentuk, serta mata mulai berkembang.</p>',
                        'mom_tips' => [
                            'Atasi morning sickness dengan makan sedikit tapi sering',
                            'Perbanyak istirahat',
                            'Minum air putih yang cukup'
                        ],
                        'dad_tips' => [
                            'Bantu pasangan mengatasi morning sickness',
                            'Siapkan makanan sehat untuk pasangan'
                        ]
                    ],
                    12 => [
                        'title' => 'Minggu 12: Akhir Trimester Pertama',
                        'image' => 'img/weeks/week12.svg',
                        'size' => 'Seukuran Buah Plum',
                        'weight' => '14 gram',
                        'height' => '54 mm',
                        'content' => '<p>Janin sudah memiliki semua organ vital. Risiko keguguran mulai berkurang dan Anda mungkin sudah bisa mendengar detak jantung janin.</p>',
                        'mom_tips' => [
                            'Lakukan pemeriksaan USG pertama',
                            'Mulai beritahu keluarga dan teman',
                            'Jaga pola makan bergizi'
                        ],
                        'dad_tips' => [
                            'Dampingi saat USG pertama',
                            'Mulai merencanakan keuangan keluarga'
                        ]
                    ]
                ],
            ],
            'Trimester 2' => [
                'range' => 'Minggu 13-27',
                'weeks' => [
                    13 => [
                        'title' => 'Minggu 13: Awal Trimester Kedua',
                        'image' => 'img/weeks/week13.svg',
                        'size' => 'Seukuran Buah Plum',
                        'weight' => '~25 gr',
                        'height' => '~7.4 cm',
                        'content' => '<p>Risiko keguguran menurun drastis. Janin kini memiliki sidik jari dan mulai bisa merespons rangsangan dari luar. Mual di pagi hari biasanya mulai mereda.</p>',
                        'mom_tips' => [
                            'Mulai lakukan olahraga ringan yang aman.',
                            'Fokus pada asupan kalsium untuk tulang janin.',
                        ],
                        'dad_tips' => [
                            'Ajak pasangan untuk berjalan-jalan santai.',
                            'Mulai pikirkan nama bayi bersama.',
                        ],
                    ],
                    16 => [
                        'title' => 'Minggu 16: Perkembangan Indera',
                        'image' => 'img/weeks/week16.svg',
                        'size' => 'Seukuran Buah Alpukat',
                        'weight' => '100 gram',
                        'height' => '116 mm',
                        'content' => '<p>Janin mulai dapat menggerakkan mata dan jenis kelamin sudah dapat ditentukan melalui USG.</p>',
                        'mom_tips' => [
                            'Mulai olahraga ringan seperti yoga prenatal',
                            'Konsumsi kalsium untuk perkembangan tulang janin',
                            'Nikmati masa yang lebih nyaman ini'
                        ],
                        'dad_tips' => [
                            'Mulai berbicara dengan janin',
                            'Ikut kelas persiapan ayah'
                        ]
                    ],
                    20 => [
                        'title' => 'Minggu 20: Titik Tengah Kehamilan',
                        'image' => 'img/weeks/week20.svg',
                        'size' => 'Seukuran Buah Pisang',
                        'weight' => '300 gram',
                        'height' => '166 mm',
                        'content' => '<p>Ini adalah milestone penting! Anda mungkin sudah bisa merasakan gerakan janin (quickening) dan dapat mengetahui jenis kelamin melalui USG.</p>',
                        'mom_tips' => [
                            'Lakukan USG anomali untuk memastikan perkembangan organ',
                            'Mulai merasakan gerakan janin',
                            'Pilih nama untuk si kecil'
                        ],
                        'dad_tips' => [
                            'Rasakan gerakan janin dengan menempelkan tangan di perut',
                            'Mulai menyiapkan kamar bayi'
                        ]
                    ],
                    24 => [
                        'title' => 'Minggu 24: Kemampuan Mendengar',
                        'image' => 'img/weeks/week24.svg',
                        'size' => 'Seukuran Buah Jagung',
                        'weight' => '600 gram',
                        'height' => '300 mm',
                        'content' => '<p>Janin mulai dapat mendengar suara dari luar rahim. Paru-paru terus berkembang dan ada kemungkinan bertahan hidup jika lahir prematur.</p>',
                        'mom_tips' => [
                            'Mulai putar musik klasik untuk janin',
                            'Jaga kenaikan berat badan yang sehat',
                            'Lakukan tes diabetes gestasional'
                        ],
                        'dad_tips' => [
                            'Bacakan buku untuk janin',
                            'Bantu pasangan dalam aktivitas sehari-hari'
                        ]
                    ]
                ],
            ],
            'Trimester 3' => [
                'range' => 'Minggu 28-40',
                'weeks' => [
                    28 => [
                        'title' => 'Minggu 28: Memasuki Trimester Akhir',
                        'image' => 'img/weeks/week28.svg',
                        'size' => 'Seukuran Terong',
                        'weight' => '~1 kg',
                        'height' => '~37.6 cm',
                        'content' => '<p>Mata janin sudah bisa terbuka dan berkedip. Sistem saraf pusatnya berkembang pesat. Bunda mungkin akan mulai merasakan kontraksi palsu (Braxton Hicks).</p>',
                        'mom_tips' => [
                            'Hitung gerakan janin setiap hari.',
                            'Mulai ikuti kelas persiapan persalinan.',
                        ],
                        'dad_tips' => [
                            'Bantu pasangan menyiapkan perlengkapan bayi.',
                            'Pelajari tanda-tanda persalinan.',
                        ],
                    ],
                    32 => [
                        'title' => 'Minggu 32: Persiapan Persalinan',
                        'image' => 'img/weeks/week32.svg',
                        'size' => 'Seukuran Buah Kelapa',
                        'weight' => '1700 gram',
                        'height' => '425 mm',
                        'content' => '<p>Janin mulai menyimpan lemak di bawah kulit. Tulang mengeras kecuali tengkorak yang tetap lunak untuk memudahkan persalinan.</p>',
                        'mom_tips' => [
                            'Mulai pijat perineum untuk persiapan persalinan',
                            'Diskusikan rencana persalinan dengan dokter',
                            'Istirahat yang cukup'
                        ],
                        'dad_tips' => [
                            'Pelajari teknik pernapasan untuk mendampingi persalinan',
                            'Siapkan mental untuk menjadi ayah'
                        ]
                    ],
                    36 => [
                        'title' => 'Minggu 36: Hampir Siap Lahir',
                        'image' => 'img/weeks/week36.svg',
                        'size' => 'Seukuran Buah Melon',
                        'weight' => '2600 gram',
                        'height' => '475 mm',
                        'content' => '<p>Janin sudah dianggap cukup bulan jika lahir sekarang. Paru-paru hampir matang dan janin mulai turun ke panggul.</p>',
                        'mom_tips' => [
                            'Siapkan segala keperluan bayi',
                            'Kenali tanda-tanda persalinan',
                            'Kontrol rutin ke dokter kandungan'
                        ],
                        'dad_tips' => [
                            'Pastikan transportasi ke rumah sakit siap',
                            'Siapkan nomor penting yang mudah dihubungi'
                        ]
                    ],
                    40 => [
                        'title' => 'Minggu 40: Hari Perkiraan Lahir',
                        'image' => 'img/weeks/week40.svg',
                        'size' => 'Seukuran Buah Semangka',
                        'weight' => '3400 gram',
                        'height' => '510 mm',
                        'content' => '<p>Ini adalah minggu perkiraan lahir! Janin sudah siap lahir dengan semua organ yang berfungsi dengan baik.</p>',
                        'mom_tips' => [
                            'Tetap tenang menunggu tanda persalinan',
                            'Jalan santai untuk membantu persalinan',
                            'Siapkan mental untuk bertemu si kecil'
                        ],
                        'dad_tips' => [
                            'Dampingi istri dengan sabar',
                            'Siapkan kamera untuk moment berharga',
                            'Bersiap menjadi ayah yang hebat'
                        ]
                    ]
                ],
            ],
        ];

        return view('pregnancy-tracker.index', compact('pregnancyData'));
    }
}
