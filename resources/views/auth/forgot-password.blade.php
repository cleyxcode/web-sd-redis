@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="flex min-h-screen w-full flex-col lg:flex-row">

    {{-- Left --}}
    <div class="hidden lg:flex lg:w-2/5 bg-primary relative overflow-hidden flex-col items-center justify-center p-12 text-white">
        <div class="absolute inset-0 z-0 opacity-30 overflow-hidden">
            @if(!empty($settings['background']))
                <img src="{{ asset('storage/'.$settings['background']) }}" alt="" class="w-full h-full object-cover"/>
            @else
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_JgX5IeCkGAQB5iO_00dte0vV0G_jfuBFL-GpuMjRee7OQU4Wa8mkQO2Sg3obRUJVI8FpmuOj2OKCoJ885u4IIN0pRtVLsttsdf8ZRnwp-XRd6OypRp3_e3O1XjU30We7TrgyyflQp4KeM9XeC4E-Ry2IDUPYMg1OKgYTgXRYJp43x6qmQOwP7SKyOzsjD0C5pXY5S17fhMFaho2b1M9Xq98V6W858_E5_uhHBlf6PEI87-R15AxAFo1qTSa2T8Zlw53Pq1l3cZo"
                     alt="" class="w-full h-full object-cover"/>
            @endif
        </div>
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-primary via-primary/60 to-transparent"></div>
        <div class="relative z-20 flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-accent rounded-3xl flex items-center justify-center mb-6 shadow-2xl">
                <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings:'FILL' 1">lock_reset</span>
            </div>
            <h2 class="text-3xl font-black mb-3">Reset Kata Sandi</h2>
            <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                Masukkan email Anda dan kami akan mengirimkan kode OTP untuk mereset kata sandi.
            </p>
            <div class="mt-10 flex items-center gap-6 text-center">
                <div>
                    <div class="w-10 h-10 rounded-full bg-accent/20 border border-accent/40 flex items-center justify-center mx-auto mb-2 text-accent font-black text-sm">1</div>
                    <p class="text-xs text-white/50">Masukkan<br/>Email</p>
                </div>
                <div class="flex-1 h-px bg-white/10"></div>
                <div>
                    <div class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center mx-auto mb-2 text-white/40 font-black text-sm">2</div>
                    <p class="text-xs text-white/30">Kode<br/>OTP</p>
                </div>
                <div class="flex-1 h-px bg-white/10"></div>
                <div>
                    <div class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center mx-auto mb-2 text-white/40 font-black text-sm">3</div>
                    <p class="text-xs text-white/30">Kata Sandi<br/>Baru</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="flex-1 flex flex-col items-center justify-center p-6 sm:p-12 bg-white dark:bg-background-dark">
        <div class="w-full max-w-[400px]">

            <a href="{{ route('login') }}"
               class="flex items-center gap-1.5 text-slate-400 hover:text-primary transition-colors text-sm font-medium mb-10 group">
                <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke halaman masuk
            </a>

            <div class="mb-8">
                <div class="w-14 h-14 bg-primary/8 rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">lock_reset</span>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-1">Lupa Kata Sandi?</h2>
                <p class="text-slate-400 text-sm">Masukkan email akun Anda untuk mendapatkan kode OTP.</p>
            </div>

            {{-- Alert info --}}
            @if(session('info'))
                <div class="mb-5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-500 text-base shrink-0 mt-0.5" style="font-variation-settings:'FILL' 1">info</span>
                    <p class="text-sm text-blue-700 dark:text-blue-300">{{ session('info') }}</p>
                </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
                <div class="mb-5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-600 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">error</span>{{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input name="email" type="email" value="{{ old('email') }}"
                               placeholder="contoh@email.com" autofocus
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 dark:bg-slate-800 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                    </div>
                </div>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-base">send</span>
                    Kirim Kode OTP
                </button>
            </form>

            <p class="text-center text-sm text-slate-400 mt-6">
                Ingat kata sandi?
                <a href="{{ route('login') }}" class="font-bold text-accent hover:underline ml-1">Masuk Sekarang</a>
            </p>
        </div>
    </div>

</div>
@endsection
