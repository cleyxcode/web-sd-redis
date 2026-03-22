@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Hero --}}
<section class="bg-white dark:bg-slate-950 border-b border-sand dark:border-slate-800 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 mb-4 text-xs font-bold text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-accent">Riwayat Pendaftaran</span>
        </div>
        <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
                <span class="section-eyebrow mb-3 inline-flex">
                    <span class="material-symbols-outlined text-sm">assignment</span>
                    Riwayat PPDB
                </span>
                <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1 reveal">
                    Riwayat <span class="text-gradient">Pendaftaran</span>
                </h1>
                <p class="text-slate-400 text-sm reveal" style="transition-delay:.08s">Daftar pendaftaran siswa yang telah Anda ajukan.</p>
            </div>
            <a href="{{ route('pendaftaran') }}"
               class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 transition-all active:scale-95 hover:scale-105">
                <span class="material-symbols-outlined text-base">add</span>
                Daftar Baru
            </a>
        </div>
    </div>
</section>

<div class="bg-cream dark:bg-background-dark min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

        @if($pendaftaran->isEmpty())
        {{-- Empty state --}}
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-sand dark:border-slate-800 shadow-sm p-16 text-center reveal">
            <div class="w-20 h-20 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-4xl text-primary/30">assignment</span>
            </div>
            <h3 class="font-display text-xl font-black text-slate-700 dark:text-slate-200 mb-2">Belum Ada Pendaftaran</h3>
            <p class="text-slate-400 text-sm mb-6">Anda belum pernah mengajukan pendaftaran siswa baru.</p>
            <a href="{{ route('pendaftaran') }}"
               class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all hover:scale-105">
                <span class="material-symbols-outlined text-base">edit_document</span>
                Daftar Sekarang
            </a>
        </div>
        @else
        <div class="space-y-5">
            @foreach($pendaftaran as $idx => $item)
                @php
                    $statusConfig = match($item->status) {
                        'diterima' => [
                            'bar'   => 'bg-emerald-500',
                            'badge' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/50',
                            'icon'  => 'check_circle',
                            'label' => 'Diterima',
                        ],
                        'ditolak'  => [
                            'bar'   => 'bg-red-500',
                            'badge' => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800/50',
                            'icon'  => 'cancel',
                            'label' => 'Ditolak',
                        ],
                        default    => [
                            'bar'   => 'bg-amber-400',
                            'badge' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800/50',
                            'icon'  => 'schedule',
                            'label' => 'Menunggu Verifikasi',
                        ],
                    };
                @endphp

                <div class="reveal bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 shadow-sm overflow-hidden hover:shadow-md transition-shadow" style="transition-delay:{{ $idx * .06 }}s">
                    {{-- Status bar --}}
                    <div class="h-1 {{ $statusConfig['bar'] }}"></div>

                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 flex-wrap">
                            {{-- Identitas --}}
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $item->jenis_kelamin === 'L' ? 'from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30' : 'from-pink-100 to-pink-200 dark:from-pink-900/30 dark:to-pink-800/30' }} flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-2xl {{ $item->jenis_kelamin === 'L' ? 'text-blue-500' : 'text-pink-500' }}" style="font-variation-settings:'FILL' 1">
                                        {{ $item->jenis_kelamin === 'L' ? 'boy' : 'girl' }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-display font-black text-slate-900 dark:text-white text-base">{{ $item->nama_anak }}</h3>
                                    <div class="flex flex-wrap items-center gap-3 mt-1">
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">cake</span>
                                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">school</span>
                                            TA {{ $item->infoPendaftaran->tahun_ajaran ?? '-' }}
                                        </span>
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border {{ $statusConfig['badge'] }}">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">{{ $statusConfig['icon'] }}</span>
                                    {{ $statusConfig['label'] }}
                                </span>
                                <a href="{{ route('pendaftaran.detail', $item->id) }}"
                                   class="flex items-center gap-1.5 px-4 py-2 bg-cream dark:bg-slate-800 hover:bg-primary hover:text-white text-slate-600 dark:text-slate-300 rounded-xl text-xs font-bold transition-all group border border-sand dark:border-slate-700">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-sm group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                </a>
                            </div>
                        </div>

                        {{-- Progress stepper --}}
                        <div class="mt-5 pt-4 border-t border-sand dark:border-slate-800">
                            <div class="flex items-center">
                                @php $steps = [
                                    ['Diajukan',  'task_alt'],
                                    ['Diproses',  'manage_search'],
                                    ['Keputusan', 'gavel'],
                                ]; @endphp
                                @foreach($steps as $i => [$label, $icon])
                                    @php
                                        $active = ($i === 0)
                                               || ($item->status !== 'pending' && $i === 1)
                                               || (in_array($item->status, ['diterima','ditolak']) && $i === 2);
                                        $done   = ($active && $i < 2) || ($i === 2 && in_array($item->status, ['diterima','ditolak']));
                                    @endphp
                                    <div class="flex items-center {{ $i < count($steps)-1 ? 'flex-1' : '' }}">
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all
                                                {{ $active ? 'bg-primary text-white shadow-sm shadow-primary/30' : 'bg-sand dark:bg-slate-800 text-slate-400' }}">
                                                <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">{{ $icon }}</span>
                                            </div>
                                            <span class="text-[10px] mt-1 font-bold {{ $active ? 'text-primary dark:text-accent' : 'text-slate-400' }}">{{ $label }}</span>
                                        </div>
                                        @if($i < count($steps)-1)
                                            <div class="flex-1 h-px mx-2 mb-4 {{ $item->status !== 'pending' && $i === 0 ? 'bg-primary' : 'bg-sand dark:bg-slate-700' }}"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

@endsection
