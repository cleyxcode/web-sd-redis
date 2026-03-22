<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SD Negeri Warialau - Official Website')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;0,9..144,900;1,9..144,300;1,9..144,700&family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary":   "#0D2340",
                        "secondary": "#0B7B8B",
                        "accent":    "#C9933A",
                        "cream":     "#FAF8F4",
                        "sand":      "#F0EBE0",
                        "background-light": "#FAF8F4",
                        "background-dark":  "#070F1C",
                    },
                    fontFamily: {
                        "display": ['"Fraunces"', "Georgia", "serif"],
                        "body":    ['"Nunito"', "system-ui", "sans-serif"],
                    },
                },
            },
        }
    </script>

    <style>
/* ── Reset & Base ── */
*, *::before, *::after { box-sizing: border-box; }
body { font-family: "Nunito", system-ui, sans-serif; }
.font-display { font-family: "Fraunces", Georgia, serif; }

/* ── Custom scrollbar ── */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #C9933A; border-radius: 9999px; }

/* ── CSS Variables ── */
:root {
    --navy:  #0D2340;
    --gold:  #C9933A;
    --teal:  #0B7B8B;
    --cream: #FAF8F4;
}

/* ── Scroll progress bar ── */
#scroll-progress {
    position: fixed; top: 0; left: 0; height: 3px; z-index: 9999;
    background: linear-gradient(90deg, var(--teal), var(--gold));
    width: 0%; transition: width 0.1s linear;
    border-radius: 0 2px 2px 0;
}

/* ── Page entrance ── */
@keyframes pageIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
main { animation: pageIn .5s cubic-bezier(.22,1,.36,1) both; }

/* ── Reveal animations ── */
.reveal {
    opacity: 0; transform: translateY(32px);
    transition: opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1);
}
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-left {
    opacity: 0; transform: translateX(-40px);
    transition: opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1);
}
.reveal-left.visible { opacity: 1; transform: translateX(0); }
.reveal-right {
    opacity: 0; transform: translateX(40px);
    transition: opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1);
}
.reveal-right.visible { opacity: 1; transform: translateX(0); }
.reveal-scale {
    opacity: 0; transform: scale(.88);
    transition: opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1);
}
.reveal-scale.visible { opacity: 1; transform: scale(1); }

/* ── Stagger delays ── */
.stagger > *:nth-child(1){transition-delay:.04s}
.stagger > *:nth-child(2){transition-delay:.10s}
.stagger > *:nth-child(3){transition-delay:.16s}
.stagger > *:nth-child(4){transition-delay:.22s}
.stagger > *:nth-child(5){transition-delay:.28s}
.stagger > *:nth-child(6){transition-delay:.34s}
.stagger > *:nth-child(7){transition-delay:.40s}
.stagger > *:nth-child(8){transition-delay:.46s}

/* ── Card hover ── */
.card-lift {
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
    will-change: transform;
}
.card-lift:hover {
    transform: translateY(-7px) scale(1.015);
    box-shadow: 0 24px 60px rgba(13,35,64,.12), 0 8px 24px rgba(13,35,64,.08);
}

/* ── Navigation ── */
.nav-link {
    position: relative; font-weight: 700; font-size: .825rem;
    color: #64748b; padding: .4rem .85rem; border-radius: 8px;
    transition: color .2s ease, background .2s ease;
    letter-spacing: .01em;
}
.nav-link:hover { color: var(--navy); background: rgba(13,35,64,.06); }
.nav-link.active { color: var(--navy); }
.nav-link.active::after {
    content: ''; position: absolute; bottom: 2px; left: 50%;
    transform: translateX(-50%);
    width: 18px; height: 3px; border-radius: 9999px;
    background: var(--gold);
}

/* Header scroll state */
.header-scrolled {
    background: rgba(250,248,244,.97) !important;
    backdrop-filter: blur(20px);
    box-shadow: 0 1px 30px rgba(13,35,64,.08);
}

/* ── Dropdown ── */
#user-dropdown-menu {
    transform-origin: top right;
    transform: scale(.92) translateY(-8px);
    opacity: 0;
    transition: opacity .2s ease, transform .2s cubic-bezier(.22,1,.36,1);
    pointer-events: none;
}
#user-dropdown-menu.open {
    transform: scale(1) translateY(0);
    opacity: 1;
    pointer-events: all;
}

/* ── Mobile drawer ── */
#mobile-drawer {
    transform: translateX(100%);
    transition: transform .35s cubic-bezier(.22,1,.36,1);
}
#mobile-drawer.open { transform: translateX(0); }
#mobile-overlay {
    opacity: 0; pointer-events: none;
    transition: opacity .3s ease;
}
#mobile-overlay.open { opacity: 1; pointer-events: all; }

/* ── Flash notification ── */
@keyframes slideInRight {
    from { transform: translateX(110%); opacity: 0; }
    to   { transform: translateX(0);   opacity: 1; }
}
@keyframes slideOutRight {
    from { transform: translateX(0);   opacity: 1; }
    to   { transform: translateX(110%); opacity: 0; }
}
.flash-enter  { animation: slideInRight .4s cubic-bezier(.22,1,.36,1) forwards; }
.flash-exit   { animation: slideOutRight .35s ease forwards; }

/* ── Footer wave ── */
.footer-wave {
    fill: var(--navy);
}

/* ── Float animation ── */
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
.float { animation: float 3.5s ease-in-out infinite; }

/* ── Pulse glow ── */
@keyframes pulse-glow {
    0%,100% { box-shadow: 0 0 0 0 rgba(201,147,58,.4); }
    50%      { box-shadow: 0 0 0 10px rgba(201,147,58,0); }
}
.pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }

/* ── Shimmer ── */
@keyframes shimmer {
    0%   { background-position: -400px 0; }
    100% { background-position: 400px 0; }
}
.shimmer {
    background: linear-gradient(90deg, #f4f0ea 25%, #e8e2d8 50%, #f4f0ea 75%);
    background-size: 800px 100%; animation: shimmer 1.6s infinite;
}

/* ── Diagonal clip ── */
.clip-diagonal-b {
    clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%);
}
.clip-diagonal-t {
    clip-path: polygon(0 6%, 100% 0, 100% 100%, 0 100%);
}

/* ── Section heading accent ── */
.section-eyebrow {
    display: inline-flex; align-items: center; gap: .4rem;
    background: rgba(11,123,139,.1); color: #0B7B8B;
    font-size: .7rem; font-weight: 800; letter-spacing: .08em;
    text-transform: uppercase; padding: .3rem .85rem;
    border-radius: 9999px;
}

/* ── Tag pills ── */
.tag-pill {
    display: inline-flex; align-items: center; gap: .3rem;
    background: rgba(13,35,64,.07); color: var(--navy);
    font-size: .7rem; font-weight: 700; padding: .25rem .65rem;
    border-radius: 9999px; letter-spacing: .02em;
}
    </style>

    @stack('styles')
</head>

<body class="bg-cream font-body text-slate-900 dark:bg-background-dark dark:text-slate-100">

<!-- Scroll progress -->
<div id="scroll-progress"></div>

<!-- ════════════════════════════════════════
     HEADER / NAVIGATION
════════════════════════════════════════ -->
<header id="main-header"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-cream/80 backdrop-blur-md dark:bg-background-dark/80">

    @php
        $navLinks = [
            ['route' => 'home',       'label' => 'Beranda',     'match' => 'home'],
            ['route' => 'profil',     'label' => 'Profil',      'match' => 'profil'],
            ['route' => 'guru',       'label' => 'Guru',        'match' => 'guru'],
            ['route' => 'berita',     'label' => 'Berita',      'match' => 'berita*'],
            ['route' => 'galeri',     'label' => 'Galeri',      'match' => 'galeri'],
            ['route' => 'pendaftaran','label' => 'Pendaftaran', 'match' => 'pendaftaran*'],
            ['route' => 'aplikasi',   'label' => 'App',         'match' => 'aplikasi*'],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-[68px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo"
                         class="h-10 w-10 object-contain rounded-xl ring-2 ring-sand transition-all group-hover:ring-accent"/>
                @else
                    <div class="relative h-10 w-10 shrink-0">
                        <div class="h-10 w-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/25 transition-all group-hover:shadow-primary/40 group-hover:scale-105">
                            <span class="material-symbols-outlined text-accent text-xl" style="font-variation-settings:'FILL' 1">school</span>
                        </div>
                    </div>
                @endif
                <div class="hidden sm:flex flex-col leading-tight">
                    <span class="font-display text-[15px] font-black tracking-tight text-primary dark:text-white leading-none">
                        {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                    </span>
                    <span class="text-[10px] font-bold text-secondary uppercase tracking-widest mt-0.5">
                        Kepulauan Aru · Maluku
                    </span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-0.5">
                @foreach($navLinks as $link)
                    @php $active = request()->routeIs($link['match']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="nav-link {{ $active ? 'active' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Desktop Auth --}}
            <div class="hidden lg:flex items-center gap-2">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin"
                           class="flex items-center gap-1.5 text-xs font-bold text-secondary hover:text-primary border border-secondary/30 hover:border-secondary/70 px-3 py-2 rounded-lg transition-all hover:bg-secondary/5">
                            <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                            Admin
                        </a>
                    @endif
                    <div class="relative" id="user-dropdown-wrapper">
                        <button id="user-dropdown-btn"
                                class="flex items-center gap-2 bg-white/80 hover:bg-white dark:bg-white/5 dark:hover:bg-white/10 border border-sand dark:border-white/10 px-3 py-2 rounded-xl transition-all shadow-sm">
                            <span class="w-7 h-7 rounded-lg bg-primary text-accent text-xs font-black flex items-center justify-center shrink-0 font-display">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-200 max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                            <span class="material-symbols-outlined text-sm text-slate-400 transition-transform duration-200" id="dropdown-chevron">expand_more</span>
                        </button>

                        <div id="user-dropdown-menu"
                             class="absolute right-0 top-full mt-2 w-60 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl shadow-primary/10 border border-sand dark:border-white/10 overflow-hidden z-50">
                            <div class="px-4 py-4 bg-primary text-white">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-accent/20 flex items-center justify-center font-display font-black text-accent text-lg">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-white/60 truncate">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('profil-akun') }}"
                                   class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-cream dark:hover:bg-white/5 rounded-xl transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary">manage_accounts</span>
                                    Profil Akun
                                </a>
                                @if(auth()->user()->role === 'orangtua')
                                <a href="{{ route('pendaftaran.riwayat') }}"
                                   class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-cream dark:hover:bg-white/5 rounded-xl transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary">assignment</span>
                                    Riwayat Pendaftaran
                                </a>
                                @endif
                                <div class="my-1.5 border-t border-sand dark:border-white/10"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">
                                        <span class="material-symbols-outlined text-base">logout</span>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-bold text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-white transition-colors px-3 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex items-center gap-1.5 bg-primary hover:bg-primary/90 text-white px-4 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-primary/25 active:scale-95 pulse-glow">
                        <span class="material-symbols-outlined text-sm">person_add</span>
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile hamburger --}}
            <button id="mobile-menu-btn"
                    class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl text-primary dark:text-slate-300 hover:bg-primary/8 transition-colors">
                <span class="material-symbols-outlined" id="mobile-menu-icon">menu</span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile overlay -->
<div id="mobile-overlay" class="fixed inset-0 z-40 bg-primary/40 backdrop-blur-sm lg:hidden"></div>

<!-- Mobile drawer -->
<div id="mobile-drawer"
     class="fixed top-0 right-0 h-full w-72 z-50 bg-white dark:bg-slate-900 shadow-2xl lg:hidden overflow-y-auto">

    <!-- Drawer header -->
    <div class="flex items-center justify-between px-6 py-4 bg-primary text-white">
        <div class="flex items-center gap-2.5">
            <span class="material-symbols-outlined text-accent" style="font-variation-settings:'FILL' 1">school</span>
            <span class="font-display font-black text-sm leading-tight">SD Negeri<br/>Warialau</span>
        </div>
        <button id="mobile-close-btn" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-lg">close</span>
        </button>
    </div>

    <!-- Nav links -->
    <div class="p-4 space-y-1">
        @foreach($navLinks as $link)
            @php $active = request()->routeIs($link['match']); @endphp
            <a href="{{ route($link['route']) }}"
               class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold transition-all
                      {{ $active
                          ? 'bg-primary text-white shadow-md shadow-primary/20'
                          : 'text-slate-600 dark:text-slate-300 hover:bg-cream dark:hover:bg-white/5 hover:text-primary' }}">
                <span>{{ $link['label'] }}</span>
                @if($active)
                    <span class="w-2 h-2 rounded-full bg-accent"></span>
                @else
                    <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
                @endif
            </a>
        @endforeach
    </div>

    <!-- Auth section -->
    <div class="px-4 pb-4 border-t border-sand dark:border-white/10 pt-4 mx-2 mt-2">
        @auth
            <div class="flex items-center gap-3 bg-cream dark:bg-white/5 rounded-xl p-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center font-display font-black text-accent shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            @if(auth()->user()->role === 'admin')
                <a href="/admin"
                   class="flex items-center gap-2 w-full px-4 py-2.5 mb-2 rounded-xl text-sm font-bold text-secondary bg-secondary/8 hover:bg-secondary/15 transition-colors">
                    <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                    Panel Admin
                </a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl text-sm font-bold text-red-600 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 transition-colors">
                    <span class="material-symbols-outlined text-base">logout</span>
                    Keluar
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
               class="flex items-center justify-center w-full px-4 py-3 mb-2 rounded-xl text-sm font-bold text-primary border-2 border-primary/30 hover:border-primary hover:bg-primary/5 transition-all">
                Masuk
            </a>
            <a href="{{ route('register') }}"
               class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-bold bg-primary text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-base">person_add</span>
                Daftar Akun
            </a>
        @endauth
    </div>
</div>

<!-- Main content -->
<main class="pt-[68px]">
    @if(session('success'))
        <div id="flash-success" class="flash-enter fixed top-24 right-4 z-50 max-w-sm">
            <div class="bg-white dark:bg-slate-800 border border-emerald-200 dark:border-emerald-800/50 rounded-2xl shadow-xl shadow-emerald-500/10 overflow-hidden">
                <div class="h-1 bg-emerald-400 w-full relative">
                    <div class="h-full bg-emerald-400 animate-[shrink_4s_linear_forwards]" id="flash-bar"></div>
                </div>
                <div class="flex items-start gap-3 px-4 py-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-emerald-600 text-sm" style="font-variation-settings:'FILL' 1">check_circle</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800 dark:text-white">Berhasil!</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button onclick="dismissFlash()" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div id="flash-error" class="flash-enter fixed top-24 right-4 z-50 max-w-sm">
            <div class="bg-white dark:bg-slate-800 border border-red-200 dark:border-red-800/50 rounded-2xl shadow-xl shadow-red-500/10 overflow-hidden">
                <div class="h-1 bg-red-400 w-full"></div>
                <div class="flex items-start gap-3 px-4 py-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/40 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-red-600 text-sm" style="font-variation-settings:'FILL' 1">error</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800 dark:text-white">Oops!</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ session('error') }}</p>
                    </div>
                    <button onclick="document.getElementById('flash-error').remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @yield('content')
</main>

<!-- ════════════════════════════════════════
     FOOTER
════════════════════════════════════════ -->
<footer class="relative bg-primary text-white overflow-hidden">

    <!-- Wave top -->
    <div class="absolute top-0 inset-x-0 overflow-hidden" style="height:60px; margin-top:-59px;">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0 60L60 50C120 40 240 20 360 15C480 10 600 20 720 28C840 36 960 42 1080 38C1200 34 1320 20 1380 13L1440 6V60H1380C1320 60 1200 60 1080 60C960 60 840 60 720 60C600 60 480 60 360 60C240 60 120 60 60 60H0Z" fill="#0D2340"/>
        </svg>
    </div>

    <!-- Decorative circles -->
    <div class="absolute top-10 right-0 w-80 h-80 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-20 pb-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-14">

            <!-- Identitas -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-accent text-2xl" style="font-variation-settings:'FILL' 1">school</span>
                    </div>
                    <div>
                        <h2 class="font-display font-black text-base leading-tight">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</h2>
                        <p class="text-xs text-white/50 mt-0.5">Kab. Kepulauan Aru</p>
                    </div>
                </div>
                <p class="text-white/60 text-sm leading-relaxed mb-6">
                    {{ $settings['alamat_sekolah'] ?? $profil->alamat ?? 'Kec. Aru Utara, Kab. Kepulauan Aru, Maluku' }}
                </p>
                <!-- Social -->
                <div class="flex gap-3">
                    @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-white/8 hover:bg-accent hover:text-primary rounded-lg flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-white/8 hover:bg-accent hover:text-primary rounded-lg flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$settings['no_telp'] ?? $profil->kontak ?? '') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 bg-white/8 hover:bg-green-500 rounded-lg flex items-center justify-center transition-all hover:scale-110">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="font-display font-bold text-base mb-5 flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-accent rounded-full inline-block"></span>
                    Tautan Cepat
                </h3>
                <ul class="space-y-3 text-sm">
                    @foreach([
                        ['route'=>'profil',      'label'=>'Profil Sekolah'],
                        ['route'=>'guru',        'label'=>'Daftar Guru'],
                        ['route'=>'berita',      'label'=>'Berita & Kegiatan'],
                        ['route'=>'galeri',      'label'=>'Galeri Foto'],
                        ['route'=>'pendaftaran', 'label'=>'Pendaftaran Siswa'],
                        ['route'=>'aplikasi',    'label'=>'Download App'],
                    ] as $fl)
                        <li>
                            <a href="{{ route($fl['route']) }}"
                               class="text-white/55 hover:text-accent transition-colors flex items-center gap-2 group">
                                <span class="w-1 h-1 rounded-full bg-accent/40 group-hover:bg-accent transition-colors"></span>
                                {{ $fl['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="font-display font-bold text-base mb-5 flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-accent rounded-full inline-block"></span>
                    Hubungi Kami
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-accent text-sm">mail</span>
                        </div>
                        <span class="text-white/60 text-sm">{{ $settings['email_sekolah'] ?? 'info@sdwarialau.sch.id' }}</span>
                    </li>
                    @if(!empty($settings['no_telp']) || ($profil && $profil->kontak))
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-accent text-sm">call</span>
                        </div>
                        <span class="text-white/60 text-sm">{{ $settings['no_telp'] ?? $profil->kontak ?? '-' }}</span>
                    </li>
                    @endif
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-accent text-sm">schedule</span>
                        </div>
                        <span class="text-white/60 text-sm">Senin – Sabtu<br/>07.30 – 14.00 WIT</span>
                    </li>
                </ul>
            </div>

            <!-- Peta -->
            <div>
                <h3 class="font-display font-bold text-base mb-5 flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-accent rounded-full inline-block"></span>
                    Lokasi Kami
                </h3>
                <div class="rounded-xl overflow-hidden h-44 border border-white/10 shadow-lg">
                    @if(!empty($settings['maps_embed']))
                        {!! $settings['maps_embed'] !!}
                    @else
                        <div class="w-full h-full bg-white/5 flex flex-col items-center justify-center text-white/30">
                            <span class="material-symbols-outlined text-4xl mb-2">map</span>
                            <p class="text-xs text-center px-4">Peta belum dikonfigurasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-white/40 text-xs text-center sm:text-left">
                © {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}. Seluruh Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-2">
                <span class="text-white/30 text-xs">Dibuat dengan</span>
                <span class="material-symbols-outlined text-accent text-sm" style="font-variation-settings:'FILL' 1">favorite</span>
                <span class="text-white/30 text-xs">untuk pendidikan Maluku</span>
            </div>
        </div>
    </div>
</footer>

<!-- ════════════════════════════════════════
     SCRIPTS
════════════════════════════════════════ -->
<script>
(function(){
    /* ── Scroll progress ── */
    const prog = document.getElementById('scroll-progress');
    function updateProgress() {
        const scrolled = window.scrollY;
        const max = document.documentElement.scrollHeight - window.innerHeight;
        if (prog) prog.style.width = Math.min((scrolled / max) * 100, 100) + '%';
    }

    /* ── Header scroll state ── */
    const header = document.getElementById('main-header');
    function updateHeader() {
        if (!header) return;
        header.classList.toggle('header-scrolled', window.scrollY > 20);
    }

    window.addEventListener('scroll', () => { updateProgress(); updateHeader(); }, { passive: true });
    updateHeader();

    /* ── Mobile drawer ── */
    const menuBtn     = document.getElementById('mobile-menu-btn');
    const closeBtn    = document.getElementById('mobile-close-btn');
    const drawer      = document.getElementById('mobile-drawer');
    const overlay     = document.getElementById('mobile-overlay');
    const menuIcon    = document.getElementById('mobile-menu-icon');

    function openDrawer() {
        drawer?.classList.add('open');
        overlay?.classList.add('open');
        if (menuIcon) menuIcon.textContent = 'close';
        document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
        drawer?.classList.remove('open');
        overlay?.classList.remove('open');
        if (menuIcon) menuIcon.textContent = 'menu';
        document.body.style.overflow = '';
    }

    menuBtn?.addEventListener('click', openDrawer);
    closeBtn?.addEventListener('click', closeDrawer);
    overlay?.addEventListener('click', closeDrawer);

    /* ── User dropdown ── */
    const dropBtn     = document.getElementById('user-dropdown-btn');
    const dropMenu    = document.getElementById('user-dropdown-menu');
    const dropChevron = document.getElementById('dropdown-chevron');

    dropBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = dropMenu?.classList.contains('open');
        dropMenu?.classList.toggle('open', !isOpen);
        if (dropChevron) dropChevron.style.transform = isOpen ? '' : 'rotate(180deg)';
    });
    document.addEventListener('click', () => {
        dropMenu?.classList.remove('open');
        if (dropChevron) dropChevron.style.transform = '';
    });

    /* ── Flash dismiss ── */
    window.dismissFlash = function() {
        const f = document.getElementById('flash-success');
        if (!f) return;
        f.classList.remove('flash-enter');
        f.classList.add('flash-exit');
        setTimeout(() => f.remove(), 400);
    };
    const flashEl = document.getElementById('flash-success');
    if (flashEl) setTimeout(() => window.dismissFlash(), 4000);

    const flashErr = document.getElementById('flash-error');
    if (flashErr) setTimeout(() => flashErr.remove(), 5000);
})();
</script>

<script>
/* ── Global Intersection Observer ── */
(function(){
    const selectors = '.reveal, .reveal-left, .reveal-right, .reveal-scale';
    const els = document.querySelectorAll(selectors);
    if (!els.length) return;
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
    els.forEach(el => obs.observe(el));
})();
</script>

@stack('scripts')
</body>
</html>
