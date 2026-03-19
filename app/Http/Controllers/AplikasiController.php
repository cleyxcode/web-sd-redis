<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;

class AplikasiController extends Controller
{
    public function index()
    {
        $aplikasiAktif = Aplikasi::where('status', 'aktif')
            ->latest()
            ->first();

        $riwayat = Aplikasi::where('status', 'aktif')
            ->latest()
            ->get();

        return view('pages.download-aplikasi', compact('aplikasiAktif', 'riwayat'));
    }

    public function download($id)
    {
        $aplikasi = Aplikasi::findOrFail($id);

        abort_if(empty($aplikasi->link_download), 404, 'Link download tidak tersedia.');

        return redirect()->away($aplikasi->link_download);
    }
}
