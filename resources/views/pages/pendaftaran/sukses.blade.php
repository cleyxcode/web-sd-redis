@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

<div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-lg w-full text-center">

        {{-- Icon Sukses --}}
        <div class="w-28 h-28 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
            <span class="material-symbols-outlined text-6xl text-green-500" style="font-variation-settings:'FILL' 1">check_circle</span>
        </div>

        <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-4">
            Pendaftaran Berhasil Dikirim!
        </h1>

        @if(session('nama_anak'))
            <p class="text-lg text-slate-600 dark:text-slate-400 mb-2">
                Data pendaftaran atas nama <strong class="text-primary">{{ session('nama_anak') }}</strong> telah kami terima.
            </p>
        @endif

        <p class="text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
            Tim kami akan memverifikasi data Anda dan menghubungi melalui nomor HP yang telah didaftarkan.
            Proses verifikasi membutuhkan waktu <strong>1–3 hari kerja</strong>.
        </p>

        {{-- Info Box --}}
        <div class="bg-accent/10 border border-accent/30 rounded-2xl p-6 mb-8 text-left">
            <h3 class="font-bold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-accent">info</span>
                Langkah Selanjutnya
            </h3>
            <ul class="space-y-2 text-sm text-slate-700 dark:text-slate-300">
                <li class="flex gap-2">
                    <span class="text-accent font-bold shrink-0">1.</span>
                    Tunggu konfirmasi melalui WhatsApp/telepon ke nomor HP yang Anda daftarkan.
                </li>
                <li class="flex gap-2">
                    <span class="text-accent font-bold shrink-0">2.</span>
                    Siapkan dokumen asli (Akta Lahir, KK) untuk proses verifikasi lanjutan.
                </li>
                <li class="flex gap-2">
                    <span class="text-accent font-bold shrink-0">3.</span>
                    Datang ke sekolah sesuai jadwal yang akan kami informasikan.
                </li>
            </ul>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}"
               class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-colors inline-flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">home</span>
                Kembali ke Beranda
            </a>
            <a href="{{ route('berita') }}"
               class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-8 py-3 rounded-xl font-bold hover:border-primary hover:text-primary transition-colors inline-flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">newspaper</span>
                Lihat Berita
            </a>
        </div>

    </div>
</div>

@endsection
