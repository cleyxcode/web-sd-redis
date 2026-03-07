<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SD Negeri Warialau - Official Website')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1f3b61",
                        "accent": "#d4af37",
                        "background-light": "#f6f7f8",
                        "background-dark": "#14181e",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
                },
            },
        }
    </script>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 w-full bg-white/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center gap-3">
                @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-10 w-10 object-contain rounded-lg"/>
                @else
                    <div class="bg-primary p-2 rounded-lg text-white">
                        <span class="material-symbols-outlined text-2xl">school</span>
                    </div>
                @endif
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-primary dark:text-slate-100">
                    {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                </a>
            </div>

            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('home') }}">Beranda</a>
                <a class="text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('profil') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('profil') }}">Profil</a>
                <a class="text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('guru') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('guru') }}">Guru</a>
                <a class="text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('berita*') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('berita') }}">Berita</a>
                <a class="text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('galeri') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('galeri') }}">Galeri</a>
                <a class="text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('pendaftaran*') ? 'text-primary' : 'text-slate-600 dark:text-slate-400' }}"
                   href="{{ route('pendaftaran') }}">Pendaftaran</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin"
                           class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors hidden md:block">
                            Panel Admin
                        </a>
                    @else
                        <span class="hidden md:flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                            <span class="material-symbols-outlined text-base text-primary">account_circle</span>
                            {{ auth()->user()->name }}
                        </span>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                        @csrf
                        <button type="submit"
                                class="bg-slate-100 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-700 dark:text-slate-300 hover:text-red-600 px-4 py-2 rounded-lg font-semibold text-sm transition-all">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden md:block text-sm font-semibold text-primary hover:text-primary/80 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="hidden md:block bg-primary hover:bg-primary/90 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-lg shadow-primary/20">
                        Daftar
                    </a>
                @endauth
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-slate-600 hover:text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile nav -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <nav class="flex flex-col gap-2">
                <a class="py-2 px-3 text-sm font-semibold rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('home') }}">Beranda</a>
                <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('profil') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('profil') }}">Profil</a>
                <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('guru') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('guru') }}">Guru</a>
                <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('berita*') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('berita') }}">Berita</a>
                <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('galeri') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('galeri') }}">Galeri</a>
                <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors {{ request()->routeIs('pendaftaran*') ? 'text-primary bg-primary/10' : 'text-slate-600' }}"
                   href="{{ route('pendaftaran') }}">Pendaftaran</a>
                <div class="pt-2 border-t border-slate-100 dark:border-slate-800 mt-2">
                    @auth
                        <p class="px-3 py-1 text-xs text-slate-400">
                            Login sebagai: <strong>{{ auth()->user()->name }}</strong>
                        </p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left py-2 px-3 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a class="py-2 px-3 text-sm font-medium rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-slate-600 block"
                           href="{{ route('login') }}">Masuk</a>
                        <a class="py-2 px-3 text-sm font-bold rounded-lg bg-primary text-white block text-center mt-1"
                           href="{{ route('register') }}">Daftar Akun</a>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
</header>

<main>
    @if(session('success'))
        <div id="flash-success"
             class="fixed top-24 right-4 z-50 max-w-sm bg-green-500 text-white px-5 py-4 rounded-xl shadow-xl flex items-start gap-3 animate-bounce-once">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-white/80 hover:text-white">
                <span class="material-symbols-outlined text-base">close</span>
            </button>
        </div>
    @endif
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-primary text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Info Sekolah -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-white/10 p-2 rounded-lg">
                        <span class="material-symbols-outlined text-2xl">school</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</h2>
                </div>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    {{ $settings['alamat_sekolah'] ?? $profil->alamat ?? 'Kec. Aru Utara, Kab. Kepulauan Aru, Maluku' }}
                </p>
                <div class="flex gap-4">
                    @if(!empty($settings['facebook_url']))
                        <a class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent hover:text-primary transition-colors"
                           href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                        </a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent hover:text-primary transition-colors"
                           href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="text-lg font-bold mb-6">Tautan Cepat</h3>
                <ul class="space-y-4 text-sm text-slate-300">
                    <li><a class="hover:text-accent transition-colors" href="{{ route('profil') }}">Profil Sekolah</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('profil') }}#visi-misi">Visi &amp; Misi</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('guru') }}">Daftar Guru</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('galeri') }}">Galeri Kegiatan</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('pendaftaran') }}">Pendaftaran Siswa</a></li>
                </ul>
            </div>

            <!-- Informasi Kontak -->
            <div>
                <h3 class="text-lg font-bold mb-6">Kontak Kami</h3>
                <ul class="space-y-4 text-sm text-slate-300">
                    @if(!empty($settings['email_sekolah']))
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">mail</span>
                            {{ $settings['email_sekolah'] }}
                        </li>
                    @else
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">mail</span>
                            info@sdwarialau.sch.id
                        </li>
                    @endif
                    @if(!empty($settings['no_telp']))
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">call</span>
                            {{ $settings['no_telp'] }}
                        </li>
                    @elseif($profil && $profil->kontak)
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">call</span>
                            {{ $profil->kontak }}
                        </li>
                    @endif
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-accent">schedule</span>
                        Senin - Sabtu: 07.30 - 14.00
                    </li>
                </ul>
            </div>

            <!-- Google Maps -->
            <div class="rounded-xl overflow-hidden h-48 border-2 border-white/10">
                @if(!empty($settings['maps_embed']))
                    {!! $settings['maps_embed'] !!}
                @else
                    <div class="w-full h-full bg-slate-700 flex flex-col items-center justify-center text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2">map</span>
                        <p class="text-xs px-4 text-center">Peta Lokasi {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 text-center text-sm text-slate-400">
            <p>© {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    if (btn && menu) {
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    }
</script>
@stack('scripts')
</body>
</html>
