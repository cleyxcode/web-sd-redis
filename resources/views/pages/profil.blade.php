@extends('layouts.app')

@section('title', 'Profil Sekolah — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
.info-card {
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease, border-color .3s ease;
}
.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(13,35,64,.09);
    border-color: rgba(11,123,139,.3);
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="relative bg-primary overflow-hidden py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-80 h-80 bg-secondary/15 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-accent/10 rounded-full blur-2xl"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 mb-5 text-xs font-bold text-white/40">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-accent">Profil</span>
        </div>
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-4 py-1.5 rounded-full text-xs font-bold mb-5 reveal">
                <span class="material-symbols-outlined text-sm text-accent" style="font-variation-settings:'FILL' 1">school</span>
                Tentang Sekolah
            </span>
            <h1 class="font-display text-5xl md:text-6xl font-black text-white mb-4 leading-tight reveal" style="transition-delay:.1s">
                Profil <span class="italic" style="color:#C9933A;">Sekolah</span>
            </h1>
            <p class="text-white/55 text-base leading-relaxed reveal" style="transition-delay:.2s">
                Mengenal lebih dekat {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}, lembaga pendidikan dasar yang berkomitmen mencetak generasi cerdas dan berkarakter di Kepulauan Aru.
            </p>
        </div>
    </div>
</section>

<div class="bg-cream dark:bg-background-dark overflow-hidden" style="margin-top:-2px;">
    <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" style="display:block; height:40px;">
        <path d="M0 0L48 6.7C96 13.3 192 26.7 288 30C384 33.3 480 26.7 576 21.7C672 16.7 768 13.3 864 16.7C960 20 1056 30 1152 31.7C1248 33.3 1344 26.7 1392 23.3L1440 20V40H0V0Z" fill="#0D2340"/>
    </svg>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 space-y-20">

    {{-- ── Identitas Sekolah ── --}}
    <section class="reveal">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-sand dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-12 gap-0">

                {{-- Logo column --}}
                <div class="md:col-span-4 bg-gradient-to-br from-primary to-primary/90 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent/10 rounded-full blur-2xl"></div>

                    <div class="relative w-36 h-36 rounded-2xl bg-white/10 border-2 border-white/20 flex items-center justify-center mb-5 overflow-hidden shadow-2xl">
                        @if($profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}"
                                 alt="Logo {{ $profil->nama_sekolah }}"
                                 class="w-full h-full object-contain p-3"/>
                        @elseif(!empty($settings['logo']))
                            <img src="{{ asset('storage/' . $settings['logo']) }}"
                                 alt="Logo Sekolah"
                                 class="w-full h-full object-contain p-3"/>
                        @else
                            <span class="material-symbols-outlined text-6xl text-white/60" style="font-variation-settings:'FILL' 1">school</span>
                        @endif
                    </div>

                    @if($profil && $profil->akreditasi)
                        <div class="inline-flex items-center gap-2 bg-accent text-primary px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow-lg">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                            Akreditasi {{ $profil->akreditasi }}
                        </div>
                    @endif
                </div>

                {{-- Info column --}}
                <div class="md:col-span-8 p-8 md:p-12">
                    <div class="mb-1">
                        <span class="section-eyebrow inline-flex mb-3">
                            <span class="material-symbols-outlined text-sm">badge</span>
                            Identitas Resmi
                        </span>
                        <h2 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-6">
                            {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 bg-primary/8 rounded-xl flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-lg" style="font-variation-settings:'FILL' 1">person</span>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Kepala Sekolah</p>
                                <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $profil->kepala_sekolah ?: 'Belum diisi' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-accent text-lg" style="font-variation-settings:'FILL' 1">event_available</span>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Tahun Berdiri</p>
                                <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $profil->tahun_berdiri ?: '-' }}</p>
                            </div>
                        </div>
                        @if($profil && $profil->jumlah_ruang_kelas)
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-secondary text-lg" style="font-variation-settings:'FILL' 1">meeting_room</span>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Ruang Kelas</p>
                                <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $profil->jumlah_ruang_kelas }} Ruang Belajar</p>
                            </div>
                        </div>
                        @endif
                        @if($profil && $profil->kontak)
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-emerald-600 text-lg" style="font-variation-settings:'FILL' 1">call</span>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Kontak</p>
                                <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $profil->kontak }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Visi & Misi ── --}}
    @if(($profil && $profil->visi) || ($profil && $profil->misi))
    <section id="visi-misi" class="space-y-6">
        <div class="reveal">
            <span class="section-eyebrow mb-3 inline-flex">
                <span class="material-symbols-outlined text-sm">lightbulb</span>
                Arah & Tujuan
            </span>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Visi --}}
            @if($profil->visi)
            <div class="reveal bg-gradient-to-br from-primary to-primary/90 rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl shadow-primary/20">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/5 rounded-full"></div>
                <div class="absolute -bottom-6 right-6 w-28 h-28 bg-accent/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-accent/20 rounded-xl flex items-center justify-center border border-accent/30">
                            <span class="material-symbols-outlined text-accent text-xl" style="font-variation-settings:'FILL' 1">lightbulb</span>
                        </div>
                        <h3 class="font-display text-2xl font-black">Visi</h3>
                    </div>
                    <p class="text-lg italic leading-relaxed text-white/85 font-light">
                        "{{ $profil->visi }}"
                    </p>
                </div>
            </div>
            @endif

            {{-- Misi --}}
            @if($profil->misi)
            <div class="reveal bg-white dark:bg-slate-900 rounded-3xl p-8 border border-sand dark:border-slate-800 shadow-sm relative overflow-hidden" style="transition-delay:.1s">
                <div class="absolute top-0 right-0 w-40 h-40 bg-secondary/4 rounded-full translate-x-1/4 -translate-y-1/4"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-secondary/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-xl" style="font-variation-settings:'FILL' 1">assignment</span>
                        </div>
                        <h3 class="font-display text-2xl font-black text-slate-900 dark:text-white">Misi</h3>
                    </div>
                    @php
                        $misiList = array_filter(array_map('trim', explode("\n", $profil->misi)));
                    @endphp
                    @if(count($misiList) > 1)
                        <ul class="space-y-3.5">
                            @foreach($misiList as $i => $poin)
                                <li class="flex gap-3.5 items-start">
                                    <span class="font-display font-black text-secondary text-sm shrink-0 w-6 text-right">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}.</span>
                                    <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">{{ $poin }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">{{ $profil->misi }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ── Sejarah ── --}}
    @if($profil && $profil->sejarah)
    <section class="reveal">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="section-eyebrow mb-3 inline-flex">
                <span class="material-symbols-outlined text-sm">history_edu</span>
                Perjalanan
            </span>
            <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white">
                Sejarah <span class="text-gradient">Singkat</span>
            </h2>
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-sand dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-primary via-secondary to-accent"></div>
            <div class="p-8 md:p-12">
                <div class="prose prose-slate dark:prose-invert max-w-none">
                    @foreach(array_filter(array_map('trim', explode("\n", $profil->sejarah))) as $paragraf)
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4 last:mb-0 text-[15px]">{{ $paragraf }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ── Kontak ── --}}
    <section class="space-y-10" id="kontak">
        <div class="text-center max-w-2xl mx-auto reveal">
            <span class="section-eyebrow mb-3 inline-flex">
                <span class="material-symbols-outlined text-sm">contact_mail</span>
                Lokasi & Kontak
            </span>
            <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white">
                Hubungi <span class="text-gradient">Kami</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-6 items-stretch">

            {{-- Contact cards --}}
            <div class="space-y-4 reveal-left">
                @php
                    $alamat = $settings['alamat_sekolah'] ?? $profil->alamat ?? null;
                    $noTelp = $settings['no_telp'] ?? $profil->kontak ?? null;
                    $email  = $settings['email_sekolah'] ?? null;
                @endphp
                @if($alamat)
                <div class="info-card bg-white dark:bg-slate-900 p-6 rounded-2xl border border-sand dark:border-slate-800 flex items-start gap-4 shadow-sm">
                    <div class="w-12 h-12 bg-primary/8 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-display font-black text-slate-900 dark:text-white text-sm mb-1">Alamat</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $alamat }}</p>
                    </div>
                </div>
                @endif
                @if($noTelp)
                <div class="info-card bg-white dark:bg-slate-900 p-6 rounded-2xl border border-sand dark:border-slate-800 flex items-start gap-4 shadow-sm">
                    <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-emerald-600" style="font-variation-settings:'FILL' 1">call</span>
                    </div>
                    <div>
                        <h4 class="font-display font-black text-slate-900 dark:text-white text-sm mb-1">Telepon</h4>
                        <a href="tel:{{ $noTelp }}" class="text-sm text-emerald-600 font-bold hover:text-emerald-700 transition-colors">{{ $noTelp }}</a>
                    </div>
                </div>
                @endif
                @if($email)
                <div class="info-card bg-white dark:bg-slate-900 p-6 rounded-2xl border border-sand dark:border-slate-800 flex items-start gap-4 shadow-sm">
                    <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings:'FILL' 1">mail</span>
                    </div>
                    <div>
                        <h4 class="font-display font-black text-slate-900 dark:text-white text-sm mb-1">Email</h4>
                        <a href="mailto:{{ $email }}" class="text-sm text-secondary font-bold hover:text-primary transition-colors">{{ $email }}</a>
                    </div>
                </div>
                @endif
                <div class="info-card bg-white dark:bg-slate-900 p-6 rounded-2xl border border-sand dark:border-slate-800 flex items-start gap-4 shadow-sm">
                    <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-accent" style="font-variation-settings:'FILL' 1">schedule</span>
                    </div>
                    <div>
                        <h4 class="font-display font-black text-slate-900 dark:text-white text-sm mb-1">Jam Operasional</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Senin – Sabtu<br/>07.30 – 14.00 WIT</p>
                    </div>
                </div>
            </div>

            {{-- Map --}}
            <div class="reveal-right">
                <div class="h-full min-h-[360px] rounded-3xl overflow-hidden border-2 border-sand dark:border-slate-800 shadow-xl">
                    @if(!empty($settings['maps_embed']))
                        <div class="w-full h-full">
                            {!! $settings['maps_embed'] !!}
                        </div>
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/5 to-secondary/5 dark:from-primary/20 dark:to-secondary/10 flex flex-col items-center justify-center text-center p-8">
                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-4xl text-primary/50" style="font-variation-settings:'FILL' 1">map</span>
                            </div>
                            <p class="font-display font-black text-slate-600 dark:text-slate-400">Peta Lokasi</p>
                            <p class="text-xs text-slate-400 mt-1">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
