@extends('layouts.app')

@section('title', 'Galeri Kegiatan — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
/* ── Gallery items ── */
.galeri-item {
    opacity: 0; transform: scale(.93) translateY(12px);
    transition: opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1);
}
.galeri-item.visible { opacity: 1; transform: scale(1) translateY(0); }

.galeri-item .img-inner { transition: transform .5s cubic-bezier(.22,1,.36,1); }
.galeri-item:hover .img-inner { transform: scale(1.1); }
.galeri-item .overlay { opacity: 0; transition: opacity .3s ease; }
.galeri-item:hover .overlay { opacity: 1; }

/* ── Lightbox ── */
#lightbox { backdrop-filter: blur(12px); }
#lightbox-img { transition: opacity .25s ease; }
@keyframes lbIn {
    from { opacity:0; transform: scale(.9) translateY(20px); }
    to   { opacity:1; transform: scale(1) translateY(0); }
}
.lb-enter { animation: lbIn .35s cubic-bezier(.22,1,.36,1) both; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="relative bg-primary overflow-hidden py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/15 rounded-full blur-2xl"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-4 py-1.5 rounded-full text-xs font-bold mb-5 reveal">
            <span class="material-symbols-outlined text-sm text-accent" style="font-variation-settings:'FILL' 1">photo_library</span>
            Dokumentasi Kegiatan
        </div>
        <h1 class="font-display text-5xl md:text-6xl font-black text-white mb-4 leading-tight reveal" style="transition-delay:.1s">
            Galeri <span class="italic" style="color:#C9933A;">Kegiatan</span>
        </h1>
        <p class="text-white/55 max-w-xl mx-auto text-base leading-relaxed reveal" style="transition-delay:.2s">
            Momen-momen berharga dan dokumentasi kegiatan di {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 reveal" style="transition-delay:.28s">
            <a href="{{ route('home') }}" class="text-white/50 hover:text-white text-sm font-medium transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs text-white/30">chevron_right</span>
            <span class="text-accent text-sm font-bold">Galeri</span>
        </div>
    </div>
</section>

<div class="bg-cream dark:bg-background-dark overflow-hidden" style="margin-top:-2px;">
    <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" style="display:block; height:40px;">
        <path d="M0 0L48 6.7C96 13.3 192 26.7 288 30C384 33.3 480 26.7 576 21.7C672 16.7 768 13.3 864 16.7C960 20 1056 30 1152 31.7C1248 33.3 1344 26.7 1392 23.3L1440 20V40H0V0Z" fill="#0D2340"/>
    </svg>
</div>

{{-- Gallery --}}
<section class="py-16 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        @if($galeri->isNotEmpty())

        {{-- Count --}}
        <div class="flex items-center justify-between mb-8">
            <span class="section-eyebrow inline-flex">
                <span class="material-symbols-outlined text-sm">photo</span>
                {{ $galeri->total() }} Foto
            </span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galeri as $item)
            <div class="galeri-item relative group aspect-square rounded-2xl overflow-hidden shadow-sm cursor-pointer border border-sand dark:border-slate-800"
                 onclick="openLightbox('{{ asset('storage/' . $item->foto) }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->keterangan ?? '') }}')">
                <div class="img-inner absolute inset-0 bg-cover bg-center"
                     style="background-image: url('{{ asset('storage/' . $item->foto) }}');"></div>
                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent"></div>
                <!-- Hover overlay -->
                <div class="overlay absolute inset-0 bg-secondary/40 flex flex-col items-center justify-center gap-2 p-4">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                        <span class="material-symbols-outlined text-white text-xl">zoom_in</span>
                    </div>
                    <p class="text-white font-bold text-center text-xs line-clamp-2 leading-snug">{{ $item->judul }}</p>
                </div>
                <!-- Bottom label -->
                <div class="absolute bottom-0 inset-x-0 p-3 translate-y-1 group-hover:translate-y-0 transition-transform">
                    <p class="text-white font-bold text-xs line-clamp-1">{{ $item->judul }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($galeri->hasPages())
            <div class="mt-14 flex items-center justify-center gap-2">
                @if($galeri->onFirstPage())
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $galeri->previousPageUrl() }}"
                       class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-500 hover:bg-cream hover:border-secondary/40 transition-all">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </a>
                @endif

                @foreach($galeri->getUrlRange(1, $galeri->lastPage()) as $page => $url)
                    @if($page == $galeri->currentPage())
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white text-sm font-black shadow-md shadow-primary/25">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-500 dark:text-slate-400 text-sm font-bold hover:bg-cream hover:border-secondary/40 transition-all">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($galeri->hasMorePages())
                    <a href="{{ $galeri->nextPageUrl() }}"
                       class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-500 hover:bg-cream hover:border-secondary/40 transition-all">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </a>
                @else
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 text-slate-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </span>
                @endif
            </div>
        @endif

        @else
        <div class="text-center py-24 reveal">
            <div class="w-24 h-24 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-primary/30">photo_library</span>
            </div>
            <h3 class="font-display text-xl font-black text-slate-500 mb-2">Belum Ada Foto</h3>
            <p class="text-slate-400 text-sm">Galeri kegiatan akan segera ditambahkan oleh admin.</p>
        </div>
        @endif

    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox"
     class="fixed inset-0 z-50 bg-black/85 hidden items-center justify-center p-4"
     onclick="closeLightbox()">
    <div class="lb-enter relative max-w-4xl w-full mx-auto" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()"
                class="absolute -top-14 right-0 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors border border-white/20">
            <span class="material-symbols-outlined">close</span>
        </button>
        <div class="bg-primary/20 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
            <img id="lightbox-img" src="" alt=""
                 class="w-full max-h-[70vh] object-contain"/>
            <div class="px-6 py-4">
                <p id="lightbox-title" class="text-white font-display font-black text-lg"></p>
                <p id="lightbox-caption" class="text-white/50 text-sm mt-1"></p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function(){
    const items = document.querySelectorAll('.galeri-item');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), (parseInt(e.target.dataset.idx) || 0) % 8 * 70);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.04 });
    items.forEach((el, i) => { el.dataset.idx = i; obs.observe(el); });
})();

function openLightbox(src, title, caption) {
    const lb  = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    const inner = lb.querySelector('.lb-enter');

    img.src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-caption').textContent = caption;

    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Re-trigger animation
    inner.style.animation = 'none';
    void inner.offsetWidth;
    inner.style.animation = '';
}

function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endpush
