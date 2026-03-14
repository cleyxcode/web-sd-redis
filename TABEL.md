# Daftar Tabel Database
## Sistem Informasi SD Negeri Warialau
**Oleh:** Bredcly Fransiscus Tuhuleruw (12155201220021)
**Institusi:** Universitas Kristen Indonesia Maluku (UKIM) Ambon — 2026
**Database:** SQLite
**Total Tabel:** 19 tabel

---

## A. Tabel Utama Aplikasi

### 1. `users`
Menyimpan data akun pengguna (admin dan orang tua/wali).

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `name` | VARCHAR | Nama lengkap pengguna |
| 3 | `email` | VARCHAR (UNIQUE) | Alamat email, digunakan untuk login |
| 4 | `email_verified_at` | TIMESTAMP | Waktu verifikasi email (nullable) |
| 5 | `password` | VARCHAR | Kata sandi terenkripsi (bcrypt) |
| 6 | `role` | VARCHAR | Peran pengguna: `admin` / `orangtua` (default: `orangtua`) |
| 7 | `no_hp` | VARCHAR | Nomor handphone (nullable) |
| 8 | `remember_token` | VARCHAR | Token untuk fitur "ingat saya" |
| 9 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 10 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 2. `profil_sekolah`
Menyimpan informasi identitas dan profil SD Negeri Warialau.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `nama_sekolah` | VARCHAR | Nama resmi sekolah |
| 3 | `kepala_sekolah` | VARCHAR | Nama kepala sekolah (nullable) |
| 4 | `akreditasi` | VARCHAR | Akreditasi sekolah: `A` / `B` / `C` (nullable) |
| 5 | `tahun_berdiri` | VARCHAR | Tahun sekolah didirikan (nullable) |
| 6 | `jumlah_ruang_kelas` | INTEGER | Jumlah ruang kelas (nullable) |
| 7 | `visi` | TEXT | Visi sekolah (nullable) |
| 8 | `misi` | TEXT | Misi sekolah (nullable) |
| 9 | `sejarah` | TEXT | Sejarah singkat sekolah (nullable) |
| 10 | `alamat` | TEXT | Alamat lengkap sekolah (nullable) |
| 11 | `kontak` | VARCHAR | Nomor kontak sekolah (nullable) |
| 12 | `logo` | VARCHAR | Path file logo sekolah (nullable) |
| 13 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 14 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 3. `guru`
Menyimpan data tenaga pengajar / guru.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `nama` | VARCHAR | Nama lengkap guru |
| 3 | `nip` | VARCHAR | Nomor Induk Pegawai (nullable) |
| 4 | `jabatan` | VARCHAR | Jabatan guru (nullable) |
| 5 | `mata_pelajaran` | VARCHAR | Mata pelajaran yang diampu (nullable) |
| 6 | `no_hp` | VARCHAR | Nomor handphone guru (nullable) |
| 7 | `foto` | VARCHAR | Path file foto guru (nullable) |
| 8 | `status` | VARCHAR | Status guru: `aktif` / `nonaktif` (default: `aktif`) |
| 9 | `deleted_at` | TIMESTAMP | Soft delete timestamp (nullable) |
| 10 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 11 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 4. `siswa`
Menyimpan data siswa aktif maupun alumni.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `nama` | VARCHAR | Nama lengkap siswa |
| 3 | `nis` | VARCHAR | Nomor Induk Siswa (nullable) |
| 4 | `kelas` | VARCHAR | Kelas siswa, contoh: `I`, `II`, `III` (nullable) |
| 5 | `jenis_kelamin` | VARCHAR | Jenis kelamin: `L` (Laki-laki) / `P` (Perempuan) (nullable) |
| 6 | `tahun_ajaran` | VARCHAR | Tahun ajaran, contoh: `2025/2026` (nullable) |
| 7 | `foto` | VARCHAR | Path file foto siswa (nullable) |
| 8 | `status` | VARCHAR | Status siswa: `aktif` / `nonaktif` / `lulus` (default: `aktif`) |
| 9 | `deleted_at` | TIMESTAMP | Soft delete timestamp (nullable) |
| 10 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 11 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 5. `berita`
Menyimpan artikel berita dan pengumuman sekolah.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `user_id` | INTEGER (FK) | Referensi ke tabel `users` (penulis berita) |
| 3 | `judul` | VARCHAR | Judul berita |
| 4 | `isi` | LONGTEXT | Isi konten berita (mendukung HTML) |
| 5 | `gambar` | VARCHAR | Path file gambar sampul (nullable) |
| 6 | `kategori` | VARCHAR | Kategori berita, contoh: `Pengumuman`, `Prestasi` (nullable) |
| 7 | `tanggal_publish` | DATE | Tanggal publikasi berita (nullable) |
| 8 | `status` | VARCHAR | Status: `draft` / `publish` (default: `draft`) |
| 9 | `deleted_at` | TIMESTAMP | Soft delete timestamp (nullable) |
| 10 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 11 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

> **Relasi:** `user_id` → `users.id` (cascade on delete)

---

### 6. `galeri`
Menyimpan foto-foto kegiatan sekolah.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `user_id` | INTEGER (FK) | Referensi ke tabel `users` (pengunggah foto) |
| 3 | `judul` | VARCHAR | Judul atau keterangan foto |
| 4 | `foto` | VARCHAR | Path file foto |
| 5 | `keterangan` | TEXT | Deskripsi tambahan foto (nullable) |
| 6 | `deleted_at` | TIMESTAMP | Soft delete timestamp (nullable) |
| 7 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 8 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

> **Relasi:** `user_id` → `users.id` (cascade on delete)

---

### 7. `info_pendaftaran`
Menyimpan konfigurasi periode penerimaan siswa baru (PPDB).

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `user_id` | INTEGER (FK) | Referensi ke tabel `users` (admin yang membuat) |
| 3 | `tahun_ajaran` | VARCHAR | Tahun ajaran pendaftaran, contoh: `2026/2027` |
| 4 | `tanggal_buka` | DATE | Tanggal mulai pendaftaran dibuka |
| 5 | `tanggal_tutup` | DATE | Tanggal pendaftaran ditutup |
| 6 | `kuota` | INTEGER | Jumlah kuota penerimaan siswa baru |
| 7 | `syarat` | TEXT | Syarat-syarat pendaftaran (nullable) |
| 8 | `status` | VARCHAR | Status periode: `aktif` / `nonaktif` (default: `nonaktif`) |
| 9 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 10 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

> **Relasi:** `user_id` → `users.id` (cascade on delete)

---

### 8. `pendaftaran`
Menyimpan data formulir pendaftaran siswa baru yang diajukan orang tua.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `user_id` | INTEGER (FK) | Referensi ke tabel `users` (akun orang tua) |
| 3 | `info_pendaftaran_id` | INTEGER (FK) | Referensi ke tabel `info_pendaftaran` |
| 4 | `nama_anak` | VARCHAR | Nama lengkap anak yang didaftarkan |
| 5 | `tempat_lahir` | VARCHAR | Tempat lahir anak (nullable) |
| 6 | `tanggal_lahir` | DATE | Tanggal lahir anak |
| 7 | `jenis_kelamin` | VARCHAR | Jenis kelamin: `L` / `P` |
| 8 | `agama` | VARCHAR | Agama anak |
| 9 | `anak_ke` | INTEGER | Urutan anak dalam keluarga (nullable) |
| 10 | `asal_sekolah` | VARCHAR | Asal TK/sekolah sebelumnya (nullable) |
| 11 | `nik` | VARCHAR | Nomor Induk Kependudukan anak (nullable) |
| 12 | `no_kk` | VARCHAR | Nomor Kartu Keluarga (nullable) |
| 13 | `alamat` | TEXT | Alamat tempat tinggal |
| 14 | `nama_ayah` | VARCHAR | Nama ayah kandung (nullable) |
| 15 | `pekerjaan_ayah` | VARCHAR | Pekerjaan ayah (nullable) |
| 16 | `nama_ibu` | VARCHAR | Nama ibu kandung (nullable) |
| 17 | `pekerjaan_ibu` | VARCHAR | Pekerjaan ibu (nullable) |
| 18 | `nama_wali` | VARCHAR | Nama wali (jika bukan orang tua kandung) (nullable) |
| 19 | `no_hp` | VARCHAR | Nomor HP yang dapat dihubungi |
| 20 | `dokumen` | VARCHAR | Path file dokumen pendukung (nullable) |
| 21 | `status` | VARCHAR | Status pendaftaran: `pending` / `diterima` / `ditolak` (default: `pending`) |
| 22 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 23 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

> **Relasi:** `user_id` → `users.id` (cascade on delete), `info_pendaftaran_id` → `info_pendaftaran.id` (cascade on delete)

---

### 9. `banner`
Menyimpan gambar banner/slider untuk halaman utama website.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `judul` | VARCHAR | Judul atau teks banner |
| 3 | `gambar` | VARCHAR | Path file gambar banner |
| 4 | `urutan` | INTEGER | Urutan tampil di slider (default: `1`) |
| 5 | `status` | VARCHAR | Status banner: `aktif` / `nonaktif` (default: `aktif`) |
| 6 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 7 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 10. `settings`
Menyimpan konfigurasi tampilan dan informasi website secara dinamis.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `key` | VARCHAR (UNIQUE) | Nama konfigurasi, contoh: `logo`, `facebook_url` |
| 3 | `value` | TEXT | Nilai konfigurasi (nullable) |
| 4 | `type` | VARCHAR | Tipe nilai: `text` / `image` / `url` (default: `text`) |
| 5 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 6 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

**Daftar key settings yang digunakan:**

| Key | Type | Keterangan |
|-----|------|------------|
| `logo` | image | Logo website |
| `background` | image | Foto latar belakang halaman auth |
| `favicon` | image | Favicon website |
| `alamat_sekolah` | text | Alamat sekolah untuk footer |
| `no_telp` | text | Nomor telepon sekolah |
| `email_sekolah` | text | Email resmi sekolah |
| `facebook_url` | url | URL halaman Facebook sekolah |
| `instagram_url` | url | URL akun Instagram sekolah |
| `maps_embed` | text | Kode embed Google Maps |

---

### 11. `otp_codes`
Menyimpan kode OTP sementara untuk fitur lupa kata sandi.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `email` | VARCHAR (INDEX) | Email tujuan pengiriman OTP |
| 3 | `otp` | VARCHAR(6) | Kode OTP 6 digit |
| 4 | `expires_at` | TIMESTAMP | Waktu kedaluwarsa OTP (10 menit) |
| 5 | `used` | BOOLEAN | Status penggunaan OTP: `0` (belum) / `1` (sudah digunakan) (default: `0`) |
| 6 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 7 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

### 12. `personal_access_tokens`
Menyimpan token autentikasi API (dikelola oleh Laravel Sanctum).

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `tokenable_type` | VARCHAR | Tipe model pemilik token (polymorphic) |
| 3 | `tokenable_id` | INTEGER | ID model pemilik token (polymorphic) |
| 4 | `name` | TEXT | Nama token, contoh: `api-token` |
| 5 | `token` | VARCHAR(64) (UNIQUE) | Hash token SHA-256 |
| 6 | `abilities` | TEXT | Hak akses token dalam format JSON (nullable) |
| 7 | `last_used_at` | TIMESTAMP | Waktu terakhir token digunakan (nullable) |
| 8 | `expires_at` | TIMESTAMP | Waktu kedaluwarsa token (nullable) |
| 9 | `created_at` | TIMESTAMP | Waktu data dibuat |
| 10 | `updated_at` | TIMESTAMP | Waktu data terakhir diperbarui |

---

## B. Tabel Sistem Laravel (Internal Framework)

### 13. `sessions`
Menyimpan data sesi pengguna website.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | VARCHAR (PK) | ID sesi unik |
| 2 | `user_id` | INTEGER | ID pengguna yang sedang login (nullable) |
| 3 | `ip_address` | VARCHAR(45) | Alamat IP pengguna (nullable) |
| 4 | `user_agent` | TEXT | Informasi browser pengguna (nullable) |
| 5 | `payload` | LONGTEXT | Data sesi terenkripsi |
| 6 | `last_activity` | INTEGER | Timestamp aktivitas terakhir |

---

### 14. `cache`
Menyimpan data cache aplikasi.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `key` | VARCHAR (PK) | Kunci cache |
| 2 | `value` | MEDIUMTEXT | Nilai cache |
| 3 | `expiration` | INTEGER | Waktu kedaluwarsa cache (unix timestamp) |

---

### 15. `cache_locks`
Menyimpan kunci cache untuk mencegah race condition.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `key` | VARCHAR (PK) | Kunci lock |
| 2 | `owner` | VARCHAR | Pemilik lock |
| 3 | `expiration` | INTEGER | Waktu kedaluwarsa lock |

---

### 16. `password_reset_tokens`
Menyimpan token reset password bawaan Laravel (tidak digunakan, digantikan OTP).

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `email` | VARCHAR (PK) | Email pengguna |
| 2 | `token` | VARCHAR | Token reset password |
| 3 | `created_at` | TIMESTAMP | Waktu token dibuat (nullable) |

---

### 17. `jobs`
Menyimpan antrian pekerjaan (queue jobs) Laravel.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `queue` | VARCHAR (INDEX) | Nama antrian |
| 3 | `payload` | LONGTEXT | Data pekerjaan |
| 4 | `attempts` | TINYINT UNSIGNED | Jumlah percobaan eksekusi |
| 5 | `reserved_at` | INTEGER UNSIGNED | Waktu job direservasi (nullable) |
| 6 | `available_at` | INTEGER UNSIGNED | Waktu job tersedia |
| 7 | `created_at` | INTEGER UNSIGNED | Waktu job dibuat |

---

### 18. `job_batches`
Menyimpan informasi batch (kelompok) antrian pekerjaan.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | VARCHAR (PK) | ID batch unik |
| 2 | `name` | VARCHAR | Nama batch |
| 3 | `total_jobs` | INTEGER | Total jumlah job dalam batch |
| 4 | `pending_jobs` | INTEGER | Jumlah job yang belum selesai |
| 5 | `failed_jobs` | INTEGER | Jumlah job yang gagal |
| 6 | `failed_job_ids` | LONGTEXT | Daftar ID job yang gagal |
| 7 | `options` | MEDIUMTEXT | Opsi tambahan batch (nullable) |
| 8 | `cancelled_at` | INTEGER | Waktu batch dibatalkan (nullable) |
| 9 | `created_at` | INTEGER | Waktu batch dibuat |
| 10 | `finished_at` | INTEGER | Waktu batch selesai (nullable) |

---

### 19. `failed_jobs`
Menyimpan catatan antrian pekerjaan yang gagal dieksekusi.

| No | Kolom | Tipe | Keterangan |
|----|-------|------|------------|
| 1 | `id` | INTEGER (PK) | Primary key, auto increment |
| 2 | `uuid` | VARCHAR (UNIQUE) | ID unik job |
| 3 | `connection` | TEXT | Nama koneksi queue |
| 4 | `queue` | TEXT | Nama antrian |
| 5 | `payload` | LONGTEXT | Data job yang gagal |
| 6 | `exception` | LONGTEXT | Pesan error/exception |
| 7 | `failed_at` | TIMESTAMP | Waktu job gagal |

---

## Ringkasan Tabel

| No | Nama Tabel | Kategori | Jumlah Kolom | Keterangan Singkat |
|----|-----------|----------|--------------|-------------------|
| 1 | `users` | Utama | 10 | Akun pengguna (admin & orang tua) |
| 2 | `profil_sekolah` | Utama | 14 | Identitas dan profil sekolah |
| 3 | `guru` | Utama | 11 | Data tenaga pengajar |
| 4 | `siswa` | Utama | 11 | Data siswa |
| 5 | `berita` | Utama | 11 | Artikel berita & pengumuman |
| 6 | `galeri` | Utama | 8 | Foto kegiatan sekolah |
| 7 | `info_pendaftaran` | Utama | 10 | Konfigurasi periode PPDB |
| 8 | `pendaftaran` | Utama | 23 | Formulir pendaftaran siswa baru |
| 9 | `banner` | Utama | 7 | Gambar slider halaman utama |
| 10 | `settings` | Utama | 6 | Konfigurasi tampilan website |
| 11 | `otp_codes` | Utama | 7 | Kode OTP lupa kata sandi |
| 12 | `personal_access_tokens` | Utama | 10 | Token API (Laravel Sanctum) |
| 13 | `sessions` | Sistem | 6 | Data sesi pengguna |
| 14 | `cache` | Sistem | 3 | Cache aplikasi |
| 15 | `cache_locks` | Sistem | 3 | Kunci cache |
| 16 | `password_reset_tokens` | Sistem | 3 | Token reset password Laravel |
| 17 | `jobs` | Sistem | 7 | Antrian pekerjaan |
| 18 | `job_batches` | Sistem | 10 | Batch antrian pekerjaan |
| 19 | `failed_jobs` | Sistem | 7 | Log pekerjaan gagal |
| | **Total** | | **177 kolom** | **19 tabel** |
