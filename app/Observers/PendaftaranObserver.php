<?php

namespace App\Observers;

use App\Models\Notifikasi;
use App\Models\Pendaftaran;

class PendaftaranObserver
{
    /**
     * Saat status pendaftaran berubah menjadi 'diterima' atau 'ditolak',
     * buat notifikasi untuk user (orangtua) yang mendaftar.
     */
    public function updated(Pendaftaran $pendaftaran): void
    {
        if (! $pendaftaran->wasChanged('status')) {
            return;
        }

        $status = $pendaftaran->status;

        if ($status === 'diterima') {
            Notifikasi::create([
                'user_id'      => $pendaftaran->user_id,
                'judul'        => 'Pendaftaran Diterima',
                'pesan'        => 'Selamat! Pendaftaran atas nama ' . $pendaftaran->nama_anak . ' telah diterima.',
                'tipe'         => 'pendaftaran',
                'referensi_id' => $pendaftaran->id,
            ]);
        }

        if ($status === 'ditolak') {
            Notifikasi::create([
                'user_id'      => $pendaftaran->user_id,
                'judul'        => 'Pendaftaran Ditolak',
                'pesan'        => 'Mohon maaf, pendaftaran atas nama ' . $pendaftaran->nama_anak . ' tidak dapat diterima.',
                'tipe'         => 'pendaftaran',
                'referensi_id' => $pendaftaran->id,
            ]);
        }
    }
}
