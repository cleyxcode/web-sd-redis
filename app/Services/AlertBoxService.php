<?php

namespace App\Services;

use App\Models\InfoPendaftaran;
use App\Models\Pendaftaran;

class AlertBoxService
{
    /**
     * Alert: pendaftaran pending yang belum diproses
     */
    public static function pendingPendaftaran(): ?array
    {
        $count = Pendaftaran::where('status', 'pending')->count();
        if ($count === 0) return null;

        return [
            'title'    => "Ada {$count} Pendaftaran Menunggu",
            'message'  => 'Segera tinjau dan proses pendaftaran yang masih berstatus pending.',
            'type'     => 'warning',
            'style'    => 'modern',
            'closeable' => true,
        ];
    }

    /**
     * Alert: info pendaftaran aktif saat ini
     */
    public static function pendaftaranAktif(): ?array
    {
        $info = InfoPendaftaran::where('status', 'aktif')->first();
        if (!$info) return null;

        $sisa = now()->diffInDays($info->tanggal_tutup, false);
        if ($sisa < 0) return null;

        return [
            'title'    => "Pendaftaran {$info->tahun_ajaran} Sedang Dibuka",
            'message'  => "Kuota: {$info->kuota} siswa · Ditutup: " . \Carbon\Carbon::parse($info->tanggal_tutup)->translatedFormat('d F Y'),
            'type'     => 'success',
            'style'    => 'banner',
            'closeable' => true,
        ];
    }

    /**
     * Alert: pendaftaran belum dibuka (tidak ada yang aktif)
     */
    public static function pendaftaranTutup(): ?array
    {
        $aktif = InfoPendaftaran::where('status', 'aktif')->exists();
        if ($aktif) return null;

        return [
            'title'    => 'Pendaftaran Belum Dibuka',
            'message'  => 'Belum ada periode pendaftaran yang aktif. Buka menu Info Pendaftaran untuk mengaktifkan.',
            'type'     => 'info',
            'style'    => 'minimal',
            'closeable' => false,
        ];
    }
}
