@extends('layouts.app')

@section('title', 'Profil Akun - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="min-h-screen bg-cream dark:bg-background-dark py-10 px-4">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <span class="section-eyebrow mb-3 inline-flex">
                <span class="material-symbols-outlined text-sm">manage_accounts</span>
                Akun Saya
            </span>
            <h1 class="font-display text-3xl font-black text-slate-900 dark:text-white">Profil <span class="text-gradient">Akun</span></h1>
            <p class="text-slate-400 text-sm mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>

        {{-- Tab nav --}}
        <div class="flex gap-1 bg-white dark:bg-slate-800 rounded-2xl p-1.5 border border-sand dark:border-slate-700 mb-6 shadow-sm" id="tab-nav">
            <button onclick="switchTab('info')"
                    class="tab-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-sm font-semibold transition-all"
                    id="tab-btn-info">
                <span class="material-symbols-outlined text-base">person</span>
                Informasi Akun
            </button>
            <button onclick="switchTab('password')"
                    class="tab-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-sm font-semibold transition-all"
                    id="tab-btn-password">
                <span class="material-symbols-outlined text-base">lock</span>
                Ubah Kata Sandi
            </button>
        </div>

        {{-- ── Tab: Informasi Akun ── --}}
        <div id="tab-info" class="tab-panel">
            {{-- Success --}}
            @if(session('success_info'))
                <div class="mb-5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-500 text-xl shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
                    <p class="text-sm text-green-700 dark:text-green-300 font-medium">{{ session('success_info') }}</p>
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any() && !session('tab'))
                <div class="mb-5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-600 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">error</span>{{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 shadow-sm overflow-hidden">

                {{-- Avatar header --}}
                <div class="bg-gradient-to-br from-primary via-primary to-secondary p-8 flex items-center gap-5 relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-36 h-36 bg-white/5 rounded-full pointer-events-none"></div>
                    <div class="w-20 h-20 rounded-2xl bg-accent/20 border-2 border-accent/30 flex items-center justify-center font-display text-accent text-3xl font-black shrink-0 shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white">{{ Auth::user()->name }}</h2>
                        <p class="text-white/70 text-sm mt-0.5">{{ Auth::user()->email }}</p>
                        <span class="inline-flex items-center gap-1 mt-2 bg-white/20 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                            <span class="material-symbols-outlined text-xs" style="font-variation-settings:'FILL' 1">
                                {{ Auth::user()->role === 'admin' ? 'admin_panel_settings' : 'family_restroom' }}
                            </span>
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Orang Tua / Wali' }}
                        </span>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('profil-akun.update-info') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nama --}}
                        <div class="space-y-2 sm:col-span-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nama Lengkap <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">badge</span>
                                <input name="name" type="text"
                                       value="{{ old('name', Auth::user()->name) }}"
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border {{ $errors->has('name') ? 'border-red-400' : 'border-slate-200 dark:border-slate-600' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm text-slate-900 dark:text-white"/>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Alamat Email <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                                <input name="email" type="email"
                                       value="{{ old('email', Auth::user()->email) }}"
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-200 dark:border-slate-600' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm text-slate-900 dark:text-white"/>
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nomor HP</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">phone</span>
                                <input name="no_hp" type="tel"
                                       value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                       placeholder="08xxxxxxxxxx"
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm text-slate-900 dark:text-white"/>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit"
                                class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
                            <span class="material-symbols-outlined text-base">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Tab: Ubah Kata Sandi ── --}}
        <div id="tab-password" class="tab-panel hidden">
            {{-- Success --}}
            @if(session('success_password'))
                <div class="mb-5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-500 text-xl shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
                    <p class="text-sm text-green-700 dark:text-green-300 font-medium">{{ session('success_password') }}</p>
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any() && session('tab') === 'password')
                <div class="mb-5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-600 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">error</span>{{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/8 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings:'FILL' 1">lock</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Ubah Kata Sandi</h3>
                            <p class="text-xs text-slate-400">Gunakan kata sandi yang kuat dan berbeda dari sebelumnya.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('profil-akun.update-password') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')

                    {{-- Current password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kata Sandi Saat Ini <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock_open</span>
                            <input id="current-pw" name="current_password" type="password"
                                   placeholder="Masukkan kata sandi saat ini"
                                   class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border {{ $errors->has('current_password') ? 'border-red-400' : 'border-slate-200 dark:border-slate-600' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                            <button type="button" onclick="togglePw('current-pw', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-xs text-red-500 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- New password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kata Sandi Baru <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                            <input id="new-pw" name="password" type="password"
                                   placeholder="Minimal 8 karakter"
                                   class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-200 dark:border-slate-600' }} rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                            <button type="button" onclick="togglePw('new-pw', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>

                        {{-- Strength bar --}}
                        <div id="strength-wrap" class="hidden space-y-1 pt-1">
                            <div class="flex gap-1">
                                <div class="strength-bar h-1.5 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                                <div class="strength-bar h-1.5 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                                <div class="strength-bar h-1.5 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                                <div class="strength-bar h-1.5 flex-1 rounded-full bg-slate-200 transition-all duration-300"></div>
                            </div>
                            <p id="strength-label" class="text-xs text-slate-400"></p>
                        </div>
                    </div>

                    {{-- Confirm password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Konfirmasi Kata Sandi Baru <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock_clock</span>
                            <input id="confirm-pw" name="password_confirmation" type="password"
                                   placeholder="Ulangi kata sandi baru"
                                   class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-sm"/>
                            <button type="button" onclick="togglePw('confirm-pw', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit"
                                class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
                            <span class="material-symbols-outlined text-base">key</span>
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
// ── Tab switching ──
const activeClass   = ['bg-primary', 'text-white', 'shadow-sm'];
const inactiveClass = ['text-slate-500', 'hover:text-slate-700', 'dark:text-slate-400'];

function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove(...activeClass);
        b.classList.add(...inactiveClass);
    });

    document.getElementById('tab-' + tab).classList.remove('hidden');
    const btn = document.getElementById('tab-btn-' + tab);
    btn.classList.add(...activeClass);
    btn.classList.remove(...inactiveClass);
}

// Default / restore tab from session
const activeTab = '{{ session("tab", "info") }}';
switchTab(activeTab);

// ── Toggle password visibility ──
function togglePw(fieldId, btn) {
    const field = document.getElementById(fieldId);
    const icon  = btn.querySelector('.material-symbols-outlined');
    if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        field.type = 'password';
        icon.textContent = 'visibility';
    }
}

// ── Password strength ──
const newPw      = document.getElementById('new-pw');
const swrap      = document.getElementById('strength-wrap');
const bars       = document.querySelectorAll('.strength-bar');
const slabel     = document.getElementById('strength-label');
const levels     = [
    { color: 'bg-red-400',    text: 'Sangat Lemah' },
    { color: 'bg-orange-400', text: 'Lemah' },
    { color: 'bg-yellow-400', text: 'Cukup' },
    { color: 'bg-green-500',  text: 'Kuat' },
];

newPw?.addEventListener('input', function () {
    if (!this.value) { swrap.classList.add('hidden'); return; }
    swrap.classList.remove('hidden');
    let score = 0;
    if (this.value.length >= 8) score++;
    if (/[A-Z]/.test(this.value)) score++;
    if (/[0-9]/.test(this.value)) score++;
    if (/[^A-Za-z0-9]/.test(this.value)) score++;
    bars.forEach((bar, i) => {
        bar.className = 'strength-bar h-1.5 flex-1 rounded-full transition-all duration-300 ' +
            (i < score ? levels[score - 1].color : 'bg-slate-200');
    });
    slabel.textContent = levels[score - 1]?.text ?? '';
});
</script>
@endpush
