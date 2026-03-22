@extends('layouts.app')

@section('title', $berita->judul . ' - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Breadcrumb --}}
<div class="bg-white dark:bg-slate-950 border-b border-sand dark:border-slate-800 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a href="{{ route('berita') }}" class="hover:text-secondary transition-colors">Berita</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-accent line-clamp-1 max-w-[200px]">{{ Str::limit($berita->judul, 40) }}</span>
        </div>
    </div>
</div>

<div class="bg-cream dark:bg-background-dark py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Konten Utama --}}
            <article class="lg:col-span-2">
                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($berita->kategori)
                        <span class="bg-primary/8 text-primary text-[11px] font-black px-3 py-1.5 rounded-full uppercase tracking-wider">
                            {{ $berita->kategori }}
                        </span>
                    @endif
                    <div class="flex items-center text-slate-400 text-xs font-semibold gap-1.5">
                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                        {{ $berita->tanggal_publish
                            ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y')
                            : $berita->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>

                {{-- Judul --}}
                <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-7 leading-tight">
                    {{ $berita->judul }}
                </h1>

                {{-- Gambar Utama --}}
                @if($berita->gambar)
                    <div class="w-full h-72 md:h-96 rounded-2xl overflow-hidden mb-8 shadow-lg">
                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                             alt="{{ $berita->judul }}"
                             class="w-full h-full object-cover"/>
                    </div>
                @endif

                {{-- Isi Berita --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 p-7 md:p-10 shadow-sm">
                    <div class="prose prose-slate max-w-none dark:prose-invert
                                prose-headings:font-display prose-headings:text-primary dark:prose-headings:text-accent
                                prose-a:text-secondary prose-img:rounded-xl prose-img:shadow-md">
                        {!! $berita->isi !!}
                    </div>
                </div>

                {{-- Kembali --}}
                <div class="mt-8">
                    <a href="{{ route('berita') }}"
                       class="inline-flex items-center gap-2 text-sm font-bold text-primary dark:text-accent hover:gap-3 transition-all">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Kembali ke Daftar Berita
                    </a>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="flex items-center gap-2 mb-5">
                        <span class="w-5 h-0.5 bg-accent rounded-full"></span>
                        <h3 class="font-display font-black text-slate-900 dark:text-white text-base">Berita Lainnya</h3>
                    </div>

                    @if($lainnya->isEmpty())
                        <p class="text-slate-400 text-sm">Tidak ada berita lain.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($lainnya as $item)
                                <a href="{{ route('berita.show', $item->id) }}"
                                   class="flex gap-3.5 group bg-white dark:bg-slate-900 rounded-xl border border-sand dark:border-slate-800 p-3 hover:border-secondary/40 transition-all hover:shadow-sm">
                                    <div class="w-18 h-16 w-16 rounded-lg overflow-hidden shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                 alt="{{ $item->judul }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"/>
                                        @else
                                            <div class="w-full h-full bg-primary/8 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-primary/40 text-lg">article</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[11px] text-slate-400 font-semibold mb-1">
                                            {{ $item->tanggal_publish
                                                ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                                : $item->created_at->translatedFormat('d M Y') }}
                                        </p>
                                        <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 line-clamp-3 group-hover:text-secondary transition-colors leading-snug">
                                            {{ $item->judul }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </aside>

        </div>
    </div>
</div>

@endsection
