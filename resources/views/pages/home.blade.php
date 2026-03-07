@extends('layouts.app')

@section('title', ($profil->nama_sekolah ?? 'SD Negeri Warialau') . ' - Official Website')

@push('styles')
<style>
@keyframes fadeUp   { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
@keyframes float    { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
@keyframes shimmer  { 0%{background-position:-200% 0} 100%{background-position:200% 0} }

.reveal { opacity:0; transform:translateY(24px); transition:opacity .5s ease, transform .5s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }
.stagger > *:nth-child(1){transition-delay:.0s}
.stagger > *:nth-child(2){transition-delay:.1s}
.stagger > *:nth-child(3){transition-delay:.2s}
.stagger > *:nth-child(4){transition-delay:.3s}
.stagger > *:nth-child(5){transition-delay:.4s}
.stagger > *:nth-child(6){transition-delay:.5s}

.card-lift { transition:transform .25s ease, box-shadow .25s ease; }
.card-lift:hover { transform:translateY(-5px); box-shadow:0 16px 40px rgba(31,59,97,.13); }

.faq-body { max-height:0; overflow:hidden; transition:max-height .35s ease; }
.faq-body.open { max-height:300px; }

.blob { border-radius:60% 40% 30% 70%/60% 30% 70% 40%; }

/* Slider fade */
.slide { position:absolute; inset:0; opacity:0; z-index:0; transition:opacity .7s ease; }
.slide.active { opacity:1; z-index:10; }
</style>
@endpush

@section('content')

{{-- ════════════════════════════════════════
     HERO — BANNER SLIDER
════════════════════════════════════════ --}}
<section class="relative h-[580px] md:h-[640px] w-full overflow-hidden" id="hero">

    @if($banners->isNotEmpty())
        @foreach($banners as $i => $banner)
            <div class="slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
                <div class="absolute inset-0 bg-cover bg-center"
                     style="background-image:
                            linear-gradient(135deg, rgba(31,59,97,.82) 0%, rgba(20,24,30,.75) 100%),
                            url('{{ asset('storage/' . $banner->gambar) }}');"></div>
                <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
                    <div class="max-w-3xl mx-auto">
                        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 px-4 py-1.5 rounded-full text-xs font-semibold mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent inline-block"></span>
                            {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                        </div>
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight drop-shadow-lg">
                            {{ $banner->judul }}
                        </h1>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                            @if($pendaftaranAktif)
                                <a href="{{ route('pendaftaran') }}"
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent/90 text-primary px-8 py-3.5 rounded-xl font-bold text-sm transition-all hover:scale-105 shadow-lg shadow-accent/30">
                                    <span class="material-symbols-outlined text-base">how_to_reg</span>
                                    Daftar Sekarang
                                </a>
                            @endif
                            <a href="{{ route('profil') }}"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border-2 border-white/60 text-white hover:bg-white/10 px-8 py-3.5 rounded-xl font-bold text-sm backdrop-blur-sm transition-all hover:scale-105">
                                <span class="material-symbols-outlined text-base">info</span>
                                Profil Sekolah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Prev / Next --}}
        @if($banners->count() > 1)
            <button id="slider-prev"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 backdrop-blur-sm text-white flex items-center justify-center transition-all border border-white/20">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button id="slider-next"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 backdrop-blur-sm text-white flex items-center justify-center transition-all border border-white/20">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>

            {{-- Dots --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
                @foreach($banners as $i => $banner)
                    <button class="slider-dot transition-all rounded-full {{ $i === 0 ? 'w-7 h-2.5 bg-accent' : 'w-2.5 h-2.5 bg-white/40' }}"
                            data-index="{{ $i }}"></button>
                @endforeach
            </div>
        @endif

    @else
        {{-- Fallback static hero --}}
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image:
                    linear-gradient(135deg, rgba(31,59,97,.85) 0%, rgba(20,24,30,.78) 100%),
                    url('{{ !empty($settings['background']) ? asset('storage/'.$settings['background']) : '' }}');
                    background-color:#1f3b61;"></div>
        <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
            <div class="max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 px-4 py-1.5 rounded-full text-xs font-semibold mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                    Terakreditasi {{ $profil->akreditasi ?? 'B' }} · Berdiri {{ $profil->tahun_berdiri ?? '1980' }}
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-5 leading-tight">
                    Selamat Datang di<br/>
                    <span class="text-accent">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</span>
                </h1>
                <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">
                    @if($profil?->visi)
                        {{ \Illuminate\Support\Str::limit($profil->visi, 140) }}
                    @else
                        Mewujudkan generasi cerdas, berkarakter mulia, dan berakhlak tinggi.
                    @endif
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @if($pendaftaranAktif)
                        <a href="{{ route('pendaftaran') }}"
                           class="inline-flex items-center gap-2 bg-accent hover:bg-accent/90 text-primary px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg transition-all hover:scale-105">
                            Daftar Sekarang
                        </a>
                    @endif
                    <a href="{{ route('profil') }}"
                       class="inline-flex items-center gap-2 border-2 border-white/50 text-white hover:bg-white/10 px-8 py-3.5 rounded-xl font-bold text-sm backdrop-blur-sm transition-all hover:scale-105">
                        Profil Sekolah
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Floating stats (bawah kiri slider) --}}
    <div class="absolute bottom-6 left-6 z-30 hidden md:flex items-center gap-3">
        <div class="bg-white/15 backdrop-blur-md border border-white/20 rounded-2xl px-4 py-2.5 flex items-center gap-2.5">
            <span class="material-symbols-outlined text-accent text-lg" style="font-variation-settings:'FILL' 1">group</span>
            <div>
                <p class="text-white font-black text-sm leading-none">{{ $jumlahGuru }}</p>
                <p class="text-white/60 text-[10px] font-medium">Guru Aktif</p>
            </div>
        </div>
        <div class="bg-white/15 backdrop-blur-md border border-white/20 rounded-2xl px-4 py-2.5 flex items-center gap-2.5">
            <span class="material-symbols-outlined text-accent text-lg" style="font-variation-settings:'FILL' 1">groups_3</span>
            <div>
                <p class="text-white font-black text-sm leading-none">{{ $jumlahSiswa }}</p>
                <p class="text-white/60 text-[10px] font-medium">Siswa Aktif</p>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     STATS
════════════════════════════════════════ --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 reveal stagger">
            @php $statsData = [
                ['icon'=>'groups_3',      'val'=>$jumlahSiswa.'+', 'lbl'=>'Siswa Aktif',   'c'=>'bg-blue-50 text-blue-600'],
                ['icon'=>'group',         'val'=>$jumlahGuru.'+',  'lbl'=>'Guru & Staf',   'c'=>'bg-amber-50 text-amber-600'],
                ['icon'=>'event_available','val'=>($profil->tahun_berdiri??'1980'), 'lbl'=>'Tahun Berdiri','c'=>'bg-emerald-50 text-emerald-600'],
                ['icon'=>'emoji_events',  'val'=>'15+',            'lbl'=>'Prestasi',      'c'=>'bg-rose-50 text-rose-500'],
            ]; @endphp
            @foreach($statsData as $s)
                <div class="bg-white border border-slate-100 rounded-2xl p-5 flex items-center gap-4 shadow-sm card-lift reveal">
                    <div class="{{ $s['c'] }} w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings:'FILL' 1">{{ $s['icon'] }}</span>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-900 leading-none">{{ $s['val'] }}</p>
                        <p class="text-slate-400 text-xs font-medium mt-1">{{ $s['lbl'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     BERITA TERBARU
════════════════════════════════════════ --}}
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 reveal">
            <div>
                <span class="inline-flex items-center gap-1.5 bg-primary/8 text-primary text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                    <span class="material-symbols-outlined text-sm">newspaper</span> Terbaru
                </span>
                <h2 class="text-3xl font-black text-slate-900">Berita <span class="text-primary">&amp; Kegiatan</span></h2>
            </div>
            <a href="{{ route('berita') }}"
               class="mt-4 sm:mt-0 inline-flex items-center gap-1.5 text-sm font-bold text-primary border border-primary/20 hover:border-primary hover:bg-primary/5 px-4 py-2 rounded-xl transition-all">
                Lihat Semua <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        @if($beritaTerbaru->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger">
                @foreach($beritaTerbaru as $berita)
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm card-lift reveal group">
                        <a href="{{ route('berita.show', $berita->id) }}">
                            {{-- Thumbnail --}}
                            <div class="relative h-48 overflow-hidden">
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary/70 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white/25 text-7xl" style="font-variation-settings:'FILL' 1">article</span>
                                    </div>
                                @endif
                                @if($berita->kategori)
                                    <span class="absolute top-3 left-3 bg-accent text-primary text-[11px] font-black px-2.5 py-1 rounded-full">
                                        {{ $berita->kategori }}
                                    </span>
                                @endif
                            </div>
                        </a>
                        <div class="p-5">
                            <h3 class="font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-primary transition-colors leading-snug">
                                <a href="{{ route('berita.show', $berita->id) }}">{{ $berita->judul }}</a>
                            </h3>
                            <p class="text-slate-400 text-sm line-clamp-2 mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-1.5 text-slate-400 text-xs">
                                    <span class="material-symbols-outlined text-xs">calendar_today</span>
                                    {{ ($berita->tanggal_publish
                                        ? \Carbon\Carbon::parse($berita->tanggal_publish)
                                        : $berita->created_at)->translatedFormat('d M Y') }}
                                </div>
                                <a href="{{ route('berita.show', $berita->id) }}"
                                   class="text-primary text-xs font-bold flex items-center gap-1 hover:gap-2 transition-all">
                                    Baca <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-slate-400 reveal">
                <span class="material-symbols-outlined text-6xl mb-3 block">newspaper</span>
                <p>Belum ada berita.</p>
            </div>
        @endif
    </div>
</section>

{{-- ════════════════════════════════════════
     KATEGORI BERITA
════════════════════════════════════════ --}}
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10 reveal">
            <span class="inline-flex items-center gap-1.5 bg-primary/8 text-primary text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                <span class="material-symbols-outlined text-sm">category</span> Kategori
            </span>
            <h2 class="text-3xl font-black text-slate-900">Jelajahi Informasi <span class="text-primary">Berdasarkan Kategori</span></h2>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-6 gap-4 stagger">
            @php $cats = [
                ['lbl'=>'Akademik',        'icon'=>'menu_book',      'from'=>'from-blue-500',    'to'=>'to-blue-600'],
                ['lbl'=>'Prestasi',        'icon'=>'emoji_events',   'from'=>'from-amber-400',   'to'=>'to-amber-500'],
                ['lbl'=>'Kegiatan',        'icon'=>'event',          'from'=>'from-emerald-500', 'to'=>'to-emerald-600'],
                ['lbl'=>'Pengumuman',      'icon'=>'campaign',       'from'=>'from-violet-500',  'to'=>'to-violet-600'],
                ['lbl'=>'Ekstrakurikuler', 'icon'=>'sports_soccer',  'from'=>'from-rose-500',    'to'=>'to-pink-600'],
                ['lbl'=>'Berita',          'icon'=>'newspaper',      'from'=>'from-primary',     'to'=>'to-blue-800'],
            ]; @endphp
            @foreach($cats as $cat)
                <a href="{{ route('berita', ['kategori'=>$cat['lbl']]) }}"
                   class="group flex flex-col items-center gap-3 bg-slate-50 hover:bg-white border border-slate-100 hover:border-primary/20 rounded-2xl p-4 card-lift reveal transition-colors">
                    <div class="w-11 h-11 bg-gradient-to-br {{ $cat['from'] }} {{ $cat['to'] }} rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-white text-lg" style="font-variation-settings:'FILL' 1">{{ $cat['icon'] }}</span>
                    </div>
                    <p class="text-[11px] font-bold text-slate-600 group-hover:text-primary text-center transition-colors">{{ $cat['lbl'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     TENTANG SEKOLAH
════════════════════════════════════════ --}}
<section class="py-20 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Left: Dekoratif --}}
            <div class="relative reveal">
                {{-- Background blob --}}
                <div class="absolute -inset-4 bg-primary/4 blob rounded-3xl pointer-events-none"></div>

                <div class="relative grid grid-cols-2 gap-4">
                    {{-- Stat card besar --}}
                    <div class="col-span-2 bg-primary rounded-3xl p-8 text-white flex items-center gap-6 shadow-xl shadow-primary/20">
                        <div class="w-16 h-16 bg-accent rounded-2xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1">school</span>
                        </div>
                        <div>
                            <p class="text-4xl font-black text-accent leading-none">{{ date('Y') - ($profil->tahun_berdiri ?? 1980) }}</p>
                            <p class="text-white/70 text-sm font-medium mt-1">Tahun Mengabdi untuk Pendidikan</p>
                            <p class="text-white/50 text-xs mt-0.5">Sejak tahun {{ $profil->tahun_berdiri ?? '1980' }}</p>
                        </div>
                    </div>

                    {{-- Akreditasi --}}
                    <div class="bg-accent rounded-2xl p-6 text-primary shadow-lg shadow-accent/20 flex flex-col items-center justify-center text-center">
                        <span class="material-symbols-outlined text-3xl mb-1" style="font-variation-settings:'FILL' 1">verified</span>
                        <p class="text-xs font-bold opacity-70">Akreditasi</p>
                        <p class="text-5xl font-black leading-none">{{ $profil->akreditasi ?? 'B' }}</p>
                    </div>

                    {{-- Siswa --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
                        <span class="material-symbols-outlined text-primary text-3xl mb-1" style="font-variation-settings:'FILL' 1">groups_3</span>
                        <p class="text-3xl font-black text-slate-900 leading-none">{{ $jumlahSiswa }}+</p>
                        <p class="text-xs text-slate-400 font-medium mt-1">Siswa Aktif</p>
                    </div>
                </div>
            </div>

            {{-- Right: Teks --}}
            <div class="reveal">
                <span class="inline-flex items-center gap-1.5 bg-primary/8 text-primary text-xs font-bold px-3 py-1.5 rounded-full mb-4">
                    <span class="material-symbols-outlined text-sm">info</span> Tentang Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-5 leading-tight">
                    Membangun Generasi <span class="text-primary">Cerdas &amp; Berkarakter</span>
                </h2>
                <p class="text-slate-500 leading-relaxed mb-6 text-sm">
                    @if($profil?->sejarah)
                        {{ \Illuminate\Support\Str::limit($profil->sejarah, 300) }}
                    @else
                        SD Negeri Warialau berdiri sejak tahun {{ $profil->tahun_berdiri ?? '1980' }} dan telah menjadi pusat pendidikan berkualitas di Kepulauan Aru. Dengan tenaga pendidik berpengalaman dan fasilitas yang memadai, kami berkomitmen mencetak generasi penerus bangsa yang cerdas, berkarakter, dan siap menghadapi tantangan masa depan.
                    @endif
                </p>

                <div class="space-y-3 mb-8">
                    @foreach([
                        'Pembelajaran aktif, inovatif, dan menyenangkan',
                        'Tenaga pendidik berpengalaman & bersertifikat',
                        'Program ekstrakurikuler beragam & berkualitas',
                        'Lingkungan belajar yang aman & kondusif',
                    ] as $f)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-white" style="font-size:13px">check</span>
                            </div>
                            <p class="text-sm text-slate-600">{{ $f }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profil') }}"
                       class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all hover:scale-105">
                        Selengkapnya <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                    <a href="{{ route('guru') }}"
                       class="inline-flex items-center gap-2 border-2 border-slate-200 hover:border-primary text-slate-600 hover:text-primary px-6 py-3 rounded-xl font-bold text-sm transition-all">
                        Lihat Guru
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     GALERI
════════════════════════════════════════ --}}
@if($galeri->isNotEmpty())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 reveal">
            <div>
                <span class="inline-flex items-center gap-1.5 bg-primary/8 text-primary text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                    <span class="material-symbols-outlined text-sm">photo_library</span> Galeri
                </span>
                <h2 class="text-3xl font-black text-slate-900">Momen <span class="text-primary">Berharga</span></h2>
                <p class="text-slate-400 text-sm mt-1">Dokumentasi kegiatan dan aktivitas sekolah</p>
            </div>
            <a href="{{ route('galeri') }}"
               class="mt-4 sm:mt-0 inline-flex items-center gap-1.5 text-sm font-bold text-primary border border-primary/20 hover:border-primary hover:bg-primary/5 px-4 py-2 rounded-xl transition-all">
                Semua Foto <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 stagger">
            @foreach($galeri->take(8) as $idx => $item)
                <a href="{{ route('galeri') }}"
                   class="group relative rounded-2xl overflow-hidden shadow-sm card-lift reveal
                          {{ $idx === 0 ? 'md:col-span-2 md:row-span-2' : '' }}
                          {{ $idx === 0 ? 'aspect-square' : 'aspect-square' }}">
                    <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-500 bg-slate-200"
                         style="background-image:url('{{ asset('storage/'.$item->foto) }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                        <p class="text-white text-xs font-semibold line-clamp-2">{{ $item->judul }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════
     FAQ
════════════════════════════════════════ --}}
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-14 items-start">

            {{-- Left 2/5 --}}
            <div class="lg:col-span-2 reveal">
                <span class="inline-flex items-center gap-1.5 bg-primary/8 text-primary text-xs font-bold px-3 py-1.5 rounded-full mb-4">
                    <span class="material-symbols-outlined text-sm">help</span> FAQ
                </span>
                <h2 class="text-3xl font-black text-slate-900 mb-3">Pertanyaan <span class="text-primary">Umum</span></h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-8">Jawaban atas pertanyaan yang sering diajukan seputar sekolah dan pendaftaran.</p>

                <div class="bg-primary rounded-2xl p-6 text-white">
                    <div class="w-10 h-10 bg-accent rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings:'FILL' 1">support_agent</span>
                    </div>
                    <h3 class="font-black text-lg mb-1">Masih ada pertanyaan?</h3>
                    <p class="text-white/60 text-sm mb-4">Kunjungi sekolah atau hubungi kami langsung.</p>
                    @if(!empty($settings['no_telp']) || ($profil?->kontak))
                        <a href="tel:{{ $settings['no_telp'] ?? $profil->kontak }}"
                           class="inline-flex items-center gap-2 bg-accent text-primary px-4 py-2 rounded-xl text-sm font-bold hover:bg-accent/90 transition-all">
                            <span class="material-symbols-outlined text-base">call</span>
                            {{ $settings['no_telp'] ?? $profil->kontak }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right 3/5 --}}
            <div class="lg:col-span-3 space-y-3 reveal">
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
                     'a'=>'Kami menyediakan: Pramuka, Olahraga (bulu tangkis, futsal), Kesenian (tari, paduan suara), Literasi, Sains Club, Dokter Kecil, dan TIK. Siswa bebas memilih sesuai minat.'],
                ]; @endphp

                @foreach($faqs as $i => $faq)
                    <div class="faq-item bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <button onclick="toggleFaq({{ $i }})"
                                class="w-full flex items-center justify-between px-5 py-4 text-left font-semibold text-slate-800 hover:text-primary transition-colors text-sm gap-4">
                            <span>{{ $faq['q'] }}</span>
                            <span class="faq-chevron material-symbols-outlined text-slate-300 text-xl shrink-0 transition-transform duration-300">add</span>
                        </button>
                        <div id="faq-{{ $i }}" class="faq-body px-5">
                            <p class="text-sm text-slate-500 leading-relaxed pb-4">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     CTA DUAL
════════════════════════════════════════ --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-10 reveal">
            <h2 class="text-3xl font-black text-slate-900">Apa yang <span class="text-primary">Anda Cari?</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 reveal stagger">
            <div class="bg-primary rounded-3xl p-8 text-white relative overflow-hidden card-lift">
                <div class="absolute -top-10 -right-10 w-36 h-36 bg-white/5 rounded-full"></div>
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">family_restroom</span>
                </div>
                <h3 class="text-xl font-black mb-2">Untuk Orang Tua</h3>
                <p class="text-white/60 text-sm mb-6">Daftarkan putra-putri Anda dan pantau informasi terbaru sekolah.</p>
                <a href="{{ route('pendaftaran') }}"
                   class="inline-flex items-center gap-2 bg-accent hover:bg-accent/90 text-primary px-6 py-3 rounded-xl font-bold text-sm transition-all hover:scale-105">
                    Daftar Sekarang <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>

            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 relative overflow-hidden card-lift">
                <div class="absolute -top-10 -right-10 w-36 h-36 bg-primary/4 rounded-full"></div>
                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">school</span>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-2">Calon Siswa Baru</h3>
                <p class="text-slate-400 text-sm mb-6">Kenali program unggulan, fasilitas, dan kegiatan di sekolah kami.</p>
                <a href="{{ route('profil') }}"
                   class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all hover:scale-105">
                    Kenali Kami <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     PENDAFTARAN AKTIF BANNER
════════════════════════════════════════ --}}
@if($pendaftaranAktif)
<section class="pb-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-gradient-to-r from-primary to-primary/85 rounded-3xl p-8 md:p-12 relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 w-72 h-72 bg-accent/10 blob pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 bg-accent/20 border border-accent/30 text-accent px-3 py-1 rounded-full text-xs font-bold mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent animate-ping inline-block"></span>
                        Pendaftaran Dibuka
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-white mb-2">
                        Siswa Baru TA {{ $pendaftaranAktif->tahun_ajaran }}
                    </h2>
                    <p class="text-white/60 text-sm">
                        Bergabung bersama keluarga besar {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}.
                        @if($pendaftaranAktif->kuota)
                            Kuota tersisa: <strong class="text-accent">{{ $pendaftaranAktif->kuota }} siswa</strong>.
                        @endif
                    </p>
                </div>
                <a href="{{ route('pendaftaran') }}"
                   class="shrink-0 inline-flex items-center gap-2 bg-accent hover:bg-accent/90 text-primary px-8 py-4 rounded-2xl font-black transition-all shadow-xl hover:scale-105">
                    Daftar Sekarang
                    <span class="material-symbols-outlined">arrow_forward</span>
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
    // ── Scroll reveal ──
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

    // ── Banner slider ──
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.slider-dot');
    const total  = slides.length;
    if(total <= 1) return;

    let cur = 0, timer;

    function goTo(n){
        slides[cur].classList.remove('active');
        dots[cur].classList.remove('w-7','bg-accent');
        dots[cur].classList.add('w-2.5','bg-white/40');

        cur = (n + total) % total;

        slides[cur].classList.add('active');
        dots[cur].classList.add('w-7','bg-accent');
        dots[cur].classList.remove('w-2.5','bg-white/40');
    }

    function next(){ goTo(cur+1); }
    function reset(){ clearInterval(timer); timer = setInterval(next, 5000); }

    document.getElementById('slider-next')?.addEventListener('click', ()=>{ next(); reset(); });
    document.getElementById('slider-prev')?.addEventListener('click', ()=>{ goTo(cur-1); reset(); });
    dots.forEach((d,i) => d.addEventListener('click', ()=>{ goTo(i); reset(); }));

    timer = setInterval(next, 5000);
})();

// ── FAQ accordion ──
function toggleFaq(i){
    const body    = document.getElementById('faq-'+i);
    const chevron = body.closest('.faq-item').querySelector('.faq-chevron');
    const isOpen  = body.classList.contains('open');

    document.querySelectorAll('.faq-body').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.faq-chevron').forEach(c => { c.textContent='add'; c.style.transform=''; });

    if(!isOpen){
        body.classList.add('open');
        chevron.textContent = 'remove';
        chevron.style.transform = 'rotate(45deg)';
    }
}
</script>
@endpush
