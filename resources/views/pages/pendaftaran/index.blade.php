@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
/* ── Form input styling ── */
.form-input {
    width: 100%;
    padding: .625rem .875rem;
    background: #FAF8F4;
    border: 1.5px solid #E8E2D8;
    border-radius: .75rem;
    font-size: .875rem;
    font-family: "Nunito", sans-serif;
    color: #1e293b;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    outline: none;
}
.form-input:focus {
    border-color: #0B7B8B;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,123,139,.1);
}
.form-input.error { border-color: #ef4444; }
select.form-input { cursor: pointer; }
textarea.form-input { resize: vertical; min-height: 80px; }

/* ── Section card header ── */
.section-header {
    background: linear-gradient(135deg, #0D2340 0%, #0B7B8B 100%);
    padding: 1rem 1.5rem;
    display: flex; align-items: center; gap: .75rem;
}

/* ── Step indicator ── */
.step-dot {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .75rem; font-weight: 900;
    transition: all .3s ease;
}

/* ── Login Required Modal ── */
#login-modal-overlay {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(13,35,64,.65);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: flex; align-items: center; justify-content: center;
    padding: 1rem;
    opacity: 0;
    transition: opacity .35s cubic-bezier(.22,1,.36,1);
}
#login-modal-overlay.show { opacity: 1; }
#login-modal-card {
    transform: translateY(32px) scale(.95);
    transition: transform .4s cubic-bezier(.34,1.56,.64,1), opacity .35s ease;
    opacity: 0;
}
#login-modal-overlay.show #login-modal-card {
    transform: translateY(0) scale(1);
    opacity: 1;
}
</style>
@endpush

@section('content')

{{-- ══ MODAL: Login Diperlukan (tampil otomatis jika tamu) ══ --}}
@if($isGuest)
<div id="login-modal-overlay">
    <div id="login-modal-card" class="w-full max-w-sm bg-white dark:bg-slate-900 rounded-3xl shadow-2xl overflow-hidden">

        {{-- Header gelap dengan icon --}}
        <div class="relative bg-gradient-to-br from-primary to-secondary px-8 py-8 text-white text-center overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-accent/10 rounded-full pointer-events-none"></div>

            {{-- Icon kunci --}}
            <div class="relative z-10 w-16 h-16 bg-white/10 border-2 border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl">
                <span class="material-symbols-outlined text-3xl text-accent" style="font-variation-settings:'FILL' 1">lock</span>
            </div>
            <h2 class="font-display text-2xl font-black relative z-10">Login Diperlukan</h2>
            <p class="text-white/65 text-sm mt-1 relative z-10">untuk mendaftar siswa baru</p>
        </div>

        {{-- Body --}}
        <div class="px-8 py-7">
            <p class="text-slate-500 dark:text-slate-400 text-sm text-center leading-relaxed mb-6">
                Anda harus <strong class="text-primary dark:text-accent font-bold">login</strong> terlebih dahulu sebelum mengisi formulir pendaftaran siswa baru.
            </p>

            {{-- Tombol Login --}}
            <a href="{{ route('login') }}?redirect={{ urlencode(route('pendaftaran')) }}"
               class="flex items-center justify-center gap-2 w-full bg-primary hover:bg-primary/90 active:scale-95 text-white font-black py-3.5 rounded-xl text-sm transition-all shadow-lg shadow-primary/25 mb-3">
                <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">login</span>
                Masuk ke Akun Saya
            </a>

            {{-- Tombol Daftar --}}
            <a href="{{ route('register') }}"
               class="flex items-center justify-center gap-2 w-full border-2 border-primary/20 hover:border-primary/50 hover:bg-primary/5 text-primary dark:text-accent font-bold py-3.5 rounded-xl text-sm transition-all">
                <span class="material-symbols-outlined text-base">person_add</span>
                Buat Akun Baru
            </a>

            {{-- Separator --}}
            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-sand dark:bg-slate-700"></div>
                <span class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">atau</span>
                <div class="flex-1 h-px bg-sand dark:bg-slate-700"></div>
            </div>

            <a href="{{ route('home') }}"
               class="flex items-center justify-center gap-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endif

{{-- Hero --}}
<section class="bg-white dark:bg-slate-950 border-b border-sand dark:border-slate-800 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 mb-4 text-xs font-bold text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-accent">Pendaftaran</span>
        </div>
        <span class="section-eyebrow mb-3 inline-flex">
            <span class="material-symbols-outlined text-sm">how_to_reg</span>
            PPDB Online
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-3 reveal">
            Pendaftaran <span class="text-gradient">Siswa Baru</span>
        </h1>
        <p class="text-slate-500 dark:text-slate-400 text-base max-w-xl reveal" style="transition-delay:.1s">
            {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }} membuka pendaftaran siswa baru. Isi formulir dengan lengkap dan benar.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">

    @if(!$infoPendaftaran)
    {{-- Pendaftaran Tutup --}}
    <div class="max-w-xl mx-auto text-center py-20 reveal">
        <div class="w-24 h-24 bg-primary/8 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <span class="material-symbols-outlined text-5xl text-primary/40">event_busy</span>
        </div>
        <h2 class="font-display text-2xl font-black text-slate-700 dark:text-slate-300 mb-3">
            Pendaftaran Belum Dibuka
        </h2>
        <p class="text-slate-400 text-sm leading-relaxed mb-8">
            Saat ini pendaftaran siswa baru belum dibuka. Pantau terus informasi terbaru dari kami melalui berita dan pengumuman.
        </p>
        <a href="{{ route('berita') }}"
           class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/25 transition-all hover:scale-105">
            <span class="material-symbols-outlined text-base">newspaper</span>
            Lihat Berita & Pengumuman
        </a>
    </div>

    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Sidebar Info --}}
        <aside class="lg:col-span-1 order-2 lg:order-1">
            <div class="sticky top-24 space-y-5">

                {{-- Status Badge --}}
                <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50 rounded-2xl p-5 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-24 h-24 bg-emerald-400/10 rounded-full"></div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-emerald-700 dark:text-emerald-400 font-black text-xs uppercase tracking-wider">
                            Pendaftaran Dibuka
                        </span>
                    </div>
                    <p class="font-display text-2xl font-black text-emerald-800 dark:text-emerald-300">
                        TA {{ $infoPendaftaran->tahun_ajaran }}
                    </p>
                </div>

                {{-- Detail Info --}}
                <div class="bg-white dark:bg-slate-900 border border-sand dark:border-slate-800 rounded-2xl p-5 space-y-4 shadow-sm">
                    <h3 class="font-display font-black text-slate-900 dark:text-white text-base flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-accent rounded-full"></span>
                        Info Pendaftaran
                    </h3>
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-secondary/10 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-secondary text-base" style="font-variation-settings:'FILL' 1">calendar_today</span>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Tanggal Buka</p>
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">
                                {{ \Carbon\Carbon::parse($infoPendaftaran->tanggal_buka)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-red-50 dark:bg-red-900/20 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-red-500 text-base" style="font-variation-settings:'FILL' 1">event_busy</span>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Tanggal Tutup</p>
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">
                                {{ \Carbon\Carbon::parse($infoPendaftaran->tanggal_tutup)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary/8 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings:'FILL' 1">group_add</span>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Kuota Tersedia</p>
                            <p class="font-black text-slate-800 dark:text-slate-200 text-lg font-display">{{ $infoPendaftaran->kuota }} <span class="text-sm font-semibold text-slate-400">siswa</span></p>
                        </div>
                    </div>
                </div>

                {{-- Persyaratan --}}
                @if($infoPendaftaran->syarat)
                <div class="bg-accent/8 border border-accent/25 rounded-2xl p-5">
                    <h3 class="font-display font-black text-slate-900 dark:text-white text-sm mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-accent text-base" style="font-variation-settings:'FILL' 1">checklist</span>
                        Persyaratan
                    </h3>
                    <ul class="space-y-2">
                        @foreach(array_filter(array_map('trim', explode("\n", $infoPendaftaran->syarat))) as $syarat)
                        <li class="flex gap-2.5 items-start">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span>
                            <span class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">{{ $syarat }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Riwayat link --}}
                @auth
                <a href="{{ route('pendaftaran.riwayat') }}"
                   class="flex items-center justify-between bg-primary/8 hover:bg-primary/12 dark:bg-primary/20 dark:hover:bg-primary/30 border border-primary/15 rounded-2xl p-4 transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-base">assignment</span>
                        <span class="text-sm font-bold text-primary dark:text-accent">Riwayat Pendaftaran</span>
                    </div>
                    <span class="material-symbols-outlined text-primary/50 group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                </a>
                @endauth

            </div>
        </aside>

        {{-- Form --}}
        <div class="lg:col-span-2 order-1 lg:order-2">

            {{-- Error messages --}}
            @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-2xl p-5">
                <div class="flex items-center gap-2.5 text-red-700 dark:text-red-400 font-bold mb-3 text-sm">
                    <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">error</span>
                    Harap perbaiki kesalahan berikut:
                </div>
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-xs text-red-600 dark:text-red-400 flex items-start gap-1.5">
                            <span class="material-symbols-outlined text-xs mt-0.5">chevron_right</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- ── Data Anak ── --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 overflow-hidden shadow-sm reveal">
                    <div class="section-header">
                        <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-lg" style="font-variation-settings:'FILL' 1">child_care</span>
                        </div>
                        <div>
                            <h2 class="font-display text-white font-black text-base">Data Anak</h2>
                            <p class="text-white/55 text-xs">Isi data lengkap calon siswa</p>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                                Nama Lengkap Anak <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_anak" value="{{ old('nama_anak') }}"
                                   class="form-input {{ $errors->has('nama_anak') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Nama lengkap sesuai akta lahir"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Kota/Kabupaten"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                   class="form-input {{ $errors->has('tanggal_lahir') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin"
                                    class="form-input {{ $errors->has('jenis_kelamin') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white">
                                <option value="">— Pilih —</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                                Agama <span class="text-red-500">*</span>
                            </label>
                            <select name="agama"
                                    class="form-input {{ $errors->has('agama') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white">
                                <option value="">— Pilih —</option>
                                @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Anak Ke-</label>
                            <input type="number" name="anak_ke" value="{{ old('anak_ke') }}" min="1"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Contoh: 1"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Asal TK / PAUD</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Nama TK/PAUD sebelumnya"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">NIK Anak</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="16 digit NIK"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nomor KK</label>
                            <input type="text" name="no_kk" value="{{ old('no_kk') }}" maxlength="16"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="16 digit Nomor KK"/>
                        </div>
                    </div>
                </div>

                {{-- ── Alamat ── --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 overflow-hidden shadow-sm reveal" style="transition-delay:.06s">
                    <div class="section-header">
                        <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-lg" style="font-variation-settings:'FILL' 1">location_on</span>
                        </div>
                        <div>
                            <h2 class="font-display text-white font-black text-base">Alamat Tempat Tinggal</h2>
                            <p class="text-white/55 text-xs">Alamat domisili saat ini</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat" rows="3"
                                  class="form-input {{ $errors->has('alamat') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                  placeholder="Jalan, RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten/Kota">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                {{-- ── Data Orang Tua ── --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 overflow-hidden shadow-sm reveal" style="transition-delay:.1s">
                    <div class="section-header">
                        <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-lg" style="font-variation-settings:'FILL' 1">family_restroom</span>
                        </div>
                        <div>
                            <h2 class="font-display text-white font-black text-base">Data Orang Tua / Wali</h2>
                            <p class="text-white/55 text-xs">Informasi kontak dan keluarga</p>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Nama lengkap ayah"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Petani, Nelayan, PNS..."/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Nama lengkap ibu"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Ibu Rumah Tangga, Pedagang..."/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama Wali (jika ada)</label>
                            <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                                   class="form-input dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="Nama wali jika berbeda"/>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                                No. HP Aktif <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                                   class="form-input {{ $errors->has('no_hp') ? 'error' : '' }} dark:bg-slate-800 dark:border-slate-700 dark:text-white"
                                   placeholder="0812 3456 7890"/>
                        </div>
                    </div>
                </div>

                {{-- ── Upload Dokumen ── --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-sand dark:border-slate-800 overflow-hidden shadow-sm reveal" style="transition-delay:.14s">
                    <div class="section-header">
                        <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-lg" style="font-variation-settings:'FILL' 1">upload_file</span>
                        </div>
                        <div>
                            <h2 class="font-display text-white font-black text-base">Upload Dokumen</h2>
                            <p class="text-white/55 text-xs">Opsional — PDF/JPG/PNG, maks. 2MB</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <label id="drop-zone"
                               class="block border-2 border-dashed border-sand dark:border-slate-700 rounded-xl p-8 text-center cursor-pointer hover:border-secondary/50 hover:bg-secondary/3 transition-all group">
                            <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600 block mb-3 group-hover:text-secondary transition-colors">cloud_upload</span>
                            <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Klik atau seret file ke sini</p>
                            <p class="text-xs text-slate-400">Akta Kelahiran, KK, atau dokumen lain yang diminta</p>
                            <input type="file" name="dokumen" accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                   onchange="updateFileName(this)"/>
                        </label>
                        <p id="file-name" class="text-xs text-secondary font-bold mt-2 hidden"></p>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex flex-col sm:flex-row items-center gap-4 pt-2 reveal" style="transition-delay:.18s">
                    <button type="submit"
                            class="w-full sm:w-auto bg-accent hover:bg-accent/90 text-primary px-10 py-4 rounded-xl font-black text-base transition-all shadow-lg shadow-accent/20 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xl">send</span>
                        Kirim Pendaftaran
                    </button>
                    <p class="text-xs text-slate-400 text-center sm:text-left max-w-xs leading-relaxed">
                        Dengan mengirim formulir ini, Anda menyatakan data yang diisi adalah benar dan dapat dipertanggungjawabkan.
                    </p>
                </div>

            </form>
        </div>
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
function updateFileName(input) {
    const el = document.getElementById('file-name');
    if (input.files.length > 0) {
        el.textContent = '📎 ' + input.files[0].name;
        el.classList.remove('hidden');
    }
}
// Click drop zone label
document.getElementById('drop-zone')?.addEventListener('click', function() {
    this.querySelector('input[type=file]').click();
});

// ── Login Required Modal ──
@if($isGuest)
(function () {
    const overlay = document.getElementById('login-modal-overlay');
    if (!overlay) return;

    // Blur konten halaman di belakang modal
    const mainEl = document.querySelector('main');
    if (mainEl) {
        mainEl.style.filter = 'blur(4px)';
        mainEl.style.pointerEvents = 'none';
        mainEl.style.userSelect = 'none';
    }

    // Tampilkan modal dengan animasi setelah 120ms
    requestAnimationFrame(() => {
        setTimeout(() => overlay.classList.add('show'), 120);
    });

    // Cegah scroll halaman
    document.body.style.overflow = 'hidden';
})();
@endif
</script>
@endpush
