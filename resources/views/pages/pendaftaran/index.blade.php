@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Hero Section --}}
<section class="bg-white dark:bg-slate-900 py-12 border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-slate-200">Pendaftaran</span>
        </div>
        <h1 class="text-4xl font-black text-primary dark:text-slate-100 mb-2">
            Pendaftaran Siswa Baru
        </h1>
        <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl">
            {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }} membuka pendaftaran siswa baru. Isi formulir di bawah ini dengan lengkap dan benar.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if(!$infoPendaftaran)
        {{-- Pendaftaran Tutup --}}
        <div class="max-w-2xl mx-auto text-center py-20">
            <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-slate-400">event_busy</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-4">
                Pendaftaran Belum Dibuka
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8">
                Saat ini pendaftaran siswa baru belum dibuka. Pantau terus informasi terbaru dari kami.
            </p>
            <a href="{{ route('berita') }}"
               class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined">newspaper</span>
                Lihat Berita & Pengumuman
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Info Pendaftaran (Sidebar) --}}
            <aside class="lg:col-span-1 order-2 lg:order-1">
                <div class="sticky top-24 space-y-5">

                    {{-- Status Badge --}}
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-5">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-green-700 dark:text-green-400 font-bold text-sm uppercase tracking-wider">
                                Pendaftaran Dibuka
                            </span>
                        </div>
                        <p class="text-2xl font-black text-green-800 dark:text-green-300">
                            Tahun Ajaran {{ $infoPendaftaran->tahun_ajaran }}
                        </p>
                    </div>

                    {{-- Detail Info --}}
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 space-y-4">
                        <h3 class="font-bold text-slate-900 dark:text-white text-lg">Informasi Pendaftaran</h3>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">calendar_today</span>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Tanggal Buka</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200">
                                    {{ \Carbon\Carbon::parse($infoPendaftaran->tanggal_buka)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-red-500 text-xl mt-0.5">event_busy</span>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Tanggal Tutup</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200">
                                    {{ \Carbon\Carbon::parse($infoPendaftaran->tanggal_tutup)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">group_add</span>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Kuota Tersedia</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $infoPendaftaran->kuota }} Siswa
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Syarat --}}
                    @if($infoPendaftaran->syarat)
                        <div class="bg-accent/10 border border-accent/30 rounded-2xl p-5">
                            <h3 class="font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-accent">checklist</span>
                                Persyaratan
                            </h3>
                            <div class="text-sm text-slate-700 dark:text-slate-300 space-y-1 leading-relaxed">
                                @foreach(array_filter(array_map('trim', explode("\n", $infoPendaftaran->syarat))) as $syarat)
                                    <div class="flex gap-2">
                                        <span class="text-accent font-bold shrink-0">•</span>
                                        <span>{{ $syarat }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </aside>

            {{-- Form Pendaftaran --}}
            <div class="lg:col-span-2 order-1 lg:order-2">

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                        <div class="flex items-center gap-2 text-red-700 dark:text-red-400 font-bold mb-2">
                            <span class="material-symbols-outlined">error</span>
                            Harap perbaiki kesalahan berikut:
                        </div>
                        <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                      class="space-y-8">
                    @csrf

                    {{-- Section: Data Anak --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
                        <div class="bg-primary px-6 py-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-white">child_care</span>
                            <h2 class="text-white font-bold text-lg">Data Anak</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Nama Lengkap Anak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_anak" value="{{ old('nama_anak') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Nama lengkap sesuai akta lahir"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Tempat Lahir
                                </label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Kota/Kabupaten"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis_kelamin"
                                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Agama <span class="text-red-500">*</span>
                                </label>
                                <select name="agama"
                                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                        <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Anak Ke-
                                </label>
                                <input type="number" name="anak_ke" value="{{ old('anak_ke') }}" min="1"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Contoh: 1"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Asal Sekolah / TK
                                </label>
                                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Nama TK/PAUD sebelumnya"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    NIK Anak
                                </label>
                                <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="16 digit NIK"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Nomor KK
                                </label>
                                <input type="text" name="no_kk" value="{{ old('no_kk') }}" maxlength="16"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="16 digit Nomor KK"/>
                            </div>

                        </div>
                    </div>

                    {{-- Section: Alamat --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
                        <div class="bg-primary px-6 py-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-white">location_on</span>
                            <h2 class="text-white font-bold text-lg">Alamat Tempat Tinggal</h2>
                        </div>
                        <div class="p-6">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="3"
                                      class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                      placeholder="Jalan, RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten/Kota">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    {{-- Section: Data Orang Tua --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
                        <div class="bg-primary px-6 py-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-white">family_restroom</span>
                            <h2 class="text-white font-bold text-lg">Data Orang Tua / Wali</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Nama Ayah
                                </label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Nama lengkap ayah"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Pekerjaan Ayah
                                </label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Contoh: Petani, Nelayan, PNS"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Nama Ibu
                                </label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Nama lengkap ibu"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Pekerjaan Ibu
                                </label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Contoh: Ibu Rumah Tangga, Pedagang"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    Nama Wali (jika ada)
                                </label>
                                <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Nama wali jika berbeda dengan orang tua"/>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                    No. HP Aktif <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                                       class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm"
                                       placeholder="Contoh: 08123456789"/>
                            </div>

                        </div>
                    </div>

                    {{-- Section: Dokumen --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
                        <div class="bg-primary px-6 py-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-white">upload_file</span>
                            <h2 class="text-white font-bold text-lg">Upload Dokumen</h2>
                        </div>
                        <div class="p-6">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Dokumen Pendukung
                                <span class="text-slate-400 font-normal">(Opsional — PDF/JPG/PNG, maks. 2MB)</span>
                            </label>
                            <div class="border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl p-6 text-center hover:border-primary transition-colors">
                                <span class="material-symbols-outlined text-4xl text-slate-400 mb-2 block">upload_file</span>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                                    Unggah Akta Kelahiran, KK, atau dokumen lain yang diminta
                                </p>
                                <input type="file" name="dokumen" accept=".pdf,.jpg,.jpeg,.png"
                                       class="text-sm text-slate-600 dark:text-slate-400
                                              file:mr-4 file:py-2 file:px-4 file:rounded-lg
                                              file:border-0 file:text-sm file:font-bold
                                              file:bg-primary file:text-white
                                              hover:file:bg-primary/90 file:cursor-pointer"/>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                        <button type="submit"
                                class="w-full sm:w-auto bg-accent hover:bg-accent/90 text-primary px-10 py-4 rounded-xl font-black text-lg transition-all shadow-lg shadow-accent/20 hover:scale-105 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">send</span>
                            Kirim Pendaftaran
                        </button>
                        <p class="text-xs text-slate-400 text-center sm:text-left">
                            Dengan mengirim formulir ini, Anda menyetujui data yang diisi adalah benar dan dapat dipertanggungjawabkan.
                        </p>
                    </div>

                </form>
            </div>

        </div>
    @endif

</div>

@endsection
