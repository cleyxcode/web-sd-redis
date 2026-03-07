<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,           // Admin user (user_id = 1)
            ProfilSekolahSeeder::class,  // Data profil sekolah
            SettingsSeeder::class,       // Pengaturan web
            GuruSeeder::class,           // 40 data guru
            SiswaSeeder::class,          // 40 data siswa
            BeritaSeeder::class,         // 40 data berita
            GaleriSeeder::class,         // 40 data galeri
            BannerSeeder::class,         // 5 banner slider
            InfoPendaftaranSeeder::class,// 2 info pendaftaran (1 aktif)
            PendaftaranSeeder::class,    // 40 data pendaftaran + user orangtua
        ]);
    }
}
