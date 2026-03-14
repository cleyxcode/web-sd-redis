<?php

namespace App\Observers;

use App\Models\Berita;
use App\Models\Notifikasi;
use App\Models\User;

class BeritaObserver
{
    /**
     * Saat berita diupdate: jika status berubah menjadi 'publish',
     * buat notifikasi untuk semua user orangtua.
     */
    public function updated(Berita $berita): void
    {
        if ($berita->wasChanged('status') && $berita->status === 'publish') {
            $orangtua = User::where('role', 'orangtua')->pluck('id');

            $notifikasi = $orangtua->map(fn($userId) => [
                'user_id'      => $userId,
                'judul'        => 'Berita Baru',
                'pesan'        => 'Berita baru telah diterbitkan: ' . $berita->judul,
                'tipe'         => 'berita',
                'referensi_id' => $berita->id,
                'dibaca'       => false,
                'created_at'   => now(),
                'updated_at'   => now(),
            ])->toArray();

            Notifikasi::insert($notifikasi);
        }
    }
}
