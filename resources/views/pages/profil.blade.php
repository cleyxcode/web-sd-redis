@extends('layouts.app')

@section('title', 'Profil Sekolah - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Hero / Breadcrumb --}}
<section class="relative bg-primary/10 dark:bg-primary/20 py-12 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-2 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-slate-200">Profil</span>
        </div>
        <h1 class="text-4xl font-extrabold text-primary dark:text-slate-100 mb-2">Profil Sekolah</h1>
        <p class="text-slate-600 dark:text-slate-400 max-w-2xl">
            Mengenal lebih dekat {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}, lembaga pendidikan dasar yang berkomitmen mencetak generasi cerdas dan berkarakter.
        </p>
    </div>
</section>

<div class="max-w-6xl mx-auto px-6 py-12 space-y-20">

    {{-- Identitas Sekolah --}}
    <section>
        <div class="grid md:grid-cols-12 gap-8 items-center bg-white dark:bg-slate-900 p-8 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">

            {{-- Logo --}}
            <div class="md:col-span-4 flex justify-center">
                <div class="w-48 h-48 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center border-4 border-accent p-4 relative">
                    <div class="w-full h-full bg-slate-200 dark:bg-slate-700 rounded-full flex items-center justify-center text-primary overflow-hidden">
                        @if($profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}"
                                 alt="Logo {{ $profil->nama_sekolah }}"
                                 class="w-full h-full object-contain"/>
                        @elseif(!empty($settings['logo']))
                            <img src="{{ asset('storage/' . $settings['logo']) }}"
                                 alt="Logo Sekolah"
                                 class="w-full h-full object-contain"/>
                        @else
                            <span class="material-symbols-outlined text-6xl text-primary">school</span>
                        @endif
                    </div>
                    @if($profil && $profil->akreditasi)
                        <div class="absolute -bottom-2 bg-accent text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">
                            Akreditasi {{ $profil->akreditasi }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Identitas --}}
            <div class="md:col-span-8 space-y-6">
                <div>
                    <h3 class="text-primary dark:text-accent text-sm font-bold uppercase tracking-widest mb-1">Identitas Resmi</h3>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white">
                        {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                    </h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-accent">person</span>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Kepala Sekolah</p>
                            <p class="font-semibold">{{ $profil->kepala_sekolah ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-accent">event_available</span>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Tahun Berdiri</p>
                            <p class="font-semibold">{{ $profil->tahun_berdiri ?: '-' }}</p>
                        </div>
                    </div>
                    @if($profil && $profil->jumlah_ruang_kelas)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary dark:text-accent">meeting_room</span>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Ruang Kelas</p>
                                <p class="font-semibold">{{ $profil->jumlah_ruang_kelas }} Ruang Belajar</p>
                            </div>
                        </div>
                    @endif
                    @if($profil && $profil->kontak)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary dark:text-accent">call</span>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Kontak</p>
                                <p class="font-semibold">{{ $profil->kontak }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    @if(($profil && $profil->visi) || ($profil && $profil->misi))
    <section id="visi-misi" class="grid md:grid-cols-2 gap-8">

        {{-- Visi --}}
        @if($profil->visi)
        <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border-l-8 border-accent shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-accent text-3xl">lightbulb</span>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Visi</h3>
            </div>
            <p class="text-lg italic leading-relaxed text-slate-700 dark:text-slate-300">
                "{{ $profil->visi }}"
            </p>
        </div>
        @endif

        {{-- Misi --}}
        @if($profil->misi)
        <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border-l-8 border-accent shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-accent text-3xl">assignment</span>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Misi</h3>
            </div>
            @php
                $misiList = array_filter(array_map('trim', explode("\n", $profil->misi)));
            @endphp
            @if(count($misiList) > 1)
                <ul class="space-y-4">
                    @foreach($misiList as $i => $poin)
                        <li class="flex gap-3">
                            <span class="text-accent font-bold shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}.</span>
                            <p class="text-slate-700 dark:text-slate-300">{{ $poin }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">{{ $profil->misi }}</p>
            @endif
        </div>
        @endif

    </section>
    @endif

    {{-- Sejarah --}}
    @if($profil && $profil->sejarah)
    <section class="space-y-8">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Sejarah Singkat</h2>
            <div class="h-1 w-20 bg-accent mx-auto"></div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-10 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 leading-relaxed text-slate-700 dark:text-slate-300 space-y-4">
            @foreach(array_filter(array_map('trim', explode("\n", $profil->sejarah))) as $paragraf)
                <p>{{ $paragraf }}</p>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Kontak --}}
    <section class="space-y-8" id="kontak">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Hubungi Kami</h2>
            <div class="h-1 w-20 bg-accent mx-auto"></div>
        </div>
        <div class="grid md:grid-cols-2 gap-8 items-stretch">

            {{-- Info Kontak --}}
            <div class="space-y-4">
                {{-- Alamat --}}
                @php
                    $alamat = $settings['alamat_sekolah'] ?? $profil->alamat ?? null;
                @endphp
                @if($alamat)
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="bg-primary/10 p-3 rounded-lg text-primary shrink-0">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white">Alamat</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $alamat }}</p>
                    </div>
                </div>
                @endif

                {{-- Telepon --}}
                @php
                    $noTelp = $settings['no_telp'] ?? $profil->kontak ?? null;
                @endphp
                @if($noTelp)
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="bg-primary/10 p-3 rounded-lg text-primary shrink-0">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white">Telepon</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $noTelp }}</p>
                    </div>
                </div>
                @endif

                {{-- Email --}}
                @php
                    $email = $settings['email_sekolah'] ?? null;
                @endphp
                @if($email)
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="bg-primary/10 p-3 rounded-lg text-primary shrink-0">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white">Email</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $email }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Peta --}}
            <div class="h-full min-h-[300px] rounded-xl overflow-hidden border-4 border-white dark:border-slate-900 shadow-xl">
                @if(!empty($settings['maps_embed']))
                    <div class="w-full h-full">
                        {!! $settings['maps_embed'] !!}
                    </div>
                @else
                    <div class="w-full h-full bg-slate-200 dark:bg-slate-800 flex flex-col items-center justify-center text-center p-8">
                        <span class="material-symbols-outlined text-6xl text-primary mb-2">map</span>
                        <p class="font-bold text-primary">Peta Lokasi {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</p>
                        <p class="text-xs text-slate-500 mt-1">Embed peta belum dikonfigurasi</p>
                    </div>
                @endif
            </div>

        </div>
    </section>

</div>

@endsection
