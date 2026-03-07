@extends('layouts.auth')

@section('title', 'Masuk - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="flex min-h-screen w-full flex-col lg:flex-row">

    {{-- Left Column: Branding (60%) --}}
    <div class="hidden lg:flex lg:w-3/5 bg-primary relative overflow-hidden flex-col items-center justify-center p-12 text-white">
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

        {{-- Content --}}
        <div class="relative z-20 flex flex-col items-center text-center max-w-lg">
            {{-- Logo --}}
            <div class="size-32 rounded-full border-4 border-white mb-8 flex items-center justify-center bg-white/10 backdrop-blur-sm overflow-hidden">
                @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-full w-full object-contain p-3"/>
                @else
                    <span class="material-symbols-outlined text-6xl">school</span>
                @endif
            </div>
            <h1 class="text-5xl font-black tracking-tight mb-2">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</h1>
            <p class="text-xl font-medium text-slate-200">Sistem Informasi Sekolah</p>
            <div class="w-10 h-1 bg-accent my-8 rounded-full"></div>
            <p class="text-2xl italic font-light leading-relaxed mb-12">
                "Mendidik Generasi Penerus Bangsa"
            </p>
            <div class="flex items-center gap-2 text-slate-300">
                <span class="material-symbols-outlined text-sm">location_on</span>
                <span class="text-sm tracking-wide">{{ $profil->alamat ?? 'Kab. Kepulauan Aru, Maluku' }}</span>
            </div>
        </div>
    </div>

    {{-- Right Column: Login Form (40%) --}}
    <div class="flex-1 flex flex-col items-center justify-center p-6 sm:p-12 bg-white dark:bg-background-dark">
        <div class="w-full max-w-[400px] flex flex-col">

            {{-- Back Link --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-1 text-slate-500 hover:text-primary transition-colors text-sm font-medium mb-10 group">
                <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Beranda
            </a>

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-2">Masuk ke Akun Anda</h2>
                <p class="text-slate-500 dark:text-slate-400">Silakan masuk untuk melanjutkan pendaftaran</p>
            </div>

            {{-- Error --}}
            @if($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
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

            {{-- Success (setelah logout/register) --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <p class="text-sm text-green-700 dark:text-green-400 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">check_circle</span>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-5">
                @csrf

                {{-- Email --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input name="email" type="email"
                               value="{{ old('email') }}"
                               placeholder="contoh@email.com"
                               class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100"/>
                    </div>
                </div>

                {{-- Password --}}
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input id="password-field" name="password" type="password"
                               placeholder="Masukkan kata sandi"
                               class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-800 border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100"/>
                        <button type="button" id="toggle-password"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Remember --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary focus:ring-primary"/>
                    <span class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</span>
                </label>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3.5 rounded-lg shadow-lg shadow-primary/20 transition-all mt-2 active:scale-[0.98]">
                    Masuk
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-8 flex flex-col gap-6 text-center">
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-accent font-bold hover:underline ml-1">Daftar Sekarang</a>
                </p>
                <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                    <p class="text-xs text-slate-400 mb-2">
                        Halaman ini khusus untuk Orang Tua / Wali Murid
                    </p>
                    <p class="text-sm text-slate-500">
                        Admin sekolah?
                        <a href="/admin" class="text-primary font-semibold hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('toggle-password')?.addEventListener('click', function () {
    const field = document.getElementById('password-field');
    const icon  = this.querySelector('.material-symbols-outlined');
    if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        field.type = 'password';
        icon.textContent = 'visibility';
    }
});
</script>
@endpush
