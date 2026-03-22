@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
@keyframes confetti-fall {
    0%   { transform: translateY(-20px) rotate(0deg);  opacity: 1; }
    100% { transform: translateY(100px) rotate(720deg); opacity: 0; }
}
.confetti-dot {
    position: absolute;
    border-radius: 2px;
    animation: confetti-fall 2.8s ease-in forwards;
}
@keyframes scaleIn {
    from { opacity:0; transform:scale(.6) rotate(-5deg); }
    to   { opacity:1; transform:scale(1)  rotate(0deg); }
}
.scale-in { animation: scaleIn .6s cubic-bezier(.34,1.56,.64,1) both; }

@keyframes slideUp {
    from { opacity:0; transform:translateY(30px); }
    to   { opacity:1; transform:translateY(0); }
}
.slide-up { animation: slideUp .6s cubic-bezier(.22,1,.36,1) both; }

@keyframes checkmark {
    from { stroke-dashoffset: 100; }
    to   { stroke-dashoffset: 0; }
}
.check-path {
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    animation: checkmark .8s cubic-bezier(.22,1,.36,1) .4s both;
}
</style>
@endpush

@section('content')

{{-- Confetti --}}
<div id="confetti-wrap" class="fixed inset-0 pointer-events-none z-50 overflow-hidden"></div>

<div class="min-h-[85vh] flex items-center justify-center px-4 py-16 bg-cream dark:bg-background-dark">
    <div class="max-w-lg w-full text-center">

        {{-- Success Icon --}}
        <div class="scale-in mb-6" style="animation-delay:.1s">
            <div class="w-28 h-28 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-2xl shadow-emerald-500/30">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="check-path" d="M14 26L22 34L38 18" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <div class="slide-up" style="animation-delay:.45s">
            <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-3 leading-tight">
                Pendaftaran<br/><span class="text-gradient">Berhasil!</span>
            </h1>
            @if(session('nama_anak'))
                <p class="text-lg text-slate-600 dark:text-slate-400 mb-2">
                    Data atas nama <strong class="text-primary dark:text-accent font-black">{{ session('nama_anak') }}</strong> telah kami terima.
                </p>
            @endif
            <p class="text-slate-400 text-sm leading-relaxed mb-8 max-w-sm mx-auto">
                Tim kami akan memverifikasi data dan menghubungi Anda melalui nomor HP yang terdaftar dalam <strong class="text-slate-600 dark:text-slate-300">1–3 hari kerja</strong>.
            </p>
        </div>

        {{-- Steps card --}}
        <div class="slide-up bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 rounded-3xl p-7 mb-8 text-left shadow-sm" style="animation-delay:.6s">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="w-9 h-9 bg-secondary/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary text-base" style="font-variation-settings:'FILL' 1">info</span>
                </div>
                <h3 class="font-display font-black text-slate-800 dark:text-slate-200 text-base">Langkah Selanjutnya</h3>
            </div>
            <div class="space-y-4">
                @foreach([
                    ['notifications_active', 'Tunggu Konfirmasi',  'Tunggu konfirmasi via WhatsApp/telepon ke nomor HP yang Anda daftarkan.'],
                    ['folder_open',          'Siapkan Dokumen',    'Siapkan dokumen asli (Akta Lahir, KK) untuk verifikasi lanjutan.'],
                    ['calendar_month',       'Datang ke Sekolah',  'Datang ke sekolah sesuai jadwal yang akan kami informasikan.'],
                ] as $i => $step)
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5 {{ $i === 0 ? 'bg-primary' : 'bg-primary/8' }}">
                        <span class="material-symbols-outlined text-sm {{ $i === 0 ? 'text-white' : 'text-primary' }}" style="font-variation-settings:'FILL' 1">{{ $step[0] }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $step[1] }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 leading-relaxed mt-0.5">{{ $step[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        <div class="slide-up flex flex-col sm:flex-row gap-3 justify-center" style="animation-delay:.75s">
            <a href="{{ route('pendaftaran.riwayat') }}"
               class="flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/25 hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-base">assignment</span>
                Lihat Riwayat
            </a>
            <a href="{{ route('home') }}"
               class="flex items-center justify-center gap-2 bg-white dark:bg-slate-800 border border-sand dark:border-slate-700 text-slate-700 dark:text-slate-300 px-8 py-3.5 rounded-xl font-bold text-sm hover:border-secondary/40 hover:text-secondary transition-all">
                <span class="material-symbols-outlined text-base">home</span>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
(function(){
    const colors = ['#C9933A','#0D2340','#0B7B8B','#22c55e','#f97316','#ec4899','#3b82f6'];
    const wrap   = document.getElementById('confetti-wrap');
    for (let i = 0; i < 70; i++) {
        const dot = document.createElement('div');
        dot.className = 'confetti-dot';
        dot.style.cssText = `
            left: ${Math.random() * 100}%;
            top:  ${Math.random() * 30}%;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            animation-delay: ${Math.random() * 1.8}s;
            animation-duration: ${2.2 + Math.random() * 1.8}s;
            width:  ${5 + Math.random() * 7}px;
            height: ${5 + Math.random() * 7}px;
            border-radius: ${Math.random() > .5 ? '50%' : '3px'};
        `;
        wrap.appendChild(dot);
    }
    setTimeout(() => { wrap.innerHTML = ''; }, 5000);
})();
</script>
@endpush
