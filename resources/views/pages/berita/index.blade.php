@extends('layouts.app')

@section('title', 'Berita & Pengumuman — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
.news-card {
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
}
.news-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(13,35,64,.11); }
.news-card:hover .news-thumb { transform: scale(1.07); }
.news-thumb { transition: transform .5s cubic-bezier(.22,1,.36,1); }

/* Category pills active */
.cat-pill-active {
    background: #0D2340; color: white;
    box-shadow: 0 4px 14px rgba(13,35,64,.25);
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="bg-white dark:bg-slate-950 border-b border-sand dark:border-slate-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 mb-5 text-xs font-bold text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-accent">Berita</span>
        </div>
        <div class="max-w-3xl">
            <span class="section-eyebrow mb-4 inline-flex">
                <span class="material-symbols-outlined text-sm">newspaper</span>
                Pusat Informasi
            </span>
            <h1 class="font-display text-5xl md:text-6xl font-black text-slate-900 dark:text-white leading-tight mb-4 reveal">
                Berita &
                <span class="italic" style="color:#0B7B8B;">Pengumuman</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed reveal" style="transition-delay:.1s">
                Informasi resmi {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }} — kabar kegiatan, prestasi, dan pengumuman terkini.
            </p>
        </div>
    </div>
</section>

{{-- Filter & Content --}}
<section class="py-12 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Category filter pills --}}
        <div class="flex flex-wrap items-center gap-2.5 mb-12 reveal">
            <a href="{{ route('berita') }}"
               class="px-5 py-2 rounded-full text-xs font-black transition-all shadow-sm border
                      {{ !$kategori ? 'cat-pill-active border-transparent' : 'bg-white dark:bg-slate-800 border-sand dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-secondary/40 hover:text-secondary' }}">
                Semua
            </a>
            @foreach($kategoris as $kat)
                <a href="{{ route('berita', ['kategori' => $kat]) }}"
                   class="px-5 py-2 rounded-full text-xs font-black transition-all shadow-sm border
                          {{ $kategori === $kat ? 'cat-pill-active border-transparent' : 'bg-white dark:bg-slate-800 border-sand dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-secondary/40 hover:text-secondary' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

        @if($beritas->isEmpty())
            <div class="text-center py-20 reveal">
                <div class="w-20 h-20 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined text-4xl text-primary/30">article</span>
                </div>
                <h3 class="font-display text-xl font-black text-slate-500 mb-2">Belum Ada Berita</h3>
                <p class="text-slate-400 text-sm mb-5">
                    {{ $kategori ? 'Belum ada berita dalam kategori ini.' : 'Belum ada berita yang dipublikasikan.' }}
                </p>
                @if($kategori)
                    <a href="{{ route('berita') }}"
                       class="inline-flex items-center gap-2 text-sm font-bold text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Lihat semua berita
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger">
                @foreach($beritas as $idx => $berita)
                @php
                    $badgeColor = match(strtolower($berita->kategori ?? '')) {
                        'prestasi'   => 'bg-emerald-500',
                        'kegiatan'   => 'bg-orange-500',
                        'pengumuman' => 'bg-secondary',
                        'pendidikan' => 'bg-blue-600',
                        default      => 'bg-primary',
                    };
                @endphp
                <article class="news-card reveal bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-sand dark:border-slate-800 shadow-sm flex flex-col">
                    {{-- Image --}}
                    <a href="{{ route('berita.show', $berita->id) }}" class="block relative h-48 overflow-hidden">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                 class="news-thumb w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary via-secondary/80 to-primary/70 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white/15 text-8xl" style="font-variation-settings:'FILL' 1">article</span>
                            </div>
                        @endif
                        @if($berita->kategori)
                            <span class="absolute top-3 left-3 {{ $badgeColor }} text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                {{ $berita->kategori }}
                            </span>
                        @endif
                    </a>

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-1.5 text-slate-400 text-[11px] mb-3 font-semibold">
                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                            {{ $berita->tanggal_publish
                                ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y')
                                : $berita->created_at->translatedFormat('d F Y') }}
                        </div>

                        <h3 class="font-display font-black text-slate-900 dark:text-white text-base leading-snug mb-3 line-clamp-2 hover:text-secondary transition-colors">
                            <a href="{{ route('berita.show', $berita->id) }}">{{ $berita->judul }}</a>
                        </h3>

                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($berita->isi), 140) }}
                        </p>

                        <div class="mt-5 pt-4 border-t border-sand dark:border-slate-800 flex items-center justify-between">
                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="text-primary dark:text-accent font-black text-xs inline-flex items-center gap-1 hover:gap-2.5 transition-all group">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                            <span class="text-slate-300 dark:text-slate-600 text-xs">#{{ $berita->id }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($beritas->hasPages())
                <nav class="flex items-center justify-center gap-2 mt-16 pt-8 border-t border-sand dark:border-slate-800">
                    @if($beritas->onFirstPage())
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-300 cursor-not-allowed">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $beritas->previousPageUrl() }}"
                           class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-500 hover:bg-cream hover:border-secondary/40 transition-all">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </a>
                    @endif

                    @foreach($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                        @if($page == $beritas->currentPage())
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white text-sm font-black shadow-md shadow-primary/25">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                               class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-600 dark:text-slate-400 text-sm font-bold hover:bg-cream hover:border-secondary/40 transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($beritas->hasMorePages())
                        <a href="{{ $beritas->nextPageUrl() }}"
                           class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-500 hover:bg-cream hover:border-secondary/40 transition-all">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </a>
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-300 cursor-not-allowed">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </span>
                    @endif
                </nav>
            @endif
        @endif

    </div>
</section>

@endsection
