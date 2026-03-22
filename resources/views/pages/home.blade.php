@extends('layouts.app')

@section('title', ($profil->nama_sekolah ?? 'SD Negeri Warialau') . ' — Official Website')

@push('styles')
<style>
/* ── Hero Slider ── */
.slide { position:absolute; inset:0; opacity:0; z-index:0; transition:opacity .8s cubic-bezier(.4,0,.2,1); }
.slide.active { opacity:1; z-index:10; }

/* ── Hero height — mobile kecil dulu ── */
#hero {
    height: 52svh;
    min-height: 340px;
    max-height: 480px;
}
@media (min-width: 640px) {
    #hero {
        height: 68svh;
        min-height: 460px;
        max-height: 620px;
    }
}
@media (min-width: 1024px) {
    #hero {
        height: calc(100svh - 68px);
        min-height: 540px;
        max-height: 780px;
    }
}

/* ── Animated counter ── */
@keyframes countUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
.stat-num { animation: countUp .6s cubic-bezier(.22,1,.36,1) both; }

/* ── News card hover ── */
.news-card { transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease; }
.news-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(13,35,64,.12); }
.news-card:hover .news-img { transform: scale(1.07); }
.news-img { transition: transform .5s cubic-bezier(.22,1,.36,1); }

/* ── Category card ── */
.cat-card { transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease, background .2s; }
.cat-card:hover { transform: translateY(-5px) scale(1.04); box-shadow: 0 14px 36px rgba(13,35,64,.12); }

/* ── FAQ ── */
.faq-body { max-height: 0; overflow: hidden; transition: max-height .4s cubic-bezier(.22,1,.36,1), padding .3s ease; }
.faq-body.open { max-height: 300px; }

/* ── Gradient text ── */
.text-gradient {
    background: linear-gradient(135deg, #C9933A 0%, #E8B86D 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ── Accent underline ── */
.underline-accent {
    position: relative; display: inline-block;
}
.underline-accent::after {
    content: '';
    position: absolute; bottom: -4px; left: 0; right: 0;
    height: 3px; background: linear-gradient(90deg, #C9933A, #0B7B8B);
    border-radius: 9999px;
    transform: scaleX(0); transform-origin: left;
    transition: transform .4s cubic-bezier(.22,1,.36,1);
}
.underline-accent:hover::after { transform: scaleX(1); }

/* ── Ticker ── */
@keyframes ticker { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
.ticker-inner { animation: ticker 22s linear infinite; display:flex; width:max-content; }
.ticker-inner:hover { animation-play-state: paused; }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════
     HERO — BANNER SLIDER
══════════════════════════════════════════════ --}}
<section class="relative w-full overflow-hidden bg-primary" id="hero">

    @if($banners->isNotEmpty())
        @foreach($banners as $i => $banner)
            <div class="slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
                <div class="absolute inset-0 bg-primary">
                    {{-- Blurred bg fill (agar area kosong tidak polos) --}}
                    <div class="absolute inset-0 scale-110 blur-2xl opacity-30"
                         style="background-image:url('{{ asset('storage/' . $banner->gambar) }}');
                                background-size:cover; background-position:center;"></div>
                    {{-- Gambar utama: object-contain agar tidak crop/zoom --}}
                    <img src="{{ asset('storage/' . $banner->gambar) }}"
                         alt="{{ $banner->judul }}"
                         class="absolute inset-0 w-full h-full object-contain"
                         loading="{{ $i === 0 ? 'eager' : 'lazy' }}"/>
                    {{-- Overlay untuk keterbacaan teks --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/85 via-primary/60 to-primary/20"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-transparent to-transparent"></div>
                </div>
                <div class="relative z-10 h-full flex items-center px-5 sm:px-10 md:px-14 lg:px-24">
                    <div class="w-full max-w-2xl">
                        <div class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold mb-3 sm:mb-5 reveal" style="transition-delay:.1s">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse shrink-0"></span>
                            <span class="truncate max-w-[180px] sm:max-w-none">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</span>
                        </div>
                        <h1 class="font-display text-[1.6rem] sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 sm:mb-5 leading-tight reveal" style="transition-delay:.2s">
                            {{ $banner->judul }}
                        </h1>
                        <div class="flex flex-wrap gap-2 sm:gap-3 reveal" style="transition-delay:.32s">
                            @if($pendaftaranAktif)
                                <a href="{{ route('pendaftaran') }}"
                                   class="inline-flex items-center gap-1.5 bg-accent hover:bg-accent/90 text-primary px-4 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-black text-xs sm:text-sm transition-all hover:scale-105 shadow-xl shadow-accent/30">
                                    <span class="material-symbols-outlined text-sm sm:text-base">how_to_reg</span>
                                    Daftar Sekarang
                                </a>
                            @endif
                            <a href="{{ route('profil') }}"
                               class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white px-4 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-bold text-xs sm:text-sm transition-all hover:scale-105">
                                <span class="material-symbols-outlined text-sm sm:text-base">info</span>
                                Profil Sekolah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Controls --}}
        @if($banners->count() > 1)
            <button id="slider-prev"
                    class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-30 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-white/12 hover:bg-white/25 backdrop-blur-sm text-white flex items-center justify-center transition-all border border-white/20 hover:scale-110">
                <span class="material-symbols-outlined text-lg sm:text-2xl">chevron_left</span>
            </button>
            <button id="slider-next"
                    class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-30 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-white/12 hover:bg-white/25 backdrop-blur-sm text-white flex items-center justify-center transition-all border border-white/20 hover:scale-110">
                <span class="material-symbols-outlined text-lg sm:text-2xl">chevron_right</span>
            </button>
            <div class="absolute bottom-4 sm:bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-1.5 sm:gap-2">
                @foreach($banners as $i => $banner)
                    <button class="slider-dot transition-all rounded-full {{ $i === 0 ? 'w-6 sm:w-8 h-2 sm:h-2.5 bg-accent' : 'w-2 sm:w-2.5 h-2 sm:h-2.5 bg-white/40 hover:bg-white/70' }}"
                            data-index="{{ $i }}"></button>
                @endforeach
            </div>
        @endif

    @else
        {{-- Fallback Hero --}}
        <div class="absolute inset-0 bg-primary">
            @if(!empty($settings['background']))
                {{-- Blurred bg fill --}}
                <div class="absolute inset-0 scale-110 blur-2xl opacity-30"
                     style="background-image:url('{{ asset('storage/'.$settings['background']) }}');
                            background-size:cover; background-position:center;"></div>
                {{-- Gambar penuh tanpa crop --}}
                <img src="{{ asset('storage/'.$settings['background']) }}"
                     alt="Background"
                     class="absolute inset-0 w-full h-full object-contain"/>
            @endif
            <div class="absolute inset-0 bg-gradient-to-br from-primary/90 via-primary/75 to-secondary/60"></div>
        </div>
        <div class="relative z-10 h-full flex items-center px-5 sm:px-10 md:px-14 lg:px-24">
            <div class="w-full max-w-2xl">
                <div class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold mb-3 sm:mb-5 reveal">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse shrink-0"></span>
                    Terakreditasi {{ $profil->akreditasi ?? 'B' }} · Sejak {{ $profil->tahun_berdiri ?? '1980' }}
                </div>
                <h1 class="font-display text-[1.4rem] sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-1.5 sm:mb-2 leading-tight reveal" style="transition-delay:.1s">
                    Selamat Datang di
                </h1>
                <h1 class="font-display text-[1.55rem] sm:text-3xl md:text-4xl lg:text-5xl font-black leading-tight mb-4 sm:mb-5 text-gradient reveal" style="transition-delay:.18s">
                    {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                </h1>
                <p class="text-white/65 text-xs sm:text-sm md:text-base mb-5 sm:mb-7 max-w-lg leading-relaxed reveal hidden sm:block" style="transition-delay:.28s">
                    @if($profil?->visi)
                        {{ \Illuminate\Support\Str::limit($profil->visi, 110) }}
                    @else
                        Mewujudkan generasi cerdas, berkarakter mulia, dan berakhlak tinggi di Kepulauan Aru.
                    @endif
                </p>
                <div class="flex flex-wrap gap-2 sm:gap-3 reveal" style="transition-delay:.36s">
                    @if($pendaftaranAktif)
                        <a href="{{ route('pendaftaran') }}"
                           class="inline-flex items-center gap-1.5 bg-accent hover:bg-accent/90 text-primary px-4 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-black text-xs sm:text-sm transition-all hover:scale-105 shadow-xl shadow-accent/30">
                            <span class="material-symbols-outlined text-sm sm:text-base">how_to_reg</span>
                            Daftar Sekarang
                        </a>
                    @endif
                    <a href="{{ route('profil') }}"
                       class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white px-4 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-bold text-xs sm:text-sm transition-all">
                        <span class="material-symbols-outlined text-sm sm:text-base">info</span>
                        Profil Sekolah
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Bottom stats strip --}}
    <div class="absolute bottom-6 right-6 z-30 hidden md:flex items-center gap-3">
        <div class="bg-black/30 backdrop-blur-md border border-white/15 rounded-2xl px-5 py-3 flex items-center gap-3">
            <div class="w-9 h-9 bg-accent/20 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-accent text-lg" style="font-variation-settings:'FILL' 1">groups_3</span>
            </div>
            <div>
                <p class="text-white font-black text-sm leading-none font-display">{{ $jumlahSiswa }}+</p>
                <p class="text-white/50 text-[10px] font-semibold mt-0.5">Siswa Aktif</p>
            </div>
        </div>
        <div class="bg-black/30 backdrop-blur-md border border-white/15 rounded-2xl px-5 py-3 flex items-center gap-3">
            <div class="w-9 h-9 bg-secondary/20 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-secondary text-lg" style="font-variation-settings:'FILL' 1">group</span>
            </div>
            <div>
                <p class="text-white font-black text-sm leading-none font-display">{{ $jumlahGuru }}+</p>
                <p class="text-white/50 text-[10px] font-semibold mt-0.5">Guru Aktif</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     STAT TICKER
══════════════════════════════════════════════ --}}
<div class="bg-accent overflow-hidden py-2.5 sm:py-3 select-none">
    <div class="ticker-inner text-primary font-black text-[10px] sm:text-xs uppercase tracking-widest gap-0">
        @php $ticks = [
            '🎓 ' . $jumlahSiswa . ' Siswa Aktif',
            '👩‍🏫 ' . $jumlahGuru . ' Guru Berpengalaman',
            '⭐ Akreditasi ' . ($profil->akreditasi ?? 'B'),
            '📅 Berdiri Sejak ' . ($profil->tahun_berdiri ?? '1980'),
            '🏆 15+ Prestasi Siswa',
            '📚 Program Unggulan Berkualitas',
        ]; @endphp
        @foreach(array_merge($ticks, $ticks) as $tick)
            <span class="inline-flex items-center px-8 gap-4">
                {{ $tick }}
                <span class="w-1 h-1 rounded-full bg-primary/40"></span>
            </span>
        @endforeach
    </div>
</div>

{{-- ══════════════════════════════════════════════
     STATS CARDS
══════════════════════════════════════════════ --}}
<section class="py-14 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 stagger">
            @php $statsData = [
                ['icon'=>'groups_3',       'val'=>$jumlahSiswa.'+', 'lbl'=>'Siswa Aktif',    'color'=>'from-blue-500 to-blue-600',      'light'=>'bg-blue-50 text-blue-600'],
                ['icon'=>'group',          'val'=>$jumlahGuru.'+',  'lbl'=>'Guru & Staf',    'color'=>'from-secondary to-teal-600',    'light'=>'bg-teal-50 text-secondary'],
                ['icon'=>'event_available','val'=>($profil->tahun_berdiri??'1980'), 'lbl'=>'Tahun Berdiri', 'color'=>'from-accent to-amber-500', 'light'=>'bg-amber-50 text-amber-600'],
                ['icon'=>'emoji_events',   'val'=>'15+',            'lbl'=>'Prestasi',       'color'=>'from-rose-500 to-pink-600',      'light'=>'bg-rose-50 text-rose-500'],
            ]; @endphp

            @foreach($statsData as $s)
            <div class="reveal bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 rounded-2xl p-5 shadow-sm card-lift overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-br {{ $s['color'] }} opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative flex items-center gap-4">
                    <div class="{{ $s['light'] }} w-12 h-12 rounded-xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-110 duration-300">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings:'FILL' 1">{{ $s['icon'] }}</span>
                    </div>
                    <div>
                        <p class="font-display text-2xl font-black text-slate-900 dark:text-white leading-none stat-num">{{ $s['val'] }}</p>
                        <p class="text-slate-400 text-xs font-semibold mt-1">{{ $s['lbl'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     TENTANG SEKOLAH
══════════════════════════════════════════════ --}}
<section class="py-20 bg-white dark:bg-slate-950 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Visual kolase --}}
            <div class="relative reveal-left">
                <div class="relative grid grid-cols-2 gap-4">
                    {{-- Tahun mengabdi --}}
                    <div class="col-span-2 bg-primary rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white flex items-center gap-4 sm:gap-6 shadow-2xl shadow-primary/25 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5 rounded-full"></div>
                        <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-accent/10 rounded-full"></div>
                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-accent/20 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 border border-accent/30">
                            <span class="material-symbols-outlined text-accent text-2xl sm:text-3xl" style="font-variation-settings:'FILL' 1">school</span>
                        </div>
                        <div class="relative z-10">
                            <p class="font-display text-4xl sm:text-5xl font-black text-accent leading-none">{{ date('Y') - ($profil->tahun_berdiri ?? 1980) }}</p>
                            <p class="text-white/70 text-xs sm:text-sm font-semibold mt-1">Tahun Mengabdi Dunia Pendidikan</p>
                            <p class="text-white/40 text-[10px] sm:text-xs mt-0.5">Sejak tahun {{ $profil->tahun_berdiri ?? '1980' }}</p>
                        </div>
                    </div>

                    {{-- Akreditasi --}}
                    <div class="bg-accent rounded-2xl p-4 sm:p-6 flex flex-col items-center justify-center text-center relative overflow-hidden shadow-xl shadow-accent/20">
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-white/15 rounded-full"></div>
                        <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl mb-1" style="font-variation-settings:'FILL' 1">verified</span>
                        <p class="text-primary/70 text-[9px] sm:text-[10px] font-black uppercase tracking-widest">Akreditasi</p>
                        <p class="font-display text-5xl sm:text-6xl font-black text-primary leading-none">{{ $profil->akreditasi ?? 'B' }}</p>
                    </div>

                    {{-- Siswa --}}
                    <div class="bg-cream dark:bg-slate-800 rounded-2xl p-4 sm:p-6 border border-sand dark:border-slate-700 flex flex-col items-center justify-center text-center shadow-sm">
                        <span class="material-symbols-outlined text-secondary text-2xl sm:text-3xl mb-1" style="font-variation-settings:'FILL' 1">groups_3</span>
                        <p class="font-display text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">{{ $jumlahSiswa }}+</p>
                        <p class="text-slate-400 text-[10px] sm:text-xs font-semibold mt-1">Siswa Aktif</p>
                    </div>
                </div>

                {{-- Decorative dots --}}
                <div class="absolute -bottom-8 -left-8 grid grid-cols-4 gap-2 opacity-20 pointer-events-none">
                    @for($d=0;$d<16;$d++)
                        <div class="w-2 h-2 rounded-full bg-primary"></div>
                    @endfor
                </div>
            </div>

            {{-- Teks --}}
            <div class="reveal-right">
                <span class="section-eyebrow mb-4 inline-flex">
                    <span class="material-symbols-outlined text-sm">info</span>
                    Tentang Kami
                </span>
                <h2 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-5 leading-tight">
                    Membangun Generasi
                    <span class="text-gradient"> Cerdas & Berkarakter</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-7 text-[15px]">
                    @if($profil?->sejarah)
                        {{ \Illuminate\Support\Str::limit($profil->sejarah, 280) }}
                    @else
                        SD Negeri Warialau berdiri sejak tahun {{ $profil->tahun_berdiri ?? '1980' }} dan telah menjadi pusat pendidikan berkualitas di Kepulauan Aru. Dengan tenaga pendidik berpengalaman, kami berkomitmen mencetak generasi penerus bangsa yang siap menghadapi masa depan.
                    @endif
                </p>
                <div class="space-y-3 mb-8">
                    @foreach([
                        ['icon'=>'star','text'=>'Pembelajaran aktif, inovatif, dan menyenangkan'],
                        ['icon'=>'verified_user','text'=>'Tenaga pendidik berpengalaman & bersertifikat'],
                        ['icon'=>'sports_soccer','text'=>'Program ekstrakurikuler beragam & berkualitas'],
                        ['icon'=>'shield','text'=>'Lingkungan belajar yang aman & kondusif'],
                    ] as $feat)
                    <div class="flex items-center gap-3.5 group">
                        <div class="w-8 h-8 rounded-xl bg-secondary/10 flex items-center justify-center shrink-0 group-hover:bg-secondary/20 transition-colors">
                            <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings:'FILL' 1">{{ $feat['icon'] }}</span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $feat['text'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profil') }}"
                       class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all hover:scale-105">
                        Selengkapnya <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                    <a href="{{ route('guru') }}"
                       class="inline-flex items-center gap-2 border-2 border-sand hover:border-secondary text-slate-600 dark:text-slate-300 hover:text-secondary px-6 py-3 rounded-xl font-bold text-sm transition-all">
                        Lihat Guru
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     BERITA TERBARU
══════════════════════════════════════════════ --}}
<section class="py-20 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 reveal">
            <div>
                <span class="section-eyebrow mb-3 inline-flex">
                    <span class="material-symbols-outlined text-sm">newspaper</span>
                    Informasi Terbaru
                </span>
                <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white leading-tight">
                    Berita &<br class="sm:hidden"/> <span class="text-gradient">Kegiatan</span>
                </h2>
            </div>
            <a href="{{ route('berita') }}"
               class="mt-5 sm:mt-0 inline-flex items-center gap-1.5 text-sm font-bold text-primary dark:text-accent border border-primary/20 dark:border-accent/30 hover:border-primary dark:hover:border-accent hover:bg-primary/5 px-4 py-2 rounded-xl transition-all">
                Semua Berita <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        @if($beritaTerbaru->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger">
                @foreach($beritaTerbaru as $idx => $berita)
                @php
                    $featured = $idx === 0;
                    $badgeColor = match(strtolower($berita->kategori ?? '')) {
                        'prestasi'   => 'bg-emerald-500',
                        'kegiatan'   => 'bg-orange-500',
                        'pengumuman' => 'bg-secondary',
                        'pendidikan' => 'bg-blue-600',
                        default      => 'bg-primary',
                    };
                @endphp
                <article class="news-card reveal bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-sand dark:border-slate-800 shadow-sm flex flex-col {{ $featured ? 'md:col-span-1 md:row-span-1' : '' }}">
                    <a href="{{ route('berita.show', $berita->id) }}" class="block relative overflow-hidden {{ $featured ? 'h-52' : 'h-44' }}">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}"
                                 class="news-img w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary via-secondary to-primary/70 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white/20 text-8xl" style="font-variation-settings:'FILL' 1">article</span>
                            </div>
                        @endif
                        @if($berita->kategori)
                            <span class="absolute top-3 left-3 {{ $badgeColor }} text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider">
                                {{ $berita->kategori }}
                            </span>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-center gap-1.5 text-slate-400 text-xs mb-2.5">
                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                            {{ ($berita->tanggal_publish
                                ? \Carbon\Carbon::parse($berita->tanggal_publish)
                                : $berita->created_at)->translatedFormat('d M Y') }}
                        </div>
                        <h3 class="font-display font-black text-slate-900 dark:text-white text-base leading-snug mb-3 line-clamp-2 hover:text-secondary transition-colors">
                            <a href="{{ route('berita.show', $berita->id) }}">{{ $berita->judul }}</a>
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed flex-grow">
                            {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100) }}
                        </p>
                        <div class="mt-4 pt-3.5 border-t border-sand dark:border-slate-800">
                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="text-primary dark:text-accent font-bold text-xs inline-flex items-center gap-1 hover:gap-2.5 transition-all group">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 reveal">
                <span class="material-symbols-outlined text-7xl text-slate-200 dark:text-slate-700 block mb-4">newspaper</span>
                <p class="text-slate-400 font-medium">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════
     KATEGORI BERITA
══════════════════════════════════════════════ --}}
<section class="py-16 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 reveal">
            <span class="section-eyebrow mb-3 inline-flex">
                <span class="material-symbols-outlined text-sm">category</span>
                Jelajahi
            </span>
            <h2 class="font-display text-3xl font-black text-slate-900 dark:text-white">
                Kategori <span class="text-gradient">Informasi</span>
            </h2>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-6 gap-4 stagger">
            @php $cats = [
                ['lbl'=>'Akademik',        'icon'=>'menu_book',      'from'=>'from-blue-500',    'to'=>'to-blue-600',    'bg'=>'bg-blue-50 dark:bg-blue-900/20'],
                ['lbl'=>'Prestasi',        'icon'=>'emoji_events',   'from'=>'from-amber-400',   'to'=>'to-amber-500',   'bg'=>'bg-amber-50 dark:bg-amber-900/20'],
                ['lbl'=>'Kegiatan',        'icon'=>'event',          'from'=>'from-emerald-500', 'to'=>'to-emerald-600', 'bg'=>'bg-emerald-50 dark:bg-emerald-900/20'],
                ['lbl'=>'Pengumuman',      'icon'=>'campaign',       'from'=>'from-secondary',   'to'=>'to-teal-600',    'bg'=>'bg-teal-50 dark:bg-teal-900/20'],
                ['lbl'=>'Ekstrakurikuler', 'icon'=>'sports_soccer',  'from'=>'from-rose-500',    'to'=>'to-pink-600',    'bg'=>'bg-rose-50 dark:bg-rose-900/20'],
                ['lbl'=>'Berita',          'icon'=>'newspaper',      'from'=>'from-primary',     'to'=>'to-blue-800',    'bg'=>'bg-primary/5 dark:bg-primary/20'],
            ]; @endphp
            @foreach($cats as $cat)
                <a href="{{ route('berita', ['kategori'=>$cat['lbl']]) }}"
                   class="cat-card reveal group flex flex-col items-center gap-3 {{ $cat['bg'] }} hover:bg-white dark:hover:bg-slate-800 border border-transparent hover:border-sand dark:hover:border-slate-700 rounded-2xl p-4 shadow-sm cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br {{ $cat['from'] }} {{ $cat['to'] }} rounded-xl flex items-center justify-center shadow-md transition-all group-hover:scale-115 group-hover:shadow-lg duration-300">
                        <span class="material-symbols-outlined text-white text-xl" style="font-variation-settings:'FILL' 1">{{ $cat['icon'] }}</span>
                    </div>
                    <p class="text-[11px] font-bold text-slate-600 dark:text-slate-300 group-hover:text-primary dark:group-hover:text-accent text-center transition-colors leading-tight">{{ $cat['lbl'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     GALERI PREVIEW
══════════════════════════════════════════════ --}}
@if($galeri->isNotEmpty())
<section class="py-20 bg-cream dark:bg-background-dark overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 reveal">
            <div>
                <span class="section-eyebrow mb-3 inline-flex">
                    <span class="material-symbols-outlined text-sm">photo_library</span>
                    Galeri
                </span>
                <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white">
                    Momen <span class="text-gradient">Berharga</span>
                </h2>
                <p class="text-slate-400 text-sm mt-2">Dokumentasi kegiatan dan aktivitas sekolah</p>
            </div>
            <a href="{{ route('galeri') }}"
               class="mt-5 sm:mt-0 inline-flex items-center gap-1.5 text-sm font-bold text-primary dark:text-accent border border-primary/20 dark:border-accent/30 hover:border-primary hover:bg-primary/5 px-4 py-2 rounded-xl transition-all">
                Semua Foto <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        {{-- Mosaic grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 auto-rows-[120px] sm:auto-rows-[140px] md:auto-rows-[160px] gap-2 sm:gap-3 stagger">
            @foreach($galeri->take(8) as $idx => $item)
            @php
                $span = match($idx) {
                    0 => 'row-span-2 col-span-1 md:col-span-2',
                    3 => 'col-span-1 md:col-span-2',
                    default => '',
                };
            @endphp
            <a href="{{ route('galeri') }}"
               class="reveal group relative rounded-2xl overflow-hidden shadow-sm card-lift {{ $span }}">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                     style="background-image:url('{{ asset('storage/'.$item->foto) }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                    <p class="text-white text-xs font-bold line-clamp-2">{{ $item->judul }}</p>
                </div>
                <div class="absolute top-3 right-3 w-7 h-7 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="material-symbols-outlined text-white text-sm">zoom_in</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     FAQ
══════════════════════════════════════════════ --}}
<section class="py-20 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-14 items-start">

            {{-- Left --}}
            <div class="lg:col-span-2 reveal-left">
                <span class="section-eyebrow mb-4 inline-flex">
                    <span class="material-symbols-outlined text-sm">help</span>
                    FAQ
                </span>
                <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white mb-3 leading-tight">
                    Pertanyaan <span class="text-gradient">Umum</span>
                </h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-8">Jawaban atas pertanyaan yang sering diajukan seputar sekolah dan pendaftaran siswa baru.</p>

                <div class="bg-primary rounded-3xl p-7 text-white relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-28 h-28 bg-white/5 rounded-full"></div>
                    <div class="absolute -right-4 top-4 w-16 h-16 bg-accent/10 rounded-full"></div>
                    <div class="w-11 h-11 bg-accent/20 rounded-xl flex items-center justify-center mb-5 border border-accent/30">
                        <span class="material-symbols-outlined text-accent text-xl" style="font-variation-settings:'FILL' 1">support_agent</span>
                    </div>
                    <h3 class="font-display font-black text-lg mb-2">Masih ada pertanyaan?</h3>
                    <p class="text-white/55 text-sm mb-5 leading-relaxed">Kunjungi kantor sekolah atau hubungi kami langsung hari ini.</p>
                    @if(!empty($settings['no_telp']) || ($profil?->kontak))
                        <a href="tel:{{ $settings['no_telp'] ?? $profil->kontak }}"
                           class="inline-flex items-center gap-2 bg-accent text-primary px-5 py-2.5 rounded-xl text-sm font-black hover:bg-accent/90 transition-all hover:scale-105">
                            <span class="material-symbols-outlined text-base">call</span>
                            {{ $settings['no_telp'] ?? $profil->kontak }}
                        </a>
                    @else
                        <a href="{{ route('profil') }}#kontak"
                           class="inline-flex items-center gap-2 bg-accent text-primary px-5 py-2.5 rounded-xl text-sm font-black hover:bg-accent/90 transition-all">
                            <span class="material-symbols-outlined text-base">location_on</span>
                            Lihat Lokasi
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right: Accordions --}}
            <div class="lg:col-span-3 space-y-3 reveal-right">
                @php $faqs = [
                    ['q'=>'Kapan pendaftaran siswa baru dibuka?',
                     'a'=>'Pendaftaran siswa baru dibuka setiap tahun sekitar bulan Februari–April. Pantau pengumuman resmi di website ini atau kunjungi kantor sekolah untuk informasi terkini.'],
                    ['q'=>'Apa saja dokumen pendaftaran yang diperlukan?',
                     'a'=>'Dokumen yang diperlukan: (1) Fotokopi Akta Kelahiran, (2) Fotokopi Kartu Keluarga, (3) Pas foto 3×4 sebanyak 3 lembar, dan (4) Formulir pendaftaran yang diisi lengkap.'],
                    ['q'=>'Berapa kuota penerimaan siswa baru?',
                     'a'=>'Kami menerima sekitar 120 siswa baru per tahun yang dibagi dalam beberapa rombongan belajar. Penerimaan dilakukan secara transparan berdasarkan usia dan ketersediaan tempat.'],
                    ['q'=>'Apakah ada biaya pendaftaran?',
                     'a'=>'Tidak ada biaya pendaftaran. Seluruh proses penerimaan siswa baru di SD Negeri Warialau dilaksanakan secara gratis sebagai sekolah negeri.'],
                    ['q'=>'Apa saja ekstrakurikuler yang tersedia?',
                     'a'=>'Kami menyediakan: Pramuka, Olahraga (bulu tangkis, futsal), Kesenian (tari, paduan suara), Literasi, Sains Club, Dokter Kecil, dan TIK.'],
                ]; @endphp

                @foreach($faqs as $i => $faq)
                <div class="faq-item bg-cream dark:bg-slate-900 border border-sand dark:border-slate-800 rounded-2xl overflow-hidden hover:border-secondary/40 transition-colors shadow-sm">
                    <button onclick="toggleFaq({{ $i }})"
                            class="w-full flex items-center justify-between px-6 py-4.5 text-left font-bold text-slate-800 dark:text-slate-200 hover:text-primary dark:hover:text-accent transition-colors text-[13.5px] gap-4 py-4">
                        <span>{{ $faq['q'] }}</span>
                        <span class="faq-chevron material-symbols-outlined text-slate-300 dark:text-slate-600 text-xl shrink-0 transition-transform duration-300 bg-white dark:bg-slate-800 rounded-full w-7 h-7 flex items-center justify-center">add</span>
                    </button>
                    <div id="faq-{{ $i }}" class="faq-body px-6">
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed pb-5">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CTA DUAL
══════════════════════════════════════════════ --}}
<section class="py-16 bg-cream dark:bg-background-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 reveal">
            <h2 class="font-display text-3xl font-black text-slate-900 dark:text-white">
                Apa yang <span class="text-gradient">Anda Cari?</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 stagger">
            <div class="reveal bg-primary rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden card-lift">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/5 rounded-full"></div>
                <div class="absolute -bottom-6 right-8 w-24 h-24 bg-accent/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 bg-accent/20 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5 border border-accent/30">
                        <span class="material-symbols-outlined text-accent text-xl sm:text-2xl" style="font-variation-settings:'FILL' 1">family_restroom</span>
                    </div>
                    <h3 class="font-display text-lg sm:text-xl font-black mb-1.5 sm:mb-2">Untuk Orang Tua</h3>
                    <p class="text-white/55 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Daftarkan putra-putri Anda dan pantau informasi terbaru dari sekolah kami.</p>
                    <a href="{{ route('pendaftaran') }}"
                       class="inline-flex items-center gap-1.5 bg-accent hover:bg-accent/90 text-primary px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl font-black text-xs sm:text-sm transition-all hover:scale-105">
                        Daftar Sekarang <span class="material-symbols-outlined text-sm sm:text-base">arrow_forward</span>
                    </a>
                </div>
            </div>

            <div class="reveal bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-sand dark:border-slate-800 relative overflow-hidden card-lift shadow-sm">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-primary/4 rounded-full"></div>
                <div class="relative z-10">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 bg-secondary/10 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5">
                        <span class="material-symbols-outlined text-secondary text-xl sm:text-2xl" style="font-variation-settings:'FILL' 1">school</span>
                    </div>
                    <h3 class="font-display text-lg sm:text-xl font-black text-slate-900 dark:text-white mb-1.5 sm:mb-2">Calon Siswa Baru</h3>
                    <p class="text-slate-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Kenali program unggulan, fasilitas lengkap, dan kegiatan seru di sekolah kami.</p>
                    <a href="{{ route('profil') }}"
                       class="inline-flex items-center gap-1.5 bg-primary hover:bg-primary/90 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl font-black text-xs sm:text-sm shadow-lg shadow-primary/25 transition-all hover:scale-105">
                        Kenali Kami <span class="material-symbols-outlined text-sm sm:text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     PENDAFTARAN AKTIF BANNER
══════════════════════════════════════════════ --}}
@if($pendaftaranAktif)
<section class="pb-16 px-4 sm:px-6 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto">
        <div class="bg-gradient-to-br from-primary via-primary to-secondary rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12 relative overflow-hidden reveal">
            <!-- Decorative elements -->
            <div class="absolute -top-12 -right-12 w-56 h-56 bg-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-accent/10 rounded-tr-full pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full"
                 style="background: radial-gradient(ellipse at 60% 50%, rgba(201,147,58,.08) 0%, transparent 70%); pointer-events:none;"></div>

            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-5 sm:gap-8">
                <div class="text-center sm:text-left">
                    <div class="inline-flex items-center gap-2 bg-accent/20 border border-accent/30 text-accent px-3 py-1 rounded-full text-[10px] sm:text-xs font-black mb-3 sm:mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent animate-ping inline-block"></span>
                        Pendaftaran Dibuka Sekarang
                    </div>
                    <h2 class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-white mb-2 leading-tight">
                        Siswa Baru TA {{ $pendaftaranAktif->tahun_ajaran }}
                    </h2>
                    <p class="text-white/55 text-xs sm:text-sm leading-relaxed max-w-sm">
                        Bergabung bersama keluarga besar {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}.
                        @if($pendaftaranAktif->kuota)
                            Kuota tersisa: <strong class="text-accent font-black">{{ $pendaftaranAktif->kuota }} siswa</strong>.
                        @endif
                    </p>
                </div>
                <a href="{{ route('pendaftaran') }}"
                   class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent/90 text-primary px-7 sm:px-9 py-3.5 sm:py-4 rounded-xl sm:rounded-2xl font-black transition-all shadow-2xl shadow-accent/30 hover:scale-105 active:scale-95 text-sm sm:text-base">
                    Daftar Sekarang
                    <span class="material-symbols-outlined text-lg sm:text-xl">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
(function(){
    // ── Banner slider ──
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.slider-dot');
    const total  = slides.length;
    if (total <= 1) return;

    let cur = 0, timer;

    function goTo(n) {
        slides[cur].classList.remove('active');
        if (dots[cur]) {
            dots[cur].classList.remove('w-6','sm:w-8','bg-accent');
            dots[cur].classList.add('w-2','sm:w-2.5','bg-white/40');
        }
        cur = (n + total) % total;
        slides[cur].classList.add('active');
        if (dots[cur]) {
            dots[cur].classList.add('w-6','sm:w-8','bg-accent');
            dots[cur].classList.remove('w-2','sm:w-2.5','bg-white/40');
        }
    }

    const reset = () => { clearInterval(timer); timer = setInterval(() => goTo(cur + 1), 5000); };

    document.getElementById('slider-next')?.addEventListener('click', () => { goTo(cur + 1); reset(); });
    document.getElementById('slider-prev')?.addEventListener('click', () => { goTo(cur - 1); reset(); });
    dots.forEach((d, i) => d.addEventListener('click', () => { goTo(i); reset(); }));
    reset();
})();

// ── FAQ accordion ──
function toggleFaq(i) {
    const body    = document.getElementById('faq-' + i);
    const chevron = body.closest('.faq-item').querySelector('.faq-chevron');
    const isOpen  = body.classList.contains('open');

    document.querySelectorAll('.faq-body').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.faq-chevron').forEach(c => {
        c.textContent = 'add';
        c.style.transform = '';
        c.style.color = '';
    });

    if (!isOpen) {
        body.classList.add('open');
        chevron.textContent = 'remove';
        chevron.style.transform = 'rotate(180deg)';
        chevron.style.color = '#0B7B8B';
    }
}
</script>
@endpush
