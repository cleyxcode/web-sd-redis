<div align="center">

# 🏫 Web SD Negeri Warialau

### Sistem Informasi & PPDB Online

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.3-FDAE4B?style=for-the-badge)
![SQLite](https://img.shields.io/badge/Database-SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-22c55e?style=for-the-badge)

**Website resmi SD Negeri Warialau, Kec. Aru Utara, Kab. Kepulauan Aru, Maluku.**
Dilengkapi panel admin modern, PPDB Online, galeri, berita, profil sekolah, dan download aplikasi.

[🐛 Laporkan Bug](https://github.com/cleyxcode/web-sd-redis/issues) &nbsp;·&nbsp; [💡 Usulan Fitur](https://github.com/cleyxcode/web-sd-redis/issues/new)

</div>

---

## ✨ Fitur Utama

| Halaman | Keterangan |
|---|---|
| 🏠 **Beranda** | Hero slider banner, statistik sekolah, berita terbaru, galeri momen, FAQ |
| 📝 **PPDB Online** | Form pendaftaran siswa baru dengan upload dokumen (wajib login) |
| 📰 **Berita & Pengumuman** | Artikel dengan kategori, thumbnail, dan detail konten |
| 🖼️ **Galeri Foto** | Dokumentasi kegiatan dan momen berharga sekolah |
| 👨‍🏫 **Data Guru** | Profil lengkap tenaga pendidik aktif |
| 🏛️ **Profil Sekolah** | Visi, misi, sejarah, akreditasi, dan informasi kontak |
| 👤 **Akun Orang Tua** | Registrasi, login, lacak status pendaftaran anak |
| 📱 **Download Aplikasi** | Halaman unduh APK Android + riwayat versi |
| 🔐 **Panel Admin** | Dashboard Filament v3 — kelola semua data sekolah |

---

## 🛠️ Teknologi

- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Admin Panel:** [Filament v3.3](https://filamentphp.com)
- **Database:** SQLite *(tidak perlu install MySQL/PostgreSQL)*
- **Cache/Session:** Redis atau Database
- **Frontend:** Blade Template + TailwindCSS CDN
- **Icons:** Google Material Symbols Outlined
- **Fonts:** Fraunces (display) + Nunito (body)

---

## 📋 Persyaratan Sistem

Pastikan komputer kamu sudah memiliki software berikut sebelum memulai:

| Software | Versi | Cara Cek | Download |
|---|---|---|---|
| **PHP** | 8.2 atau lebih baru | `php -v` | [php.net](https://www.php.net/downloads) |
| **Composer** | 2.x | `composer -V` | [getcomposer.org](https://getcomposer.org/download/) |
| **Git** | Terbaru | `git --version` | [git-scm.com](https://git-scm.com/downloads) |

> 💡 **Tips untuk pemula (Windows):** Install [Laragon](https://laragon.org/) — sudah include PHP, Composer, dan tidak perlu konfigurasi ribet. Cukup install dan langsung bisa dipakai.

> 💡 **Tips untuk pemula (Mac/Linux):** Gunakan [Homebrew](https://brew.sh/) lalu `brew install php composer`.

---

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut secara berurutan. Jangan lewati satu pun!

---

### 1️⃣ Clone Repository

Buka **Terminal** (Mac/Linux) atau **Command Prompt / PowerShell** (Windows), lalu jalankan:

```bash
git clone https://github.com/cleyxcode/web-sd-redis.git
cd web-sd-redis
```

---

### 2️⃣ Install Dependensi PHP

```bash
composer install
```

> ⏳ Proses ini membutuhkan waktu beberapa menit. Tunggu hingga muncul teks `Generating autoload files`.

---

### 3️⃣ Salin File Konfigurasi

```bash
# Mac / Linux
cp .env.example .env

# Windows (Command Prompt)
copy .env.example .env
```

Lalu buat application key:

```bash
php artisan key:generate
```

Kamu akan melihat pesan: `Application key set successfully.`

---

### 4️⃣ Sesuaikan File `.env`

Buka file `.env` menggunakan text editor (VS Code, Notepad++, dll).

Ubah beberapa baris berikut:

```env
# Nama aplikasi
APP_NAME="Web SD Negeri Warialau"

# URL lokal saat development
APP_URL=http://localhost:8000

# Database — biarkan SQLite, tidak perlu diubah
DB_CONNECTION=sqlite

# Cache — ganti ke "database" jika tidak punya Redis
CACHE_STORE=database

# Session
SESSION_DRIVER=database
```

> ✅ **SQLite** tidak perlu install database terpisah — file database otomatis dibuat di folder `database/`.

---

### 5️⃣ Buat Tabel Database & Isi Data Awal

```bash
php artisan migrate --seed
```

Perintah ini akan otomatis:
- ✅ Membuat file database SQLite
- ✅ Membuat semua tabel (17 tabel)
- ✅ Membuat akun admin default
- ✅ Mengisi profil sekolah awal
- ✅ Mengisi pengaturan website

---

### 6️⃣ Buat Symbolic Link untuk Storage

Agar gambar/file yang diupload bisa tampil di browser:

```bash
php artisan storage:link
```

---

### 7️⃣ Jalankan Server Lokal

```bash
php artisan serve
```

Buka browser dan akses: **[http://localhost:8000](http://localhost:8000)**

🎉 **Selesai! Website sudah berjalan.**

---

## 🔑 Login Panel Admin

| | |
|---|---|
| **URL** | http://localhost:8000/admin |
| **Email** | `admin@admin.com` |
| **Password** | `admin` |

> ⚠️ **Wajib:** Ganti password default segera setelah login pertama melalui ikon profil di pojok kanan atas panel admin!

---

## 🔄 Reset Database

Jika ingin memulai ulang (menghapus semua data dan mengisi ulang data awal):

```bash
php artisan migrate:fresh --seed
```

> ⚠️ **Peringatan:** Perintah ini akan menghapus **seluruh data** di database secara permanen!

---

## 🐳 Menjalankan dengan Docker (Opsional)

Jika kamu sudah menginstall [Docker Desktop](https://www.docker.com/products/docker-desktop/):

```bash
# Jalankan container
docker-compose up -d

# Masuk ke dalam container
docker exec -it web-warialau-app bash

# Jalankan setup di dalam container
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

Akses di: **[http://localhost:8080](http://localhost:8080)**

---

## 📁 Struktur Folder

```
web-sd-redis/
│
├── app/
│   ├── Filament/              ← Resource & widget panel admin
│   │   └── Resources/         ← CRUD: Guru, Siswa, Berita, dll
│   ├── Http/
│   │   └── Controllers/       ← Controller halaman publik & auth
│   ├── Models/                ← Model Eloquent (9 model)
│   └── Services/              ← Service layer notifikasi
│
├── database/
│   ├── migrations/            ← Definisi struktur tabel
│   └── seeders/               ← Data awal (admin, profil, settings)
│
├── resources/
│   └── views/
│       ├── layouts/           ← Template utama (app & auth)
│       ├── pages/             ← Halaman web publik
│       └── auth/              ← Halaman login & register
│
├── routes/
│   └── web.php                ← Semua route aplikasi
│
├── public/
│   └── storage → ../storage/app/public   ← Symlink file upload
│
├── storage/app/public/        ← Tempat penyimpanan file upload
│   ├── banner/                ← Gambar slider
│   ├── berita/                ← Thumbnail berita
│   ├── galeri/                ← Foto galeri
│   ├── guru/                  ← Foto profil guru
│   └── pendaftaran/           ← Dokumen pendaftaran
│
├── .env.example               ← Contoh konfigurasi (salin ke .env)
├── composer.json              ← Dependensi PHP
└── README.md                  ← File ini
```

---

## 📊 Struktur Database

| Tabel | Isi |
|---|---|
| `users` | Akun admin dan orang tua siswa |
| `profil_sekolah` | Identitas, visi, misi, dan sejarah sekolah |
| `guru` | Data lengkap tenaga pendidik |
| `siswa` | Data siswa aktif/alumni |
| `berita` | Artikel berita dan pengumuman |
| `galeri` | Foto dokumentasi kegiatan |
| `info_pendaftaran` | Pengaturan periode & kuota PPDB |
| `pendaftaran` | Data formulir pendaftar siswa baru |
| `banner` | Gambar hero slider beranda |
| `settings` | Konfigurasi tampilan website |
| `aplikasi` | Data file APK Android |
| `notifikasi` | Pemberitahuan untuk orang tua |

---

## 🧑‍💼 Panduan Penggunaan Admin

### Mengatur Konten Website
1. Login ke `/admin`
2. Pilih menu di sidebar: **Berita**, **Galeri**, **Banner**, **Guru**, dll
3. Klik **New** (tombol hijau) untuk menambah data baru

### Mengatur Tampilan & Info Sekolah
1. Login ke `/admin`
2. Klik menu **Settings** di sidebar
3. Atur: logo, background, info kontak, tautan media sosial, embed Google Maps

### Membuka Pendaftaran Siswa Baru (PPDB)
1. Login ke `/admin` → **Info Pendaftaran**
2. Klik **New** → isi tahun ajaran, tanggal buka/tutup, kuota
3. Set status menjadi **Aktif**
4. Formulir pendaftaran otomatis tersedia di `/pendaftaran`

### Mengelola Data Pendaftar
1. Login ke `/admin` → **Pendaftaran**
2. Klik nama pendaftar untuk melihat detail lengkap
3. Ubah **Status**: Pending → Diterima / Ditolak
4. Orang tua akan bisa melihat status terbaru di akun mereka

---

## ❓ Pertanyaan yang Sering Ditanyakan

<details>
<summary><strong>❌ Error: "php: command not found" atau "php is not recognized"</strong></summary>

PHP belum terinstall atau belum ditambahkan ke PATH sistem.
- **Windows:** Install [Laragon](https://laragon.org/) dan restart terminal
- **Mac:** Jalankan `brew install php`
- **Linux:** Jalankan `sudo apt install php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-sqlite3`

</details>

<details>
<summary><strong>❌ Error: "composer: command not found"</strong></summary>

Composer belum terinstall. Download dan ikuti panduan di [getcomposer.org/download](https://getcomposer.org/download/).

</details>

<details>
<summary><strong>❌ Gambar yang diupload tidak muncul</strong></summary>

Jalankan ulang perintah:
```bash
php artisan storage:link
```

</details>

<details>
<summary><strong>❌ Error: "SQLSTATE: no such table: ..."</strong></summary>

Tabel belum dibuat. Jalankan:
```bash
php artisan migrate --seed
```

</details>

<details>
<summary><strong>❌ Tidak bisa login ke panel /admin</strong></summary>

Pastikan sudah menjalankan `php artisan migrate --seed`.
Login dengan: `admin@admin.com` / `admin`

</details>

<details>
<summary><strong>❌ Error terkait Redis / cache</strong></summary>

Ganti nilai berikut di file `.env`:
```env
CACHE_STORE=database
SESSION_DRIVER=database
```
Redis bersifat opsional — aplikasi tetap berjalan normal tanpa Redis.

</details>

<details>
<summary><strong>❌ Error "Class not found" atau error aneh setelah pull</strong></summary>

Jalankan:
```bash
composer install
php artisan optimize:clear
```

</details>

---

## 🤝 Kontribusi

Kontribusi dalam bentuk apapun sangat kami sambut dengan tangan terbuka!

1. **Fork** repository ini (klik tombol Fork di GitHub)
2. Buat branch baru:
   ```bash
   git checkout -b fitur/nama-fitur-kamu
   ```
3. Buat perubahan dan commit:
   ```bash
   git commit -m "feat: deskripsi singkat perubahan"
   ```
4. Push ke branch kamu:
   ```bash
   git push origin fitur/nama-fitur-kamu
   ```
5. Buka **Pull Request** ke branch `main` di repository ini

### Format Pesan Commit

```
feat:      fitur baru
fix:       perbaikan bug
style:     perubahan UI/tampilan
refactor:  refaktor kode (tanpa mengubah fungsi)
docs:      perubahan dokumentasi
chore:     update dependensi / konfigurasi
```

---

## 📄 Lisensi

Didistribusikan di bawah **Lisensi MIT**.
Bebas digunakan, dimodifikasi, dan disebarluaskan dengan menyertakan atribusi.
Lihat file [LICENSE](LICENSE) untuk informasi lengkap.

---

## 👨‍💻 Pembuat

<table>
  <tr>
    <td align="center">
      <b>Bredcly Fransiscus Tuhuleruw</b><br/>
      Mahasiswa Teknik Informatika<br/>
      Universitas Kristen Indonesia Maluku (UKIM) Ambon<br/>
      NIM: 12155201220021 · Angkatan 2022
    </td>
  </tr>
</table>

---

<div align="center">

Dibuat dengan ❤️ untuk kemajuan pendidikan di Kepulauan Aru, Maluku.

**Jika project ini bermanfaat, mohon berikan ⭐ Star di GitHub — sangat berarti!**

</div>
