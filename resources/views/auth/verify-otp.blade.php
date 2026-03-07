@extends('layouts.auth')

@section('title', 'Verifikasi OTP - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

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
                <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings:'FILL' 1">mark_email_read</span>
            </div>
            <h2 class="text-3xl font-black mb-3">Cek Email Anda</h2>
            <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                Kami telah mengirimkan kode OTP 6 digit ke email Anda. Masukkan kode tersebut untuk melanjutkan.
            </p>
            {{-- Step indicators --}}
            <div class="mt-10 flex items-center gap-6 text-center">
                <div>
                    <div class="w-10 h-10 rounded-full bg-white/20 border border-white/40 flex items-center justify-center mx-auto mb-2 font-black text-sm">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">check</span>
                    </div>
                    <p class="text-xs text-white/50">Masukkan<br/>Email</p>
                </div>
                <div class="flex-1 h-px bg-accent/60"></div>
                <div>
                    <div class="w-10 h-10 rounded-full bg-accent border border-accent flex items-center justify-center mx-auto mb-2 text-primary font-black text-sm">2</div>
                    <p class="text-xs text-white/80">Kode<br/>OTP</p>
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

            <a href="{{ route('password.request') }}"
               class="flex items-center gap-1.5 text-slate-400 hover:text-primary transition-colors text-sm font-medium mb-10 group">
                <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali
            </a>

            <div class="mb-8">
                <div class="w-14 h-14 bg-primary/8 rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">mark_email_read</span>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-1">Masukkan Kode OTP</h2>
                <p class="text-slate-400 text-sm">
                    Kode dikirim ke
                    <span class="font-semibold text-slate-600 dark:text-slate-300">{{ session('otp_email') }}</span>
                </p>
            </div>

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

            {{-- Success (resend) --}}
            @if(session('success'))
                <div class="mb-5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 flex items-start gap-3">
                    <span class="material-symbols-outlined text-green-500 text-base shrink-0 mt-0.5" style="font-variation-settings:'FILL' 1">check_circle</span>
                    <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                </div>
            @endif

            {{-- OTP Form --}}
            <form action="{{ route('password.verify') }}" method="POST" class="space-y-6" id="otp-form">
                @csrf

                {{-- 6 digit boxes --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kode OTP (6 Digit)</label>
                    <div class="flex gap-3 justify-between" id="otp-boxes">
                        @for($i = 1; $i <= 6; $i++)
                            <input
                                type="text"
                                maxlength="1"
                                inputmode="numeric"
                                pattern="[0-9]"
                                data-index="{{ $i }}"
                                class="otp-input w-full aspect-square text-center text-xl font-black bg-slate-50 dark:bg-slate-800 border-2 {{ $errors->has('otp') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white"
                                autocomplete="off"
                            />
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otp-hidden"/>
                </div>

                {{-- Timer --}}
                <div class="flex items-center justify-between text-sm">
                    <p class="text-slate-400">
                        Kode berlaku selama
                        <span id="countdown" class="font-bold text-primary">10:00</span>
                    </p>
                    <span id="expired-text" class="text-red-500 font-semibold hidden">Kode kedaluwarsa</span>
                </div>

                <button type="submit" id="verify-btn"
                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-base">verified</span>
                    Verifikasi Kode
                </button>
            </form>

            {{-- Resend --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-400 mb-3">Tidak menerima kode?</p>
                <form action="{{ route('password.resend') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" id="resend-btn"
                            class="text-sm font-bold text-accent hover:underline disabled:opacity-40 disabled:cursor-not-allowed disabled:no-underline transition-all"
                            @if(session('resend_cooldown')) disabled @endif>
                        @if(session('resend_cooldown'))
                            Kirim ulang dalam <span id="resend-cd">{{ session('resend_cooldown') }}</span>d
                        @else
                            Kirim Ulang OTP
                        @endif
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
    const inputs = document.querySelectorAll('.otp-input');
    const hidden = document.getElementById('otp-hidden');
    const form   = document.getElementById('otp-form');

    // Auto-focus & navigation between boxes
    inputs.forEach((input, idx) => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '').slice(-1);
            updateHidden();
            if (this.value && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && idx > 0) {
                inputs[idx - 1].focus();
            }
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            [...text].slice(0, 6).forEach((char, i) => {
                if (inputs[idx + i]) inputs[idx + i].value = char;
            });
            updateHidden();
            const next = Math.min(idx + text.length, inputs.length - 1);
            inputs[next].focus();
        });
    });

    function updateHidden() {
        hidden.value = [...inputs].map(i => i.value).join('');
    }

    // Focus first box on load
    inputs[0]?.focus();

    // Countdown 10 minutes
    const countdownEl = document.getElementById('countdown');
    const expiredEl   = document.getElementById('expired-text');
    const verifyBtn   = document.getElementById('verify-btn');
    let seconds = 10 * 60;

    function tick() {
        const m = String(Math.floor(seconds / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        countdownEl.textContent = m + ':' + s;

        if (seconds <= 0) {
            countdownEl.classList.add('hidden');
            expiredEl.classList.remove('hidden');
            verifyBtn.disabled = true;
            verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
            return;
        }
        seconds--;
        setTimeout(tick, 1000);
    }
    tick();
})();
</script>
@endpush
