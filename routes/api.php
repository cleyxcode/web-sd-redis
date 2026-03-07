<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProfilSekolahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — SD Negeri Warialau
|--------------------------------------------------------------------------
| Base URL: /api/v1
| Auth: Laravel Sanctum (Bearer Token)
*/

Route::prefix('v1')->group(function () {

    // ── Public ──────────────────────────────────────────────────────
    Route::get('profil-sekolah', [ProfilSekolahController::class, 'profil']);
    Route::get('banner',         [ProfilSekolahController::class, 'banner']);
    Route::get('guru',           [GuruController::class, 'index']);
    Route::get('berita',         [BeritaController::class, 'index']);
    Route::get('berita/{id}',    [BeritaController::class, 'show']);
    Route::get('galeri',         [GaleriController::class, 'index']);
    Route::get('info-pendaftaran', [PendaftaranController::class, 'infoAktif']);

    // ── Auth ─────────────────────────────────────────────────────────
    Route::prefix('auth')->group(function () {
        Route::post('register',       [AuthController::class, 'register']);
        Route::post('login',          [AuthController::class, 'login']);
        Route::post('forgot-password',[AuthController::class, 'sendOtp']);
        Route::post('verify-otp',     [AuthController::class, 'verifyOtp']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    // ── Protected (auth:sanctum) ──────────────────────────────────────
    Route::middleware('auth:sanctum')->group(function () {
        // Profil user
        Route::get  ('profile',          [ProfileController::class, 'show']);
        Route::patch('profile/info',      [ProfileController::class, 'updateInfo']);
        Route::patch('profile/password',  [ProfileController::class, 'updatePassword']);

        // Pendaftaran
        Route::post('pendaftaran',          [PendaftaranController::class, 'store']);
        Route::get ('pendaftaran/riwayat',  [PendaftaranController::class, 'riwayat']);
        Route::get ('pendaftaran/{id}',     [PendaftaranController::class, 'show']);
    });
});
