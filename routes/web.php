<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranPublikController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Storage route
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file, 200)->header('Content-Type', $type);
})->where('folder', '.*')->where('filename', '.*');

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/guru', [GuruController::class, 'index'])->name('guru');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/pendaftaran', [PendaftaranPublikController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranPublikController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses', [PendaftaranPublikController::class, 'sukses'])->name('pendaftaran.sukses');

// Auth Publik (Orang Tua)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
