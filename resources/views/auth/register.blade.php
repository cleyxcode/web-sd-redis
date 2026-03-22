@extends('layouts.auth')

@section('title', 'Daftar Akun - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="flex min-h-screen flex-col lg:flex-row">

    {{-- Left Column: Branding --}}
    <div class="relative hidden lg:flex lg:w-1/2 flex-col justify-between p-12 text-white bg-primary">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0 opacity-40 overflow-hidden">
            @if(!empty($settings['background']))
                <img src="{{ asset('storage/' . $settings['background']) }}"
                     alt="{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}"
                     class="w-full h-full object-cover"/>
            @else
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_JgX5IeCkGAQB5iO_00dte0vV0G_jfuBFL-GpuMjRee7OQU4Wa8mkQO2Sg3obRUJVI8FpmuOj2OKCoJ885u4IIN0pRtVLsttsdf8ZRnwp-XRd6OypRp3_e3O1XjU30We7TrgyyflQp4KeM9XeC4E-Ry2IDUPYMg1OKgYTgXRYJp43x6qmQOwP7SKyOzsjD0C5pXY5S17fhMFaho2b1M9Xq98V6W858_E5_uhHBlf6PEI87-R15AxAFo1qTSa2T8Zlw53Pq1l3cZo"
                     alt="SD Negeri Warialau"
                     class="w-full h-full object-cover"/>
            @endif
        </div>
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-primary via-primary/50 to-transparent"></div>

        {{-- Logo --}}
        <div class="relative z-20 flex items-center gap-3">
            <div class="p-2 bg-white/10 backdrop-blur-md rounded-lg">
                @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-8 w-8 object-contain"/>
                @else
                    <span class="material-symbols-outlined text-2xl text-white">school</span>
                @endif
            </div>
            <h1 class="font-display text-2xl font-black tracking-tight">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</h1>
        </div>

        {{-- Quote --}}
        <div class="relative z-20 mt-auto">
            <blockquote class="text-3xl font-medium leading-tight mb-6">
                "Pendidikan adalah paspor untuk masa depan, karena hari esok adalah milik mereka yang mempersiapkannya hari ini."
            </blockquote>
            <div class="flex items-center gap-4">
                <div class="h-1 w-12 bg-accent rounded-full"></div>
                <p class="text-lg opacity-80 italic">Portal Pendaftaran Siswa Baru</p>
            </div>
        </div>
    </div>

    {{-- Right Column: Register Form --}}
    <div class="flex flex-1 flex-col items-center justify-center p-6 sm:p-12 md:p-16 bg-white dark:bg-background-dark">
        <div class="w-full max-w-md space-y-8">

            {{-- Back Link --}}
            <a href="{{ route('home') }}"
               class="group flex items-center gap-2 text-sm font-semibold text-primary dark:text-slate-300 hover:opacity-80 transition-all">
                <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Beranda
            </a>

            {{-- Header --}}
            <div class="space-y-1">
                <h2 class="font-display text-3xl font-black text-slate-900 dark:text-white">Buat Akun Baru</h2>
                <p class="text-slate-500 dark:text-slate-400">Daftarkan akun untuk memulai pendaftaran siswa baru</p>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-base shrink-0 mt-0.5">error</span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200" for="name">Nama Lengkap</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
                        <input id="name" name="name" type="text"
                               value="{{ old('name') }}"
                               placeholder="Nama lengkap Anda"
                               class="w-full pl-12 pr-4 py-3.5 rounded-lg border {{ $errors->has('name') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"/>
                    </div>
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200" for="email">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                        <input id="email" name="email" type="email"
                               value="{{ old('email') }}"
                               placeholder="contoh@email.com"
                               class="w-full pl-12 pr-4 py-3.5 rounded-lg border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"/>
                    </div>
                </div>

                {{-- No HP --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200" for="no_hp">No HP</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">call</span>
                        <input id="no_hp" name="no_hp" type="tel"
                               value="{{ old('no_hp') }}"
                               placeholder="0812..."
                               class="w-full pl-12 pr-4 py-3.5 rounded-lg border {{ $errors->has('no_hp') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"/>
                    </div>
                </div>

                {{-- Password --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200" for="password">Kata Sandi</label>
                        <input id="password" name="password" type="password"
                               placeholder="Min. 8 karakter"
                               class="w-full px-4 py-3.5 rounded-lg border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"/>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200" for="password_confirmation">Konfirmasi</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               placeholder="Ulangi sandi"
                               class="w-full px-4 py-3.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"/>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
                    Daftar Akun
                </button>
            </form>

            {{-- Footer --}}
            <div class="text-center pt-2 space-y-4">
                <p class="text-slate-600 dark:text-slate-400 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-accent hover:text-accent/80 transition-colors ml-1">
                        Masuk Sekarang
                    </a>
                </p>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-relaxed">
                    Dengan mendaftar, Anda menyetujui <br/> Syarat &amp; Ketentuan serta Kebijakan Privasi kami.
                </p>
            </div>

        </div>
    </div>

</div>
@endsection
