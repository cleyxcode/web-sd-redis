<?php

namespace Database\Seeders;

use App\Models\InfoPendaftaran;
use Illuminate\Database\Seeder;

class InfoPendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        // Tahun ajaran lalu (sudah tutup)
        InfoPendaftaran::create([
            'user_id'        => 1,
            'tahun_ajaran'   => '2025/2026',
            'tanggal_buka'   => '2025-02-01',
            'tanggal_tutup'  => '2025-03-31',
            'kuota'          => 120,
            'syarat'         => "1. Berusia minimal 6 tahun pada 1 Juli 2025\n2. Membawa fotokopi Akta Kelahiran (2 lembar)\n3. Membawa fotokopi Kartu Keluarga (2 lembar)\n4. Membawa pas foto 3x4 sebanyak 3 lembar\n5. Mengisi formulir pendaftaran secara lengkap\n6. Tidak dipungut biaya pendaftaran",
            'status'         => 'nonaktif',
        ]);

        // Tahun ajaran aktif
        InfoPendaftaran::create([
            'user_id'        => 1,
            'tahun_ajaran'   => '2026/2027',
            'tanggal_buka'   => '2026-02-01',
            'tanggal_tutup'  => '2026-04-30',
            'kuota'          => 120,
            'syarat'         => "1. Berusia minimal 6 tahun pada 1 Juli 2026\n2. Membawa fotokopi Akta Kelahiran (2 lembar)\n3. Membawa fotokopi Kartu Keluarga (2 lembar)\n4. Membawa pas foto 3x4 sebanyak 3 lembar\n5. Mengisi formulir pendaftaran secara lengkap dan benar\n6. Tidak dipungut biaya pendaftaran apapun\n7. Bagi siswa yang pernah bersekolah sebelumnya wajib membawa surat pindah",
            'status'         => 'aktif',
        ]);
    }
}
