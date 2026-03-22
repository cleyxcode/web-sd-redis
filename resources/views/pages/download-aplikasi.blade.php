@extends('layouts.app')

@section('title', 'Download Aplikasi — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
@keyframes pulse-ring {
    0%   { transform: scale(1);   opacity: .5; }
    100% { transform: scale(1.5); opacity: 0; }
}
.pulse-ring-anim::before {
    content: '';
    position: absolute; inset: -10px; border-radius: 9999px;
    border: 2px solid #C9933A;
    animation: pulse-ring 2s ease-out infinite;
}
.feature-card {
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(13,35,64,.1);
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="relative bg-primary overflow-hidden py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/15 rounded-full blur-2xl"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-4 py-1.5 rounded-full text-xs font-bold mb-5 reveal">
            <span class="material-symbols-outlined text-sm text-accent" style="font-variation-settings:'FILL' 1">android</span>
            Aplikasi Mobile
        </div>
        <h1 class="font-display text-5xl md:text-6xl font-black text-white mb-4 leading-tight reveal" style="transition-delay:.1s">
            Download <span class="italic" style="color:#C9933A;">Aplikasi</span>
        </h1>
        <p class="text-white/55 max-w-xl mx-auto text-base leading-relaxed reveal" style="transition-delay:.2s">
            Akses informasi sekolah, pantau pendaftaran, dan terima notifikasi langsung di smartphone Anda.
        </p>
    </div>
</section>

<div class="bg-cream dark:bg-background-dark overflow-hidden" style="margin-top:-2px;">
    <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" style="display:block; height:40px;">
        <path d="M0 0L48 6.7C96 13.3 192 26.7 288 30C384 33.3 480 26.7 576 21.7C672 16.7 768 13.3 864 16.7C960 20 1056 30 1152 31.7C1248 33.3 1344 26.7 1392 23.3L1440 20V40H0V0Z" fill="#0D2340"/>
    </svg>
</div>

<section class="py-16 bg-cream dark:bg-background-dark">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        @if($aplikasiAktif)

        {{-- Download card --}}
        <div class="reveal mb-16">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-sand dark:border-slate-800 overflow-hidden">
                {{-- Header --}}
                <div class="bg-gradient-to-br from-primary via-primary to-secondary p-8 md:p-10 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
                    <div class="absolute -right-16 -top-16 w-56 h-56 bg-white/5 rounded-full pointer-events-none"></div>
                    <div class="absolute right-8 bottom-0 w-32 h-32 bg-accent/10 rounded-full pointer-events-none"></div>

                    {{-- App icon --}}
                    <div class="relative shrink-0">
                        <div class="relative w-28 h-28 rounded-3xl bg-white/15 border-2 border-white/25 flex items-center justify-center pulse-ring-anim shadow-2xl">
                            <span class="material-symbols-outlined text-white text-6xl" style="font-variation-settings:'FILL' 1">android</span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 text-center md:text-left relative z-10">
                        <div class="inline-flex items-center gap-1.5 bg-accent/20 text-accent border border-accent/30 px-3 py-1 rounded-full text-xs font-black mb-3">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                            Versi Terbaru
                        </div>
                        <h2 class="font-display text-3xl font-black text-white mb-3">
                            {{ $aplikasiAktif->nama_aplikasi }}
                        </h2>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-sm text-white/65">
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-accent" style="font-variation-settings:'FILL' 1">tag</span>
                                Versi {{ $aplikasiAktif->versi }}
                            </span>
                            @if($aplikasiAktif->ukuran_file)
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-accent" style="font-variation-settings:'FILL' 1">save</span>
                                {{ $aplikasiAktif->ukuran_file }}
                            </span>
                            @endif
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-accent" style="font-variation-settings:'FILL' 1">calendar_today</span>
                                {{ $aplikasiAktif->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Download button --}}
                    <div class="shrink-0 relative z-10">
                        <a href="{{ route('aplikasi.download', $aplikasiAktif->id) }}"
                           class="inline-flex flex-col items-center gap-2 bg-accent hover:bg-accent/90 active:scale-95 text-primary font-black px-10 py-5 rounded-2xl shadow-xl shadow-accent/30 transition-all hover:scale-105">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">download</span>
                            <span class="text-sm">Download APK</span>
                        </a>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if($aplikasiAktif->deskripsi)
                <div class="p-8 md:p-10 border-b border-sand dark:border-slate-800">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-8 h-8 bg-primary/8 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-base">description</span>
                        </div>
                        <h3 class="font-display font-black text-slate-800 dark:text-white text-base">Tentang Aplikasi</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $aplikasiAktif->deskripsi }}</p>
                </div>
                @endif

                {{-- Cara pasang --}}
                <div class="p-8 md:p-10">
                    <div class="flex items-center gap-2.5 mb-7">
                        <div class="w-8 h-8 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-base">install_mobile</span>
                        </div>
                        <h3 class="font-display font-black text-slate-800 dark:text-white text-base">Cara Memasang Aplikasi</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 stagger">
                        @foreach([
                            ['download',     '1. Unduh File',   'Tekan tombol Download APK di atas'],
                            ['folder_open',  '2. Buka File',    'Buka File Manager, cari file APK yang diunduh'],
                            ['security',     '3. Izin Pasang',  'Aktifkan "Sumber Tidak Dikenal" di Pengaturan'],
                            ['check_circle', '4. Pasang & Buka','Ketuk APK dan ikuti proses pemasangan'],
                        ] as $step)
                        <div class="reveal flex flex-col items-center text-center p-5 rounded-2xl bg-cream dark:bg-slate-800/50 border border-sand dark:border-slate-700/50">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center mb-3 shadow-sm">
                                <span class="material-symbols-outlined text-primary dark:text-secondary text-xl" style="font-variation-settings:'FILL' 1">{{ $step[0] }}</span>
                            </div>
                            <p class="text-xs font-black text-slate-700 dark:text-slate-200 mb-1">{{ $step[1] }}</p>
                            <p class="text-xs text-slate-400 leading-relaxed">{{ $step[2] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Fitur --}}
        <div class="reveal mb-16">
            <div class="text-center mb-10">
                <span class="section-eyebrow mb-3 inline-flex">
                    <span class="material-symbols-outlined text-sm">star</span>
                    Fitur Unggulan
                </span>
                <h2 class="font-display text-3xl font-black text-slate-900 dark:text-white">
                    Semua dalam <span class="text-gradient">Satu Aplikasi</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 stagger">
                @foreach([
                    ['newspaper',       'Berita & Pengumuman',  'Informasi terbaru dari sekolah langsung di genggaman Anda.'],
                    ['photo_library',   'Galeri Kegiatan',      'Lihat foto-foto kegiatan dan momen berharga di sekolah.'],
                    ['how_to_reg',      'Pendaftaran Online',   'Daftarkan anak Anda secara online tanpa perlu datang ke sekolah.'],
                    ['notifications',   'Notifikasi Real-time', 'Terima pemberitahuan saat status pendaftaran berubah.'],
                    ['school',          'Profil Sekolah',       'Informasi lengkap: visi, misi, guru, dan sejarah sekolah.'],
                    ['manage_accounts', 'Kelola Akun',          'Atur informasi profil dan kata sandi dengan mudah.'],
                ] as [$icon, $title, $desc])
                <div class="feature-card reveal bg-white dark:bg-slate-900 rounded-2xl p-6 border border-sand dark:border-slate-800 shadow-sm flex gap-4 items-start">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-primary/10 to-secondary/8 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary dark:text-secondary" style="font-variation-settings:'FILL' 1">{{ $icon }}</span>
                    </div>
                    <div>
                        <h4 class="font-display font-black text-slate-800 dark:text-white text-sm mb-1.5">{{ $title }}</h4>
                        <p class="text-xs text-slate-400 dark:text-slate-500 leading-relaxed">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Riwayat versi --}}
        @if($riwayat->count() > 1)
        <div class="reveal">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-5 h-0.5 bg-accent rounded-full"></span>
                <h2 class="font-display font-black text-slate-900 dark:text-white text-lg">Riwayat Versi</h2>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="divide-y divide-sand dark:divide-slate-800">
                    @foreach($riwayat as $apk)
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-cream dark:hover:bg-slate-800/50 transition-colors">
                        <div class="w-9 h-9 rounded-xl bg-primary/8 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-base">android</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ $apk->nama_aplikasi }}</p>
                            <p class="text-xs text-slate-400">{{ $apk->created_at->format('d M Y') }}
                                @if($apk->ukuran_file) · {{ $apk->ukuran_file }} @endif
                            </p>
                        </div>
                        <span class="px-2.5 py-1 bg-primary/8 text-primary dark:text-blue-300 rounded-lg text-xs font-black shrink-0">
                            v{{ $apk->versi }}
                        </span>
                        @if($apk->id === $aplikasiAktif->id)
                            <span class="px-2.5 py-1 bg-accent/15 text-amber-700 dark:text-accent rounded-lg text-xs font-black shrink-0">Terbaru</span>
                        @else
                            <a href="{{ route('aplikasi.download', $apk->id) }}"
                               class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:text-primary hover:bg-cream dark:hover:bg-slate-800 transition-colors shrink-0">
                                <span class="material-symbols-outlined text-sm">download</span>
                                Unduh
                            </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @else
        {{-- Belum ada aplikasi --}}
        <div class="text-center py-24 reveal">
            <div class="w-24 h-24 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-primary/30">android</span>
            </div>
            <h3 class="font-display text-xl font-black text-slate-700 dark:text-slate-300 mb-2">Aplikasi Belum Tersedia</h3>
            <p class="text-slate-400 text-sm max-w-sm mx-auto leading-relaxed">
                Aplikasi Android sedang dalam tahap pengembangan. Pantau terus halaman ini untuk pembaruan.
            </p>
        </div>
        @endif

    </div>
</section>

@endsection
