@extends('layouts.app')

@section('title', $berita->judul . ' - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Konten Utama --}}
        <article class="lg:col-span-2">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 mb-6 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="{{ route('berita') }}">Berita</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-primary line-clamp-1">{{ Str::limit($berita->judul, 40) }}</span>
            </div>

            {{-- Kategori & Tanggal --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($berita->kategori)
                    <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $berita->kategori }}
                    </span>
                @endif
                <div class="flex items-center text-slate-400 text-xs">
                    <span class="material-symbols-outlined text-sm mr-1">calendar_today</span>
                    {{ $berita->tanggal_publish
                        ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y')
                        : $berita->created_at->translatedFormat('d F Y') }}
                </div>
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-6 leading-tight">
                {{ $berita->judul }}
            </h1>

            {{-- Gambar Utama --}}
            @if($berita->gambar)
                <div class="w-full h-72 md:h-96 rounded-2xl overflow-hidden mb-8">
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         alt="{{ $berita->judul }}"
                         class="w-full h-full object-cover"/>
                </div>
            @endif

            {{-- Isi Berita --}}
            <div class="prose prose-slate prose-lg max-w-none dark:prose-invert
                        prose-headings:text-primary prose-a:text-primary prose-img:rounded-xl">
                {!! $berita->isi !!}
            </div>

            {{-- Kembali --}}
            <div class="mt-10 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('berita') }}"
                   class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali ke Daftar Berita
                </a>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="lg:col-span-1">
            <div class="sticky top-24">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Berita Lainnya</h3>
                <div class="w-12 h-1 bg-accent rounded-full mb-6"></div>

                @if($lainnya->isEmpty())
                    <p class="text-slate-400 text-sm">Tidak ada berita lain.</p>
                @else
                    <div class="space-y-5">
                        @foreach($lainnya as $item)
                            <a href="{{ route('berita.show', $item->id) }}"
                               class="flex gap-4 group">
                                {{-- Thumbnail --}}
                                <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                             alt="{{ $item->judul }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"/>
                                    @else
                                        <div class="w-full h-full bg-primary/10 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary">article</span>
                                        </div>
                                    @endif
                                </div>
                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-slate-400 mb-1">
                                        {{ $item->tanggal_publish
                                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                            : $item->created_at->translatedFormat('d M Y') }}
                                    </p>
                                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200 line-clamp-2 group-hover:text-primary transition-colors">
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

@endsection
