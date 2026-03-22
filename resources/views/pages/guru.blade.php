@extends('layouts.app')

@section('title', 'Daftar Guru — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
/* ── Guru card ── */
.guru-card {
    transition: transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s ease;
    position: relative;
}
.guru-card::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: 1.25rem;
    background: linear-gradient(135deg, rgba(11,123,139,.06) 0%, rgba(13,35,64,.04) 100%);
    opacity: 0;
    transition: opacity .35s ease;
}
.guru-card:hover { transform: translateY(-10px); box-shadow: 0 28px 64px rgba(13,35,64,.14); }
.guru-card:hover::before { opacity: 1; }
.guru-card:hover .avatar-wrap { transform: scale(1.08); }
.guru-card:hover .avatar-ring { border-color: #C9933A; transform: scale(1.1); }
.guru-card:hover .contact-btn { opacity: 1; transform: translateY(0); }

.avatar-wrap {
    transition: transform .4s cubic-bezier(.22,1,.36,1);
}
.avatar-ring {
    position: absolute; inset: -6px;
    border: 2px solid rgba(13,35,64,.12);
    border-radius: 9999px;
    transition: border-color .35s ease, transform .35s cubic-bezier(.22,1,.36,1);
}
.contact-btn {
    opacity: 0;
    transform: translateY(6px);
    transition: opacity .3s ease, transform .3s cubic-bezier(.22,1,.36,1);
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="relative bg-primary overflow-hidden py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/15 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent/10 rounded-full blur-2xl -translate-x-1/3 translate-y-1/3"></div>
        <!-- Grid dots -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/85 px-4 py-1.5 rounded-full text-xs font-bold mb-5 reveal">
            <span class="material-symbols-outlined text-sm text-accent" style="font-variation-settings:'FILL' 1">school</span>
            Tenaga Pendidik
        </div>
        <h1 class="font-display text-5xl md:text-6xl font-black text-white mb-4 leading-tight reveal" style="transition-delay:.1s">
            Guru &<br/>
            <span class="italic" style="color:#C9933A;">Tenaga Pengajar</span>
        </h1>
        <p class="text-white/55 max-w-xl mx-auto text-base leading-relaxed reveal" style="transition-delay:.2s">
            Para pendidik profesional kami yang berdedikasi tinggi dalam mencerdaskan generasi bangsa di Kepulauan Aru.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 reveal" style="transition-delay:.28s">
            <a href="{{ route('home') }}" class="text-white/50 hover:text-white text-sm font-medium transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs text-white/30">chevron_right</span>
            <span class="text-accent text-sm font-bold">Guru</span>
        </div>
    </div>
</section>

{{-- Wave divider --}}
<div class="bg-cream dark:bg-background-dark overflow-hidden" style="margin-top:-2px;">
    <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" style="display:block; height:40px;">
        <path d="M0 0L48 6.7C96 13.3 192 26.7 288 30C384 33.3 480 26.7 576 21.7C672 16.7 768 13.3 864 16.7C960 20 1056 30 1152 31.7C1248 33.3 1344 26.7 1392 23.3L1440 20V40H0V0Z" fill="#0D2340"/>
    </svg>
</div>

{{-- Grid --}}
<section class="py-16 bg-cream dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        @if($gurus->isEmpty())
        <div class="text-center py-24 reveal">
            <div class="w-24 h-24 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-primary/40">group_off</span>
            </div>
            <h3 class="font-display text-xl font-black text-slate-500 mb-2">Belum Ada Data Guru</h3>
            <p class="text-slate-400 text-sm">Data guru akan segera ditambahkan oleh admin.</p>
        </div>
        @else

        {{-- Count badge --}}
        <div class="flex items-center justify-between mb-10 reveal">
            <div>
                <span class="section-eyebrow inline-flex">
                    <span class="material-symbols-outlined text-sm">groups_3</span>
                    Tenaga Pendidik
                </span>
                <p class="text-slate-400 text-sm mt-1.5">{{ $gurus->count() }} guru dan staf pengajar aktif</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 stagger">
            @foreach($gurus as $guru)
            <div class="guru-card bg-white dark:bg-slate-900 rounded-[1.25rem] border border-sand dark:border-slate-800 p-7 flex flex-col items-center text-center reveal shadow-sm">

                {{-- Avatar --}}
                <div class="relative mb-6 mt-1">
                    <div class="avatar-ring"></div>
                    <div class="avatar-wrap relative w-28 h-28 rounded-full overflow-hidden shadow-xl">
                        @if($guru->foto)
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}"
                                 class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/15 via-secondary/10 to-primary/20 flex items-center justify-center">
                                <span class="font-display text-4xl font-black text-primary/40">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    {{-- Status dot --}}
                    <div class="absolute bottom-0 right-0 w-5 h-5 rounded-full border-2 border-white dark:border-slate-900 {{ $guru->status === 'aktif' ? 'bg-emerald-400' : 'bg-slate-300' }}"></div>
                </div>

                {{-- Info --}}
                <h3 class="font-display font-black text-slate-900 dark:text-white text-base leading-tight mb-1.5">{{ $guru->nama }}</h3>

                @if($guru->jabatan)
                    <span class="text-secondary dark:text-accent text-xs font-black uppercase tracking-wider mb-3 block">{{ $guru->jabatan }}</span>
                @endif

                @if($guru->mata_pelajaran)
                    <div class="inline-flex items-center gap-1.5 bg-primary/7 dark:bg-primary/20 text-primary dark:text-accent px-3 py-1.5 rounded-full text-xs font-bold mb-3">
                        <span class="material-symbols-outlined text-sm">menu_book</span>
                        {{ $guru->mata_pelajaran }}
                    </div>
                @endif

                @if($guru->nip)
                    <p class="text-slate-400 text-[11px] font-medium mb-2">NIP: {{ $guru->nip }}</p>
                @endif

                @if($guru->no_hp)
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$guru->no_hp) }}" target="_blank"
                       class="contact-btn mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 px-4 py-2 rounded-full transition-colors border border-emerald-200/60 dark:border-emerald-800/40">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        WhatsApp
                    </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection
