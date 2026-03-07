<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\InfoPendaftaran;
use App\Models\ProfilSekolah;
use App\Models\Setting;
use App\Models\Siswa;

class HomeController extends Controller
{
    public function index()
    {
        $profil    = ProfilSekolah::first();
        $settings  = Setting::all()->pluck('value', 'key');

        $jumlahGuru  = Guru::where('status', 'aktif')->count();
        $jumlahSiswa = Siswa::where('status', 'aktif')->count();

        $beritaTerbaru = Berita::where('status', 'publish')
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        $galeri = Galeri::latest()->take(6)->get();

        $pendaftaranAktif = InfoPendaftaran::where('status', 'aktif')->first();

        $banners = Banner::where('status', 'aktif')->orderBy('urutan')->get();

        return view('pages.home', compact(
            'profil',
            'settings',
            'jumlahGuru',
            'jumlahSiswa',
            'beritaTerbaru',
            'galeri',
            'pendaftaranAktif',
            'banners',
        ));
    }
}
