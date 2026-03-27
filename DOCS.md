# DOCS.md — Sistem Informasi SD Negeri Warialau
# Bredcly Fransiscus Tuhuleruw (12155201220021) — UKIM Ambon 2026

---

## 1. GAMBARAN UMUM SISTEM

Sistem Informasi SD Negeri Warialau adalah aplikasi berbasis web dan mobile yang dibangun untuk menjawab kebutuhan digital sekolah. Sistem ini terdiri dari tiga komponen utama yang saling terintegrasi:

| Komponen | Teknologi | Fungsi |
|---|---|---|
| Panel Admin | Laravel 12 + Filament v3.3 | Pengelolaan seluruh data oleh operator |
| Website Pengunjung | Laravel 12 + Blade + Tailwind CSS | Akses informasi publik oleh masyarakat/orang tua |
| REST API | Laravel 12 + Sanctum | Sumber data untuk aplikasi mobile Flutter |

### Stack Teknologi

| Layer | Teknologi |
|---|---|
| Backend Framework | Laravel 12 |
| Admin Panel | Filament v3.3 |
| Template Engine (Web) | Blade + Tailwind CSS |
| Database | MySQL |
| Cache | Redis 7 |
| Autentikasi API | Laravel Sanctum (Bearer Token) |
| HTTP Client (Mobile) | Dio (Flutter) |
| Containerisasi | Docker (PHP 8.2-FPM, Nginx 1.25, Redis 7) |
| Email | SMTP (OTP reset password) |

---

## 2. ARSITEKTUR SISTEM

### 2.1 Dua Jalur Arsitektur yang Berbeda

Sistem ini menerapkan dua jalur alur data yang berbeda sesuai platform:

#### Jalur Web Pengunjung (Browser → Blade)
```
Browser
  └── Router (routes/web.php)
        └── Web Controller (app/Http/Controllers/)
              └── Eloquent Model (langsung)
                    └── MySQL
```
Web Controller mengakses Eloquent Model secara langsung tanpa Service/Repository. Ini sesuai prinsip kesederhanaan untuk halaman server-side rendering.

#### Jalur API (Flutter → JSON)
```
Flutter/HTTP Client
  └── Router (routes/api.php)
        └── API Controller (app/Http/Controllers/Api/)
              └── Service Layer (app/Services/)
                    ├── Redis Cache (Cache::remember)
                    └── Repository (app/Repositories/)
                          └── Eloquent Model
                                └── MySQL
```
API Controller menggunakan Service Layer + Repository Pattern untuk memisahkan logika bisnis dari akses data, serta memanfaatkan Redis caching untuk performa optimal.

### 2.2 Struktur Folder Lengkap

```
app/
├── Enums/
│   ├── StatusAktif.php           ← Enum status aktif/nonaktif
│   ├── StatusPendaftaran.php     ← Enum pending/diterima/ditolak
│   └── StatusSiswa.php           ← Enum aktif/nonaktif/lulus
│
├── Filament/
│   ├── Resources/                ← 11 Resource admin panel
│   └── Widgets/
│       └── StatsOverviewWidget.php ← Kartu statistik dashboard
│
├── Http/
│   ├── Controllers/
│   │   ├── Api/                  ← API Controller (untuk Flutter)
│   │   │   ├── AuthController.php
│   │   │   ├── BeritaController.php
│   │   │   ├── GaleriController.php
│   │   │   ├── GuruController.php
│   │   │   ├── NotifikasiController.php
│   │   │   ├── PendaftaranController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ProfilSekolahController.php
│   │   ├── Auth/                 ← Auth web (login/register/OTP)
│   │   │   ├── AuthController.php
│   │   │   └── ForgotPasswordController.php
│   │   ├── AplikasiController.php        ← Halaman download APK
│   │   ├── BeritaController.php          ← Daftar & detail berita (web)
│   │   ├── GaleriController.php          ← Galeri foto (web)
│   │   ├── GuruController.php            ← Data guru (web)
│   │   ├── HomeController.php            ← Halaman beranda
│   │   ├── PendaftaranPublikController.php ← Form pendaftaran online
│   │   ├── ProfilAkunController.php      ← Profil akun pengguna
│   │   └── ProfilController.php          ← Profil sekolah (web)
│   └── ...
│
├── Mail/
│   └── OtpMail.php               ← Email OTP reset password
│
├── Models/
│   ├── Aplikasi.php
│   ├── Banner.php
│   ├── Berita.php
│   ├── Galeri.php
│   ├── Guru.php
│   ├── InfoPendaftaran.php
│   ├── Notifikasi.php
│   ├── OtpCode.php
│   ├── Pendaftaran.php
│   ├── ProfilSekolah.php
│   ├── Setting.php
│   ├── Siswa.php
│   └── User.php
│
├── Observers/
│   ├── BeritaObserver.php        ← Invalidasi cache + kirim notifikasi saat publish
│   └── PendaftaranObserver.php   ← Kirim notifikasi saat status berubah
│
├── Providers/
│   ├── AppServiceProvider.php          ← Registrasi Observer + View Composer
│   ├── RepositoryServiceProvider.php   ← Binding Interface → Implementasi
│   └── Filament/
│
├── Repositories/
│   ├── Contracts/                ← Interface/Kontrak (9 interface)
│   │   ├── BannerRepositoryInterface.php
│   │   ├── BeritaRepositoryInterface.php
│   │   ├── GaleriRepositoryInterface.php
│   │   ├── GuruRepositoryInterface.php
│   │   ├── InfoPendaftaranRepositoryInterface.php
│   │   ├── NotifikasiRepositoryInterface.php
│   │   ├── PendaftaranRepositoryInterface.php
│   │   ├── ProfilSekolahRepositoryInterface.php
│   │   └── UserRepositoryInterface.php
│   └── Eloquent/                 ← Implementasi konkret (9 kelas)
│       ├── BannerRepository.php
│       ├── BeritaRepository.php
│       ├── GaleriRepository.php
│       ├── GuruRepository.php
│       ├── InfoPendaftaranRepository.php
│       ├── NotifikasiRepository.php
│       ├── PendaftaranRepository.php
│       ├── ProfilSekolahRepository.php
│       └── UserRepository.php
│
└── Services/                     ← Service Layer (khusus API)
    ├── AlertBoxService.php       ← Alert dashboard admin (static helper)
    ├── AuthService.php           ← Registrasi, login, OTP, reset password
    ├── BeritaService.php         ← Berita + Redis caching
    ├── GaleriService.php         ← Galeri foto
    ├── GuruService.php           ← Data guru + Redis caching
    ├── NotifikasiService.php     ← Pengelolaan notifikasi user
    ├── PendaftaranService.php    ← Logika pendaftaran siswa baru
    ├── ProfileService.php        ← Profil pengguna (update info/password)
    └── ProfilSekolahService.php  ← Profil sekolah + Banner + Redis caching
```

---

## 3. DATABASE — 17 TABEL

### Tabel Utama

#### `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| name | VARCHAR | Nama pengguna |
| email | VARCHAR UNIQUE | Email login |
| password | VARCHAR | Password (bcrypt) |
| role | VARCHAR | `admin` / `orangtua` |
| no_hp | VARCHAR NULL | Nomor HP |
| remember_token | VARCHAR NULL | Token remember me |
| timestamps | — | created_at, updated_at |

#### `profil_sekolah`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| nama_sekolah | VARCHAR | Nama resmi sekolah |
| kepala_sekolah | VARCHAR NULL | Nama kepala sekolah |
| akreditasi | VARCHAR NULL | A / B / C |
| tahun_berdiri | VARCHAR NULL | Tahun pendirian |
| jumlah_ruang_kelas | INT NULL | Jumlah kelas |
| visi | TEXT NULL | Visi sekolah |
| misi | TEXT NULL | Misi sekolah |
| sejarah | TEXT NULL | Sejarah sekolah |
| alamat | TEXT NULL | Alamat lengkap |
| kontak | VARCHAR NULL | Nomor kontak |
| logo | VARCHAR NULL | Path file logo |
| timestamps | — | created_at, updated_at |

#### `guru`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| nama | VARCHAR | Nama guru |
| nip | VARCHAR NULL | NIP |
| jabatan | VARCHAR NULL | Jabatan |
| mata_pelajaran | VARCHAR NULL | Mata pelajaran |
| no_hp | VARCHAR NULL | Nomor HP |
| foto | VARCHAR NULL | Path foto |
| status | VARCHAR | `aktif` / `nonaktif` |
| deleted_at | TIMESTAMP NULL | Soft delete |
| timestamps | — | created_at, updated_at |

#### `siswa`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| nama | VARCHAR | Nama siswa |
| nis | VARCHAR NULL | NIS |
| kelas | VARCHAR NULL | Kelas |
| jenis_kelamin | VARCHAR NULL | `L` / `P` |
| tahun_ajaran | VARCHAR NULL | Tahun ajaran |
| foto | VARCHAR NULL | Path foto |
| status | VARCHAR | `aktif` / `nonaktif` / `lulus` |
| deleted_at | TIMESTAMP NULL | Soft delete |
| timestamps | — | created_at, updated_at |

#### `berita`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| user_id | FK → users | Admin pembuat |
| judul | VARCHAR | Judul berita |
| isi | LONGTEXT | Konten berita (rich text) |
| gambar | VARCHAR NULL | Path gambar |
| kategori | VARCHAR NULL | Kategori berita |
| tanggal_publish | DATE NULL | Tanggal terbit |
| status | VARCHAR | `draft` / `publish` |
| deleted_at | TIMESTAMP NULL | Soft delete |
| timestamps | — | created_at, updated_at |

#### `galeri`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| user_id | FK → users | Admin pengunggah |
| judul | VARCHAR | Judul foto |
| foto | VARCHAR | Path foto |
| keterangan | TEXT NULL | Keterangan foto |
| deleted_at | TIMESTAMP NULL | Soft delete |
| timestamps | — | created_at, updated_at |

#### `info_pendaftaran`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| user_id | FK → users | Admin pembuat |
| tahun_ajaran | VARCHAR | Contoh: 2026/2027 |
| tanggal_buka | DATE | Tanggal pembukaan |
| tanggal_tutup | DATE | Tanggal penutupan |
| kuota | INT | Jumlah kuota siswa |
| syarat | TEXT NULL | Syarat pendaftaran |
| status | VARCHAR | `aktif` / `nonaktif` |
| timestamps | — | created_at, updated_at |

#### `pendaftaran`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| user_id | FK → users | Orang tua pendaftar |
| info_pendaftaran_id | FK → info_pendaftaran | Periode pendaftaran |
| nama_anak | VARCHAR | Nama anak yang didaftarkan |
| tempat_lahir | VARCHAR NULL | Tempat lahir anak |
| tanggal_lahir | DATE | Tanggal lahir anak |
| jenis_kelamin | VARCHAR | `L` / `P` |
| agama | VARCHAR | Agama |
| anak_ke | INT NULL | Anak ke- |
| asal_sekolah | VARCHAR NULL | Asal TK/PAUD |
| nik | VARCHAR NULL | NIK anak |
| no_kk | VARCHAR NULL | Nomor KK |
| alamat | TEXT | Alamat lengkap |
| nama_ayah | VARCHAR NULL | Nama ayah |
| pekerjaan_ayah | VARCHAR NULL | Pekerjaan ayah |
| nama_ibu | VARCHAR NULL | Nama ibu |
| pekerjaan_ibu | VARCHAR NULL | Pekerjaan ibu |
| nama_wali | VARCHAR NULL | Nama wali (jika ada) |
| no_hp | VARCHAR | Nomor HP yang bisa dihubungi |
| dokumen | VARCHAR NULL | Path file dokumen (pdf/jpg) |
| status | VARCHAR | `pending` / `diterima` / `ditolak` |
| timestamps | — | created_at, updated_at |

#### `banner`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| judul | VARCHAR | Judul banner |
| gambar | VARCHAR | Path gambar |
| urutan | INT | Urutan tampil (sortable) |
| status | VARCHAR | `aktif` / `nonaktif` |
| timestamps | — | created_at, updated_at |

#### `settings`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| key | VARCHAR UNIQUE | Kunci pengaturan |
| value | TEXT NULL | Nilai pengaturan |
| type | VARCHAR | `text` / `image` / `url` |
| timestamps | — | created_at, updated_at |

#### `notifikasi`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| user_id | FK → users | Penerima notifikasi |
| judul | VARCHAR | Judul notifikasi |
| pesan | TEXT | Isi pesan |
| tipe | VARCHAR | `berita` / `pendaftaran` |
| referensi_id | BIGINT NULL | ID berita atau pendaftaran terkait |
| dibaca | BOOLEAN | Status baca (default: false) |
| timestamps | — | created_at, updated_at |

#### `aplikasi`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | BIGINT AI | Primary key |
| nama_aplikasi | VARCHAR | Nama versi aplikasi |
| versi | VARCHAR | Nomor versi (contoh: 1.0.0) |
| deskripsi | TEXT NULL | Deskripsi perubahan versi |
| link_download | VARCHAR | URL tautan unduhan APK |
| ukuran_file | VARCHAR NULL | Ukuran file APK |
| status | VARCHAR | `aktif` / `nonaktif` |
| timestamps | — | created_at, updated_at |

### Tabel Pendukung

| Tabel | Fungsi |
|---|---|
| `otp_codes` | Penyimpanan kode OTP untuk fitur lupa password (email, otp, expires_at, used) |
| `personal_access_tokens` | Token Sanctum untuk autentikasi API mobile |
| `media` | Spatie Media Library — manajemen file media (gambar dokumen pendaftaran) |
| `cache` | Laravel cache driver berbasis database/Redis |
| `jobs` | Antrian pekerjaan Laravel Queue |

---

## 4. HALAMAN WEB PENGUNJUNG

### Rute & Controller

| Route | Controller | Autentikasi | Fungsi |
|---|---|---|---|
| `GET /` | HomeController@index | Publik | Halaman beranda |
| `GET /profil` | ProfilController@index | Publik | Profil sekolah |
| `GET /guru` | GuruController@index | Publik | Data guru |
| `GET /berita` | BeritaController@index | Publik | Daftar berita |
| `GET /berita/{id}` | BeritaController@show | Publik | Detail berita |
| `GET /galeri` | GaleriController@index | Publik | Galeri foto |
| `GET /pendaftaran` | PendaftaranPublikController@index | Publik (modal login jika tamu) | Info & form pendaftaran |
| `POST /pendaftaran` | PendaftaranPublikController@store | **Wajib Login** | Kirim form pendaftaran |
| `GET /pendaftaran/sukses` | PendaftaranPublikController@sukses | — | Halaman konfirmasi sukses |
| `GET /pendaftaran/riwayat` | PendaftaranPublikController@riwayat | **Wajib Login** | Riwayat pendaftaran |
| `GET /pendaftaran/riwayat/{id}` | PendaftaranPublikController@detail | **Wajib Login** | Detail pendaftaran |
| `GET /download-aplikasi` | AplikasiController@index | Publik | Halaman unduh APK Android |
| `GET /download-aplikasi/{id}` | AplikasiController@download | Publik | Redirect ke link unduhan APK |
| `GET /profil-akun` | ProfilAkunController@index | **Wajib Login** | Halaman profil akun |
| `PATCH /profil-akun/info` | ProfilAkunController@updateInfo | **Wajib Login** | Update nama/no HP |
| `PATCH /profil-akun/password` | ProfilAkunController@updatePassword | **Wajib Login** | Ganti password |

### Rute Autentikasi Web (Orang Tua)

| Route | Fungsi |
|---|---|
| `GET/POST /register` | Registrasi akun orang tua |
| `GET/POST /login` | Login akun |
| `POST /logout` | Logout |
| `GET/POST /forgot-password` | Minta kode OTP |
| `GET/POST /verify-otp` | Verifikasi kode OTP |
| `POST /resend-otp` | Kirim ulang OTP |
| `GET/POST /reset-password` | Reset password dengan OTP |

### View Blade

```
resources/views/
├── layouts/
│   ├── app.blade.php        ← Layout utama web (navbar, footer)
│   └── auth.blade.php       ← Layout halaman auth
├── pages/
│   ├── home.blade.php
│   ├── profil.blade.php
│   ├── guru.blade.php
│   ├── galeri.blade.php
│   ├── download-aplikasi.blade.php
│   ├── profil-akun.blade.php
│   ├── berita/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── pendaftaran/
│       ├── index.blade.php  ← Form pendaftaran (modal login jika tamu)
│       ├── sukses.blade.php
│       ├── riwayat.blade.php
│       └── detail.blade.php
├── auth/                    ← Form login, register, OTP, reset password
└── emails/
    └── otp.blade.php        ← Template email OTP
```

---

## 5. PANEL ADMIN (FILAMENT V3.3)

URL: `/admin` — Hanya dapat diakses oleh user dengan `role = 'admin'`

### Dashboard Widget

**StatsOverviewWidget** — Kartu statistik yang tampil di halaman utama:
- Total Guru Aktif
- Total Siswa Aktif
- Pendaftaran Pending
- Berita Tayang
- Aplikasi Android (versi aktif)

### 11 Filament Resource

| Resource | Model | Fitur Khusus |
|---|---|---|
| ProfilSekolahResource | ProfilSekolah | Tidak ada Index/Create — hanya Edit (1 data) |
| GuruResource | Guru | Soft delete, filter status |
| SiswaResource | Siswa | Soft delete, filter kelas/status/tahun |
| BeritaResource | Berita | Soft delete, filter status/kategori, user_id auto-set |
| GaleriResource | Galeri | Soft delete, user_id auto-set |
| InfoPendaftaranResource | InfoPendaftaran | Validasi maks 1 aktif, user_id auto-set |
| PendaftaranResource | Pendaftaran | ❌ Tidak ada tombol Create, hanya View+Update status |
| BannerResource | Banner | Sortable urutan |
| SettingResource | Setting | Halaman Edit custom dengan Tabs (Tampilan/Info/Sosmed/Lokasi) |
| AplikasiResource | Aplikasi | Kelola versi APK Android dengan link download |
| UserResource | User | Kelola akun admin dan orang tua |

### AlertBoxService — Notifikasi Dashboard

`AlertBoxService` menampilkan alert kontekstual di dashboard admin:

| Method | Kondisi | Tipe |
|---|---|---|
| `pendingPendaftaran()` | Ada pendaftaran berstatus `pending` | Warning |
| `pendaftaranAktif()` | Ada periode pendaftaran aktif | Success |
| `pendaftaranTutup()` | Tidak ada periode pendaftaran aktif | Info |

---

## 6. REST API (UNTUK FLUTTER)

Base URL: `/api/v1`
Autentikasi: Bearer Token (Laravel Sanctum)

### Endpoint Publik

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/v1/profil-sekolah` | Data profil sekolah |
| GET | `/api/v1/banner` | Banner/slider aktif |
| GET | `/api/v1/guru` | Daftar guru aktif |
| GET | `/api/v1/berita` | Daftar berita (paginasi, `?per_page=10&page=1`) |
| GET | `/api/v1/berita/{id}` | Detail berita |
| GET | `/api/v1/galeri` | Daftar galeri (paginasi) |
| GET | `/api/v1/info-pendaftaran` | Info pendaftaran aktif |

### Endpoint Autentikasi

| Method | Endpoint | Fungsi |
|---|---|---|
| POST | `/api/v1/auth/register` | Registrasi orang tua → mengembalikan token |
| POST | `/api/v1/auth/login` | Login → mengembalikan Bearer Token |
| POST | `/api/v1/auth/logout` | Logout (hapus token) — **Token required** |
| POST | `/api/v1/auth/forgot-password` | Kirim kode OTP ke email |
| POST | `/api/v1/auth/verify-otp` | Verifikasi kode OTP (6 digit, berlaku 10 menit) |
| POST | `/api/v1/auth/reset-password` | Reset password setelah OTP valid |

### Endpoint Terproteksi (Token Required)

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/v1/profile` | Data profil pengguna login |
| PATCH | `/api/v1/profile/info` | Update nama dan no HP |
| PATCH | `/api/v1/profile/password` | Ganti password |
| POST | `/api/v1/pendaftaran` | Kirim formulir pendaftaran siswa baru |
| GET | `/api/v1/pendaftaran/riwayat` | Riwayat pendaftaran milik user |
| GET | `/api/v1/pendaftaran/{id}` | Detail satu pendaftaran milik user |
| GET | `/api/v1/notifikasi` | Daftar notifikasi (paginasi) |
| GET | `/api/v1/notifikasi/unread-count` | Jumlah notifikasi belum dibaca |
| PATCH | `/api/v1/notifikasi/{id}/baca` | Tandai satu notifikasi sebagai dibaca |
| PATCH | `/api/v1/notifikasi/baca-semua` | Tandai semua notifikasi sebagai dibaca |

### Format Response

```json
// GET /api/v1/berita — Response sukses (paginasi)
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "judul": "Penerimaan Siswa Baru Tahun Ajaran 2026/2027",
            "kategori": "Pengumuman",
            "gambar": "berita/foto1.jpg",
            "tanggal_publish": "2026-03-01",
            "status": "publish"
        }
    ],
    "last_page": 5,
    "per_page": 10,
    "total": 48
}

// POST /api/v1/auth/login — Response sukses
{
    "message": "Login berhasil.",
    "user": { "id": 1, "name": "Budi", "email": "budi@mail.com" },
    "token": "1|abc123..."
}

// Response error 401
{ "message": "Email atau kata sandi salah." }

// Response error 404
{ "message": "Berita tidak ditemukan." }

// Response error 422 (OTP expired/invalid)
{ "message": "Kode OTP tidak valid atau sudah kedaluwarsa." }
```

---

## 7. SERVICE LAYER (API ONLY)

Service Layer hanya diterapkan pada jalur API. Setiap Service diinjeksikan ke API Controller melalui constructor dependency injection.

| Service | Repository Digunakan | Cache |
|---|---|---|
| AuthService | UserRepositoryInterface | ❌ Tidak (auth tidak di-cache) |
| BeritaService | BeritaRepositoryInterface | ✅ Redis |
| GaleriService | GaleriRepositoryInterface | ❌ Tidak |
| GuruService | GuruRepositoryInterface | ✅ Redis |
| NotifikasiService | NotifikasiRepositoryInterface | ❌ Tidak |
| PendaftaranService | PendaftaranRepositoryInterface + InfoPendaftaranRepositoryInterface | ❌ Tidak |
| ProfileService | UserRepositoryInterface | ❌ Tidak |
| ProfilSekolahService | ProfilSekolahRepositoryInterface + BannerRepositoryInterface | ✅ Redis |

---

## 8. REDIS CACHING

### Strategi Cache per Data

| Data | Cache Key | TTL | Alasan |
|---|---|---|---|
| Daftar berita (paginasi) | `berita_page_{n}_per{x}` | 10 menit | Berita baru perlu cepat muncul |
| Detail berita | `berita_{id}` | 1 jam | Konten berita jarang berubah |
| Berita terbaru (home) | `berita_latest_{limit}` | 15 menit | Sering diakses |
| Daftar guru aktif | `guru_aktif` | 3 jam | Data guru jarang berubah |
| Profil sekolah | `profil_sekolah` | 6 jam | Sangat jarang berubah |
| Banner aktif | `banner_aktif` | 3 jam | Banner jarang diganti |

### Invalidasi Cache Otomatis via Observer

**BeritaObserver** — dipicu saat data berita berubah:
- `created` → hapus `berita_latest_5`, `berita_latest_3`
- `updated` → hapus `berita_{id}`, `berita_latest_5`, `berita_latest_3`
- `deleted` → hapus `berita_{id}`, `berita_latest_5`, `berita_latest_3`
- Jika status berubah menjadi `publish` → buat notifikasi massal ke semua user `orangtua`

**PendaftaranObserver** — dipicu saat status pendaftaran berubah:
- Status → `diterima` → buat notifikasi ke user orang tua: "Pendaftaran Diterima"
- Status → `ditolak` → buat notifikasi ke user orang tua: "Pendaftaran Ditolak"

### Konfigurasi Redis (.env)

```env
CACHE_STORE=redis
REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1
```

---

## 9. SISTEM NOTIFIKASI

Notifikasi bersifat in-app dan dapat diakses oleh pengguna aplikasi mobile melalui endpoint API. Notifikasi dibuat secara otomatis oleh Observer tanpa intervensi manual admin.

### Pemicu Notifikasi

| Event | Pemicu | Penerima | Judul |
|---|---|---|---|
| Berita dipublish | BeritaObserver@updated | Semua user `orangtua` | "Berita Baru" |
| Pendaftaran diterima | PendaftaranObserver@updated | User yang mendaftar | "Pendaftaran Diterima" |
| Pendaftaran ditolak | PendaftaranObserver@updated | User yang mendaftar | "Pendaftaran Ditolak" |

### Field Notifikasi

- `tipe`: `berita` atau `pendaftaran`
- `referensi_id`: ID berita atau pendaftaran yang terkait (untuk deep link di Flutter)
- `dibaca`: boolean, default `false`

---

## 10. SISTEM OTP (LUPA PASSWORD)

Berlaku untuk web maupun API mobile.

**Alur:**
1. User input email → sistem cek apakah email terdaftar
2. OTP 6 digit digenerate dan dikirim via email (`OtpMail`)
3. OTP lama untuk email yang sama diinvalidasi otomatis
4. OTP berlaku **10 menit** sejak dikirim
5. User input OTP → sistem verifikasi
6. Jika valid, user dapat submit password baru

**Tabel `otp_codes`:** `email`, `otp`, `expires_at`, `used`

---

## 11. FITUR DOWNLOAD APLIKASI ANDROID

Halaman `/download-aplikasi` memungkinkan pengunjung web mengunduh APK aplikasi Android SD Negeri Warialau.

**Alur:**
1. Admin menambah entri APK baru melalui `AplikasiResource` di panel admin
2. Admin mengisi nama aplikasi, nomor versi, deskripsi, ukuran file, dan link download (Google Drive / Dropbox / link langsung)
3. Pengunjung membuka halaman `/download-aplikasi`
4. `AplikasiController` menampilkan versi APK terbaru yang berstatus `aktif`
5. Klik tombol unduh → redirect ke `link_download` yang tersimpan

---

## 12. VIEW COMPOSER

`AppServiceProvider` mendaftarkan View Composer untuk layout web:

```php
View::composer(['layouts.app', 'layouts.auth'], function ($view) {
    $view->with('profil', ProfilSekolah::first());
    $view->with('settings', Setting::all()->pluck('value', 'key'));
});
```

Variabel `$profil` dan `$settings` tersedia otomatis di semua halaman yang menggunakan layout utama (navbar, footer, favicon, dll) tanpa perlu pass manual dari setiap controller.

---

## 13. REPOSITORY SERVICE PROVIDER

Binding interface ke implementasi konkret dilakukan di `RepositoryServiceProvider`:

```php
$this->app->bind(UserRepositoryInterface::class,            UserRepository::class);
$this->app->bind(BeritaRepositoryInterface::class,          BeritaRepository::class);
$this->app->bind(GaleriRepositoryInterface::class,          GaleriRepository::class);
$this->app->bind(GuruRepositoryInterface::class,            GuruRepository::class);
$this->app->bind(ProfilSekolahRepositoryInterface::class,   ProfilSekolahRepository::class);
$this->app->bind(BannerRepositoryInterface::class,          BannerRepository::class);
$this->app->bind(InfoPendaftaranRepositoryInterface::class,  InfoPendaftaranRepository::class);
$this->app->bind(PendaftaranRepositoryInterface::class,     PendaftaranRepository::class);
$this->app->bind(NotifikasiRepositoryInterface::class,      NotifikasiRepository::class);
```

---

## 14. CONTAINERISASI DOCKER

### Layanan (docker-compose.yml)

| Container | Image | Port | Fungsi |
|---|---|---|---|
| `warialau_app` | Custom PHP 8.2-FPM | — | Menjalankan Laravel |
| `warialau_nginx` | nginx:1.25-alpine | 8000:80 | Web server |
| `warialau_redis` | redis:7-alpine | 6379:6379 | Cache server |

Seluruh container terhubung dalam network `warialau_net` (bridge driver).

### Perintah Deploy

```bash
# 1. Clone dan masuk ke direktori project
git clone <repo> && cd web-warialau

# 2. Salin dan konfigurasi .env
cp .env.example .env
# Edit .env: APP_KEY, DB_*, REDIS_*, MAIL_*

# 3. Build dan jalankan container
docker-compose up -d --build

# 4. Generate app key
docker exec warialau_app php artisan key:generate

# 5. Jalankan migrasi + seeder
docker exec warialau_app php artisan migrate --seed

# 6. Buat symlink storage
docker exec warialau_app php artisan storage:link

# Sistem aktif di http://localhost:8000
# Panel admin: http://localhost:8000/admin
```

---

## 15. AKUN DEFAULT (SEEDER)

| Role | Email | Password |
|---|---|---|
| Admin | admin@admin.com | admin |

Reset database:
```bash
php artisan migrate:fresh --seed
```

---

## 16. RINGKASAN FITUR SISTEM

### Web Pengunjung
| Fitur | Keterangan |
|---|---|
| Beranda | Banner slider, statistik, berita terbaru, galeri, info pendaftaran |
| Profil Sekolah | Visi, misi, sejarah, kepala sekolah, akreditasi |
| Data Guru | Daftar guru aktif dengan foto dan informasi |
| Berita & Pengumuman | Daftar + detail berita dengan filter kategori |
| Galeri Foto | Grid foto kegiatan sekolah |
| Info Pendaftaran | Jadwal, syarat, kuota pendaftaran |
| Formulir Pendaftaran Online | Pengisian form oleh orang tua (wajib login) |
| Riwayat Pendaftaran | Orang tua dapat memantau status pendaftaran |
| Download Aplikasi Android | Halaman unduhan APK versi terbaru |
| Lupa Password (OTP) | Reset password via kode OTP email |

### Panel Admin
| Fitur | Keterangan |
|---|---|
| Dashboard Statistik | 5 kartu: guru, siswa, pendaftaran pending, berita, APK |
| Kelola Profil Sekolah | Edit satu data profil sekolah |
| Kelola Guru | CRUD + soft delete + filter status |
| Kelola Siswa | CRUD + soft delete + filter kelas/status/tahun |
| Kelola Berita | CRUD + soft delete + rich editor + filter |
| Kelola Galeri | CRUD + soft delete + upload foto |
| Kelola Info Pendaftaran | CRUD + validasi maks 1 aktif |
| Kelola Pendaftaran | Lihat data masuk + update status (diterima/ditolak) |
| Kelola Banner | CRUD + sortable urutan |
| Kelola Pengaturan | Edit tampilan web (logo, sosmed, maps embed) |
| Kelola Aplikasi Android | CRUD versi APK + link download |
| Kelola Pengguna | CRUD akun admin dan orang tua |

### API Mobile (Flutter)
| Fitur | Keterangan |
|---|---|
| Publik | Profil, banner, guru, berita, galeri, info pendaftaran |
| Autentikasi | Register, login, logout, OTP lupa password |
| Pendaftaran | Submit form + riwayat + detail |
| Notifikasi | Daftar, jumlah unread, tandai dibaca |
| Profil Akun | Lihat + update info + ganti password |
