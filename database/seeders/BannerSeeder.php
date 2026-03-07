<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'judul'  => 'Selamat Datang di SD Negeri Warialau',
                'gambar' => 'banner/banner-1.jpg',
                'urutan' => 1,
                'status' => 'aktif',
            ],
            [
                'judul'  => 'Pendaftaran Siswa Baru Tahun Ajaran 2026/2027 Dibuka!',
                'gambar' => 'banner/banner-2.jpg',
                'urutan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul'  => 'Raih Prestasi Terbaik Bersama Kami',
                'gambar' => 'banner/banner-3.jpg',
                'urutan' => 3,
                'status' => 'aktif',
            ],
            [
                'judul'  => 'Membangun Generasi Cerdas dan Berkarakter',
                'gambar' => 'banner/banner-4.jpg',
                'urutan' => 4,
                'status' => 'aktif',
            ],
            [
                'judul'  => 'Bersama Kita Wujudkan Pendidikan Berkualitas',
                'gambar' => 'banner/banner-5.jpg',
                'urutan' => 5,
                'status' => 'aktif',
            ],
        ];

        foreach ($banners as $b) {
            Banner::create($b);
        }
    }
}
