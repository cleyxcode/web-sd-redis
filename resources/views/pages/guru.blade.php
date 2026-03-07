@extends('layouts.app')

@section('title', 'Daftar Guru - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Hero Section --}}
<section class="bg-white dark:bg-slate-900 py-12 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="flex items-center justify-center gap-2 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-slate-200">Guru</span>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl">
            Daftar Guru &amp; Tenaga Pengajar
        </h2>
        <p class="mt-4 text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
            Mengenal lebih dekat para pendidik profesional kami yang berdedikasi tinggi untuk mencerdaskan generasi bangsa di {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}.
        </p>
    </div>
</section>

{{-- Teachers Grid --}}
<section class="max-w-7xl mx-auto px-4 py-16">

    @if($gurus->isEmpty())
        <div class="text-center py-20 text-slate-400">
            <span class="material-symbols-outlined text-6xl mb-4 block">person_off</span>
            <p class="text-lg">Belum ada data guru yang tersedia.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($gurus as $guru)
                <div class="group relative flex flex-col items-center p-6 bg-white dark:bg-slate-900 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    {{-- Foto --}}
                    <div class="relative size-32 mb-6">
                        <div class="absolute inset-0 rounded-full border-2 border-primary/20 scale-110 group-hover:scale-125 transition-transform duration-500"></div>
                        @if($guru->foto)
                            <img
                                src="{{ asset('storage/' . $guru->foto) }}"
                                alt="Foto {{ $guru->nama }}"
                                class="size-full rounded-full object-cover shadow-md"
                            />
                        @else
                            <div class="size-full rounded-full bg-primary/10 flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-5xl text-primary">account_circle</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="text-center">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $guru->nama }}</h3>

                        @if($guru->jabatan)
                            <p class="text-primary font-semibold text-sm mt-1 uppercase tracking-wider">
                                {{ $guru->jabatan }}
                            </p>
                        @endif

                        @if($guru->mata_pelajaran)
                            <div class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs">
                                <span class="material-symbols-outlined text-sm">school</span>
                                {{ $guru->mata_pelajaran }}
                            </div>
                        @endif

                        @if($guru->nip)
                            <p class="text-slate-400 text-xs mt-2">NIP: {{ $guru->nip }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</section>

@endsection
