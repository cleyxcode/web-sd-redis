@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-background-dark py-10 px-4">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 dark:text-white">Riwayat Pendaftaran</h1>
                <p class="text-slate-400 text-sm mt-1">Daftar pendaftaran siswa yang telah Anda ajukan.</p>
            </div>
            <a href="{{ route('pendaftaran') }}"
               class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-base">add</span>
                Daftar Baru
            </a>
        </div>

        @if($pendaftaran->isEmpty())
            {{-- Empty state --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-16 text-center">
                <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined text-4xl text-slate-400">assignment</span>
                </div>
                <h3 class="text-lg font-bold text-slate-700 dark:text-slate-200 mb-2">Belum Ada Pendaftaran</h3>
                <p class="text-slate-400 text-sm mb-6">Anda belum pernah mengajukan pendaftaran siswa baru.</p>
                <a href="{{ route('pendaftaran') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined text-base">edit_document</span>
                    Daftar Sekarang
                </a>
            </div>
        @else
            {{-- List --}}
            <div class="space-y-4">
                @foreach($pendaftaran as $item)
                    @php
                        $statusConfig = match($item->status) {
                            'diterima' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400', 'icon' => 'check_circle', 'label' => 'Diterima'],
                            'ditolak'  => ['bg' => 'bg-red-100 dark:bg-red-900/30',   'text' => 'text-red-700 dark:text-red-400',   'icon' => 'cancel',       'label' => 'Ditolak'],
                            default    => ['bg' => 'bg-amber-100 dark:bg-amber-900/30','text' => 'text-amber-700 dark:text-amber-400','icon' => 'schedule',    'label' => 'Menunggu'],
                        };
                    @endphp
                    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        {{-- Status bar --}}
                        <div class="h-1 {{ $item->status === 'diterima' ? 'bg-green-500' : ($item->status === 'ditolak' ? 'bg-red-500' : 'bg-amber-400') }}"></div>

                        <div class="p-5 flex items-center justify-between gap-4 flex-wrap">
                            <div class="flex items-center gap-4">
                                {{-- Avatar --}}
                                <div class="w-14 h-14 rounded-2xl bg-primary/8 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">
                                        {{ $item->jenis_kelamin === 'L' ? 'boy' : 'girl' }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-900 dark:text-white text-base">{{ $item->nama_anak }}</h3>
                                    <div class="flex items-center gap-3 mt-1 flex-wrap">
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">cake</span>
                                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">school</span>
                                            {{ $item->infoPendaftaran->tahun_ajaran ?? '-' }}
                                        </span>
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                {{-- Status badge --}}
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">{{ $statusConfig['icon'] }}</span>
                                    {{ $statusConfig['label'] }}
                                </span>
                                {{-- Detail button --}}
                                <a href="{{ route('pendaftaran.detail', $item->id) }}"
                                   class="flex items-center gap-1.5 px-4 py-2 bg-slate-50 dark:bg-slate-700 hover:bg-primary hover:text-white text-slate-600 dark:text-slate-300 rounded-xl text-xs font-bold transition-all group">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-sm group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                </a>
                            </div>
                        </div>

                        {{-- Progress steps --}}
                        <div class="px-5 pb-5">
                            <div class="flex items-center gap-0">
                                @php $steps = [['Diajukan','task_alt'],['Diproses','manage_search'],['Keputusan','gavel']]; @endphp
                                @foreach($steps as $i => [$label, $icon])
                                    @php
                                        $done = ($item->status !== 'pending' && $i <= 1) || ($item->status !== 'pending' && $i === 2);
                                        $active = ($i === 0) || ($item->status !== 'pending' && $i === 1) || (in_array($item->status, ['diterima','ditolak']) && $i === 2);
                                    @endphp
                                    <div class="flex items-center {{ $i < count($steps)-1 ? 'flex-1' : '' }}">
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all
                                                {{ $active ? 'bg-primary text-white shadow-md shadow-primary/30' : 'bg-slate-100 dark:bg-slate-700 text-slate-400' }}">
                                                <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">{{ $icon }}</span>
                                            </div>
                                            <span class="text-xs mt-1 {{ $active ? 'text-primary font-semibold' : 'text-slate-400' }}">{{ $label }}</span>
                                        </div>
                                        @if($i < count($steps)-1)
                                            <div class="flex-1 h-px mx-2 mb-4 {{ $item->status !== 'pending' && $i === 0 ? 'bg-primary' : 'bg-slate-200 dark:bg-slate-700' }}"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
