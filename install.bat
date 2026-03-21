@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

:: ═══════════════════════════════════════════════════════════════════════════════
::  INSTALL SCRIPT — Sistem Informasi SD Negeri Warialau
::  Platform: Windows (CMD)
::  Kebutuhan: Docker Desktop for Windows (sudah include Docker Compose)
:: ═══════════════════════════════════════════════════════════════════════════════

title SD Negeri Warialau — Docker Installer

echo.
echo  ╔══════════════════════════════════════════════════════╗
echo  ║     Sistem Informasi SD Negeri Warialau              ║
echo  ║     Docker Installer — Windows                       ║
echo  ╚══════════════════════════════════════════════════════╝
echo.

:: ── Cek Docker ────────────────────────────────────────────────────────────────
echo [1/6] Memeriksa instalasi Docker...
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo  [GAGAL] Docker tidak ditemukan!
    echo  Download dari: https://www.docker.com/products/docker-desktop/
    pause
    exit /b 1
)
echo  [OK] Docker ditemukan
docker info >nul 2>&1
if %errorlevel% neq 0 (
    echo  [GAGAL] Docker Desktop belum berjalan. Buka Docker Desktop terlebih dahulu!
    pause
    exit /b 1
)
echo  [OK] Docker Desktop aktif
echo.

:: ── Setup .env ────────────────────────────────────────────────────────────────
echo [2/6] Menyiapkan file konfigurasi .env...
if not exist ".env" (
    if exist ".env.docker" (
        copy .env.docker .env >nul
        echo  [OK] .env dibuat dari .env.docker
    ) else if exist ".env.example" (
        copy .env.example .env >nul
        echo  [PERINGATAN] .env dibuat dari .env.example
    ) else (
        echo  [GAGAL] File .env.docker tidak ditemukan!
        pause
        exit /b 1
    )
) else (
    echo  [OK] .env sudah ada, melewati langkah ini
)

:: Update REDIS_HOST ke nama service Docker
powershell -Command "(Get-Content .env) -replace 'REDIS_HOST=127.0.0.1','REDIS_HOST=redis' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'REDIS_CLIENT=phpredis','REDIS_CLIENT=predis' | Set-Content .env"
echo  [OK] Konfigurasi Redis disesuaikan untuk Docker
echo.

:: ── Siapkan database SQLite ───────────────────────────────────────────────────
echo [3/6] Menyiapkan database SQLite...
if not exist "database\laravel1234" (
    type nul > database\laravel1234
    echo  [OK] File database dibuat: database\laravel1234
) else (
    echo  [OK] Database sudah ada
)
echo.

:: ── Build Docker image ────────────────────────────────────────────────────────
echo [4/6] Build Docker image (mungkin membutuhkan beberapa menit pertama kali)...
docker compose build --no-cache
if %errorlevel% neq 0 (
    echo  [GAGAL] Build Docker image gagal!
    pause
    exit /b 1
)
echo  [OK] Docker image berhasil dibangun
echo.

:: ── Jalankan container ────────────────────────────────────────────────────────
echo [5/6] Menjalankan container...
docker compose up -d
if %errorlevel% neq 0 (
    echo  [GAGAL] Gagal menjalankan container!
    pause
    exit /b 1
)
echo  [OK] Container berjalan
docker compose ps
echo.

:: ── Tunggu container siap ─────────────────────────────────────────────────────
echo  Menunggu container siap (5 detik)...
timeout /t 5 /nobreak >nul

:: ── Setup Laravel ─────────────────────────────────────────────────────────────
echo [6/6] Setup Laravel...

echo  - Generate APP_KEY...
docker compose exec app php artisan key:generate --force
echo  [OK] APP_KEY berhasil

echo  - Menjalankan migration...
docker compose exec app php artisan migrate --force
echo  [OK] Migration selesai

echo  - Menjalankan seeder...
docker compose exec app php artisan db:seed --force
echo  [OK] Seeder selesai

echo  - Membuat storage symlink...
docker compose exec app php artisan storage:link
echo  [OK] Storage symlink dibuat

echo  - Optimasi aplikasi...
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
echo  [OK] Optimasi selesai

echo  - Set permissions...
docker compose exec app chmod -R 775 storage bootstrap/cache
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
echo  [OK] Permissions diset
echo.

:: ── Selesai ───────────────────────────────────────────────────────────────────
echo  ╔══════════════════════════════════════════════════════╗
echo  ║            INSTALASI BERHASIL!                       ║
echo  ╚══════════════════════════════════════════════════════╝
echo.
echo   Website   : http://localhost:8000
echo   Admin     : http://localhost:8000/admin
echo   Email     : admin@admin.com
echo   Password  : admin
echo.
echo   PERINGATAN: Ganti password admin setelah login pertama!
echo.
echo   Perintah berguna:
echo     docker compose stop         -- hentikan container
echo     docker compose start        -- jalankan kembali
echo     docker compose logs -f      -- lihat log
echo     docker compose down -v      -- hapus semua container dan volume
echo.
pause
