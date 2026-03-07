@extends('layouts.app')

@section('title', ($profil->nama_sekolah ?? 'SD Negeri Warialau') . ' - Official Website')

@section('content')

{{-- Hero / Banner Slider --}}
<section class="relative h-[600px] w-full overflow-hidden" id="hero-slider">

    @if($banners->isNotEmpty())
        {{-- Slides dari database --}}
        @foreach($banners as $i => $banner)
            <div class="slider-slide absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                <div class="absolute inset-0 bg-cover bg-center"
                     style="background-image: linear-gradient(rgba(31,59,97,0.70), rgba(20,24,30,0.82)),
                            url('{{ asset('storage/' . $banner->gambar) }}');"></div>
                <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-lg">
                            {{ $banner->judul }}
                        </h1>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                            @if($pendaftaranAktif)
                                <a href="{{ route('pendaftaran') }}"
                                   class="w-full sm:w-auto bg-accent hover:bg-accent/90 text-primary px-8 py-4 rounded-xl font-bold text-lg transition-transform hover:scale-105">
                                    Lihat Info Pendaftaran
                                </a>
                            @endif
                            <a href="{{ route('profil') }}"
                               class="w-full sm:w-auto border-2 border-white text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg backdrop-blur-sm transition-transform hover:scale-105">
                                Profil Sekolah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Tombol Prev / Next --}}
        @if($banners->count() > 1)
            <button id="slider-prev"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white flex items-center justify-center transition-all">
                <span class="material-symbols-outlined text-2xl">chevron_left</span>
            </button>
            <button id="slider-next"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white flex items-center justify-center transition-all">
                <span class="material-symbols-outlined text-2xl">chevron_right</span>
            </button>

            {{-- Dots Indicator --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
                @foreach($banners as $i => $banner)
                    <button class="slider-dot w-2.5 h-2.5 rounded-full transition-all {{ $i === 0 ? 'bg-accent w-7' : 'bg-white/50' }}"
                            data-index="{{ $i }}"></button>
                @endforeach
            </div>
        @endif

    @else
        {{-- Fallback jika tidak ada banner --}}
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image: linear-gradient(rgba(31,59,97,0.75), rgba(20,24,30,0.85)),
                    url('{{ !empty($settings['background']) ? asset('storage/' . $settings['background']) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1600' }}');"></div>
        <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                    Selamat Datang di <br/>
                    <span class="text-accent">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl mx-auto">
                    @if($profil && $profil->visi)
                        {{ Str::limit($profil->visi, 160) }}
                    @else
                        Mewujudkan Generasi Cerdas, Berkarakter, dan Berakhlak Mulia Melalui Pendidikan Berkualitas.
                    @endif
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @if($pendaftaranAktif)
                        <a href="{{ route('pendaftaran') }}"
                           class="w-full sm:w-auto bg-accent hover:bg-accent/90 text-primary px-8 py-4 rounded-xl font-bold text-lg transition-transform hover:scale-105">
                            Lihat Info Pendaftaran
                        </a>
                    @endif
                    <a href="{{ route('profil') }}"
                       class="w-full sm:w-auto border-2 border-white text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg backdrop-blur-sm transition-transform hover:scale-105">
                        Profil Sekolah
                    </a>
                </div>
            </div>
        </div>
    @endif

</section>

@push('scripts')
<script>
(function () {
    const slides = document.querySelectorAll('.slider-slide');
    const dots   = document.querySelectorAll('.slider-dot');
    const total  = slides.length;
    if (total <= 1) return;

    let current = 0;
    let timer;

    function goTo(index) {
        slides[current].classList.replace('opacity-100', 'opacity-0');
        slides[current].classList.replace('z-10', 'z-0');
        dots[current].classList.remove('bg-accent', 'w-7');
        dots[current].classList.add('bg-white/50');

        current = (index + total) % total;

        slides[current].classList.replace('opacity-0', 'opacity-100');
        slides[current].classList.replace('z-0', 'z-10');
        dots[current].classList.add('bg-accent', 'w-7');
        dots[current].classList.remove('bg-white/50');
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() {
        timer = setInterval(next, 5000);
    }
    function resetAuto() {
        clearInterval(timer);
        startAuto();
    }

    document.getElementById('slider-next')?.addEventListener('click', () => { next(); resetAuto(); });
    document.getElementById('slider-prev')?.addEventListener('click', () => { prev(); resetAuto(); });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => { goTo(i); resetAuto(); });
    });

    startAuto();
})();
</script>
@endpush

{{-- Statistik Section --}}
<section class="py-16 bg-white dark:bg-background-dark/50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-background-light dark:bg-slate-800/50 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center group hover:border-primary transition-colors">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">group</span>
                <p class="text-4xl font-black text-primary dark:text-slate-100 mb-2">{{ $jumlahGuru }}</p>
                <p class="text-slate-600 dark:text-slate-400 font-medium uppercase tracking-widest text-sm">Jumlah Guru</p>
            </div>
            <div class="bg-background-light dark:bg-slate-800/50 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center group hover:border-primary transition-colors">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">groups_3</span>
                <p class="text-4xl font-black text-primary dark:text-slate-100 mb-2">{{ $jumlahSiswa }}</p>
                <p class="text-slate-600 dark:text-slate-400 font-medium uppercase tracking-widest text-sm">Jumlah Siswa</p>
            </div>
            <div class="bg-background-light dark:bg-slate-800/50 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center group hover:border-primary transition-colors">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">event_available</span>
                <p class="text-4xl font-black text-primary dark:text-slate-100 mb-2">
                    {{ $profil->tahun_berdiri ?? '-' }}
                </p>
                <p class="text-slate-600 dark:text-slate-400 font-medium uppercase tracking-widest text-sm">Tahun Berdiri</p>
            </div>
        </div>
    </div>
</section>

{{-- Berita Terbaru Section --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Berita &amp; Kegiatan</h2>
                <div class="w-20 h-1.5 bg-accent rounded-full"></div>
            </div>
            <a class="text-primary font-bold hover:underline flex items-center gap-2" href="{{ route('berita') }}">
                Lihat Semua Berita <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        @if($beritaTerbaru->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($beritaTerbaru as $berita)
                    <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-slate-100 dark:border-slate-700">
                        <a href="{{ route('berita.show', $berita->id) }}">
                            @if($berita->gambar)
                                <div class="h-52 bg-cover bg-center"
                                     style="background-image: url('{{ asset('storage/' . $berita->gambar) }}');"></div>
                            @else
                                <div class="h-52 bg-gradient-to-br from-primary to-primary/60 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-5xl">article</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-6">
                            @if($berita->kategori)
                                <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full mb-3">
                                    {{ $berita->kategori }}
                                </span>
                            @endif
                            <h3 class="text-xl font-bold mb-3 line-clamp-2">
                                <a href="{{ route('berita.show', $berita->id) }}" class="hover:text-primary transition-colors">
                                    {{ $berita->judul }}
                                </a>
                            </h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($berita->isi), 150) }}
                            </p>
                            <div class="flex items-center text-slate-400 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm mr-1">calendar_today</span>
                                {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-slate-400">
                <span class="material-symbols-outlined text-6xl mb-4 block">newspaper</span>
                <p class="text-lg">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>

{{-- Galeri Kegiatan --}}
@if($galeri->isNotEmpty())
<section class="py-20 bg-background-light dark:bg-background-dark/30">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Galeri Kegiatan Sekolah</h2>
            <p class="text-slate-600 dark:text-slate-400">Momen berharga aktivitas harian dan acara khusus di {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galeri as $item)
                <div class="relative group aspect-square rounded-xl overflow-hidden shadow-lg">
                    <div class="absolute inset-0 bg-cover bg-center"
                         style="background-image: url('{{ asset('storage/' . $item->foto) }}');"></div>
                    <div class="absolute inset-0 bg-primary/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-4">
                        <p class="text-white font-bold text-center">{{ $item->judul }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('galeri') }}"
               class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-colors">
                Lihat Semua Galeri <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
@endif

{{-- Pendaftaran Banner --}}
@if($pendaftaranAktif)
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto bg-accent rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-accent/20">
        <div class="text-primary text-center md:text-left">
            <h2 class="text-2xl md:text-4xl font-black mb-4">
                Pendaftaran Siswa Baru <br/>Tahun Ajaran {{ $pendaftaranAktif->tahun_ajaran }} Sedang Dibuka!
            </h2>
            <p class="text-primary/80 font-medium">
                Jangan lewatkan kesempatan menjadi bagian dari keluarga besar {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}.
                @if($pendaftaranAktif->kuota)
                    Sisa kuota: <strong>{{ $pendaftaranAktif->kuota }} siswa</strong>.
                @endif
            </p>
        </div>
        <a href="{{ route('pendaftaran') }}"
           class="bg-primary text-white hover:bg-primary/90 px-10 py-5 rounded-2xl font-black text-xl transition-all shadow-xl whitespace-nowrap">
            Daftar Sekarang
        </a>
    </div>
</section>
@endif

@endsection
