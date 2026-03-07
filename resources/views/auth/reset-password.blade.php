@extends('layouts.auth')

@section('title', 'Buat Kata Sandi Baru - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

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
                <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings:'FILL' 1">lock</span>
            </div>
            <h2 class="text-3xl font-black mb-3">Kata Sandi Baru</h2>
            <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                Buat kata sandi baru yang kuat dan mudah diingat untuk akun Anda.
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
                    <div class="w-10 h-10 rounded-full bg-white/20 border border-white/40 flex items-center justify-center mx-auto mb-2 font-black text-sm">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">check</span>
                    </div>
                    <p class="text-xs text-white/50">Kode<br/>OTP</p>
                </div>
                <div class="flex-1 h-px bg-accent/60"></div>
                <div>
                    <div class="w-10 h-10 rounded-full bg-accent border border-accent flex items-center justify-center mx-auto mb-2 text-primary font-black text-sm">3</div>
                    <p class="text-xs text-white/80">Kata Sandi<br/>Baru</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="flex-1 flex flex-col items-center justify-center p-6 sm:p-12 bg-white dark:bg-background-dark">
        <div class="w-full max-w-[400px]">

            <div class="mb-8">
                <div class="w-14 h-14 bg-primary/8 rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">lock_reset</span>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-1">Buat Kata Sandi Baru</h2>
                <p class="text-slate-400 text-sm">Masukkan kata sandi baru untuk akun Anda.</p>
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

            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf

                {{-- New Password --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kata Sandi Baru</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input id="password-field" name="password" type="password"
                               placeholder="Minimal 8 karakter"
                               class="w-full pl-11 pr-12 py-3.5 bg-slate-50 dark:bg-slate-800 border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                        <button type="button" id="toggle-password"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock_clock</span>
                        <input id="password-confirm-field" name="password_confirmation" type="password"
                               placeholder="Ulangi kata sandi"
                               class="w-full pl-11 pr-12 py-3.5 bg-slate-50 dark:bg-slate-800 border {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-slate-200 dark:border-slate-700' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                        <button type="button" id="toggle-confirm"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Strength indicator --}}
                <div id="strength-wrap" class="hidden space-y-1">
                    <div class="flex gap-1">
                        <div class="strength-bar h-1 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                    </div>
                    <p id="strength-label" class="text-xs text-slate-400"></p>
                </div>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-base">save</span>
                    Simpan Kata Sandi Baru
                </button>
            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Toggle password visibility
function makeToggle(btnId, fieldId) {
    const btn   = document.getElementById(btnId);
    const field = document.getElementById(fieldId);
    btn?.addEventListener('click', function () {
        const icon = this.querySelector('.material-symbols-outlined');
        if (field.type === 'password') {
            field.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            field.type = 'password';
            icon.textContent = 'visibility';
        }
    });
}
makeToggle('toggle-password', 'password-field');
makeToggle('toggle-confirm', 'password-confirm-field');

// Password strength
const pwField    = document.getElementById('password-field');
const strengthWrap = document.getElementById('strength-wrap');
const bars       = document.querySelectorAll('.strength-bar');
const label      = document.getElementById('strength-label');

const levels = [
    { color: 'bg-red-400',    text: 'Sangat Lemah' },
    { color: 'bg-orange-400', text: 'Lemah' },
    { color: 'bg-yellow-400', text: 'Cukup' },
    { color: 'bg-green-500',  text: 'Kuat' },
];

pwField?.addEventListener('input', function () {
    const val = this.value;
    if (!val) { strengthWrap.classList.add('hidden'); return; }
    strengthWrap.classList.remove('hidden');

    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    bars.forEach((bar, i) => {
        bar.className = 'strength-bar h-1 flex-1 rounded-full transition-all duration-300 ' +
            (i < score ? levels[score - 1].color : 'bg-slate-200');
    });
    label.textContent = levels[score - 1]?.text ?? '';
});
</script>
@endpush
