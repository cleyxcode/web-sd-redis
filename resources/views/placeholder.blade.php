@extends('layouts.app')

@section('title', ($halaman ?? 'Halaman') . ' - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4 py-20">
    <span class="material-symbols-outlined text-6xl text-primary mb-6">construction</span>
    <h1 class="text-3xl font-bold text-primary mb-4">{{ $halaman ?? 'Halaman Ini' }}</h1>
    <p class="text-slate-500 text-lg mb-8">Halaman ini sedang dalam pengembangan.</p>
    <a href="{{ route('home') }}"
       class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-colors">
        Kembali ke Beranda
    </a>
</div>
@endsection
