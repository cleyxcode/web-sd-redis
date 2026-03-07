<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeri = [
            ['judul' => 'Upacara Bendera HUT RI ke-80',             'keterangan' => 'Pelaksanaan upacara bendera memperingati Hari Kemerdekaan RI yang ke-80 di lapangan sekolah.'],
            ['judul' => 'Pentas Seni Budaya Maluku',                'keterangan' => 'Siswa menampilkan tarian dan nyanyian khas Maluku dalam acara pentas seni akhir tahun.'],
            ['judul' => 'Lomba Cerdas Cermat Tingkat Kecamatan',    'keterangan' => 'Tim cerdas cermat SD Negeri Warialau berhasil meraih juara pertama di tingkat kecamatan.'],
            ['judul' => 'Kegiatan Pramuka Siaga dan Penggalang',    'keterangan' => 'Latihan rutin pramuka yang melatih kemandirian dan kerja sama tim siswa.'],
            ['judul' => 'Wisuda Kelas VI Tahun Ajaran 2024/2025',   'keterangan' => 'Momen perpisahan dan wisuda siswa kelas VI yang telah menyelesaikan studi di sekolah kami.'],
            ['judul' => 'Program Literasi Pagi Setiap Hari',        'keterangan' => 'Siswa membaca buku sebelum jam pelajaran dimulai sebagai bagian dari program literasi harian.'],
            ['judul' => 'Gotong Royong Bersih Lingkungan Sekolah',  'keterangan' => 'Seluruh warga sekolah bersama-sama membersihkan lingkungan dalam rangka Hari Lingkungan Hidup.'],
            ['judul' => 'Kunjungan Belajar ke Museum Siwa Lima',    'keterangan' => 'Siswa kelas V mengunjungi Museum Siwa Lima di Ambon untuk belajar sejarah Maluku secara langsung.'],
            ['judul' => 'Lomba Menggambar Tema Kelautan',           'keterangan' => 'Lomba menggambar dalam rangka Hari Maritim Nasional diikuti siswa kelas rendah dengan antusias.'],
            ['judul' => 'Pelatihan Dokter Kecil bersama Puskesmas', 'keterangan' => 'Siswa terpilih mengikuti pelatihan kesehatan dasar bersama tenaga medis dari puskesmas setempat.'],
            ['judul' => 'Turnamen Bulu Tangkis Antar Kelas',        'keterangan' => 'Turnamen olahraga antar kelas yang memupuk sportivitas dan semangat kompetisi yang sehat.'],
            ['judul' => 'Workshop Parenting Mendidik Anak Digital', 'keterangan' => 'Orang tua bersama guru mendiskusikan cara mendidik anak di era digital dalam workshop bersama.'],
            ['judul' => 'Olimpiade Matematika Se-Kabupaten',        'keterangan' => 'Tim olimpiade matematika sekolah saat menerima medali dalam kompetisi tingkat kabupaten.'],
            ['judul' => 'Bakti Sosial Bagi Sembako Warga',         'keterangan' => 'Siswa turut serta dalam kegiatan bakti sosial membagikan sembako kepada warga sekitar sekolah.'],
            ['judul' => 'Festival Budaya Maluku Tahunan',           'keterangan' => 'Perhelatan festival budaya tahunan yang menampilkan kekayaan seni dan tradisi Maluku.'],
            ['judul' => 'Simulasi Evakuasi Bencana Gempa Bumi',     'keterangan' => 'Latihan kesiapsiagaan menghadapi bencana alam yang diselenggarakan bersama BPBD kabupaten.'],
            ['judul' => 'Penghijauan dan Tanam Pohon Baru',        'keterangan' => 'Siswa menanam bibit pohon sebagai bagian dari program adiwiyata sekolah peduli lingkungan.'],
            ['judul' => 'Pameran Karya Siswa Semester Ganjil',     'keterangan' => 'Pameran yang menampilkan karya-karya terbaik siswa dari berbagai mata pelajaran dan ekskul.'],
            ['judul' => 'Seminar Anti Bullying untuk Siswa',        'keterangan' => 'Kegiatan seminar yang mendidik siswa tentang bahaya perundungan dan cara mencegahnya.'],
            ['judul' => 'Pelatihan Komputer untuk Kelas Tinggi',    'keterangan' => 'Siswa kelas IV-VI belajar mengoperasikan komputer dan menggunakan internet secara aman.'],
            ['judul' => 'Khataman Al-Quran Siswa Muslim',           'keterangan' => 'Syukuran khataman Al-Quran yang diikuti oleh siswa-siswa muslim berprestasi dari sekolah.'],
            ['judul' => 'Pemilihan Ketua OSIS Secara Demokratis',  'keterangan' => 'Proses pemilihan ketua OSIS yang mengajarkan nilai demokrasi kepada siswa sejak dini.'],
            ['judul' => 'Tes Kesehatan Rutin dan Pemeriksaan Gigi', 'keterangan' => 'Tim medis puskesmas memberikan layanan pemeriksaan kesehatan dan gigi gratis untuk siswa.'],
            ['judul' => 'Pelatihan Menulis Kreatif Club Literasi',  'keterangan' => 'Anggota Club Literasi belajar menulis cerita pendek dan puisi dari penulis muda Ambon.'],
            ['judul' => 'Rapat Pleno Wali Murid Awal Semester',    'keterangan' => 'Pertemuan orang tua dan guru untuk membahas program sekolah dan perkembangan siswa.'],
            ['judul' => 'Kelas Memasak Kuliner Tradisional Maluku', 'keterangan' => 'Siswa belajar membuat papeda dan masakan khas Maluku dipandu ibu-ibu PKK setempat.'],
            ['judul' => 'Peringatan Hari Guru Nasional 2025',       'keterangan' => 'Siswa mempersembahkan puisi dan nyanyian sebagai ungkapan terima kasih kepada para guru.'],
            ['judul' => 'Pojok Baca Baru di Sudut Sekolah',        'keterangan' => 'Fasilitas pojok baca yang nyaman tersebar di beberapa sudut sekolah untuk mendorong minat baca.'],
            ['judul' => 'Lomba Baca Puisi Bulan Bahasa Oktober',   'keterangan' => 'Kompetisi membaca puisi antar kelas dalam rangka memperingati Bulan Bahasa Indonesia.'],
            ['judul' => 'Sosialisasi Pendaftaran Siswa Baru 2026',  'keterangan' => 'Calon orang tua murid mendapatkan informasi pendaftaran dari pihak sekolah secara langsung.'],
            ['judul' => 'Ruang Kelas Baru yang Modern dan Nyaman',  'keterangan' => 'Dua ruang kelas baru yang telah selesai direnovasi dan siap digunakan oleh siswa.'],
            ['judul' => 'Peluncuran Program Makan Bergizi Gratis',  'keterangan' => 'Siswa menikmati makan bergizi gratis sebagai bagian dari program pemerintah pusat.'],
            ['judul' => 'Tim Robotika Pertama Sekolah Kami',        'keterangan' => 'Enam siswa berlatih merakit dan memprogram robot untuk kompetisi pertama mereka.'],
            ['judul' => 'Hari Anak Nasional: Lomba Kreasi Siswa',  'keterangan' => 'Berbagai perlombaan kreatif digelar dalam rangka memperingati Hari Anak Nasional.'],
            ['judul' => 'Pembinaan Nilai-Nilai Pancasila Pagi Hari','keterangan' => 'Setiap pagi siswa membacakan dan mendiskusikan penerapan Pancasila dalam kehidupan sehari-hari.'],
            ['judul' => 'Supervisi Akademik Dinas Pendidikan',      'keterangan' => 'Tim pengawas dari dinas pendidikan melakukan observasi kelas dan dialog dengan para guru.'],
            ['judul' => 'Program Beasiswa Siswa Berprestasi',       'keterangan' => 'Penyerahan beasiswa kepada siswa berprestasi dari keluarga kurang mampu oleh kepala sekolah.'],
            ['judul' => 'Kegiatan Olahraga Pagi Bersama Siswa',    'keterangan' => 'Senam pagi bersama yang rutin dilaksanakan setiap Jumat untuk menjaga kesehatan seluruh siswa.'],
            ['judul' => 'Penerimaan Rapor Akhir Semester Ganjil',   'keterangan' => 'Orang tua menerima laporan hasil belajar semester ganjil dari wali kelas masing-masing.'],
            ['judul' => 'Suasana Belajar Mengajar di Kelas',        'keterangan' => 'Dokumentasi kegiatan belajar mengajar yang aktif dan interaktif di ruang kelas.'],
        ];

        foreach ($galeri as $item) {
            Galeri::create(array_merge($item, ['user_id' => 1, 'foto' => 'galeri/placeholder.jpg']));
        }
    }
}
