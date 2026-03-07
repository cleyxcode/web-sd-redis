<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::create([
            'nama_sekolah'       => 'SD Negeri Warialau',
            'kepala_sekolah'     => 'Yusuf Rahayaan, S.Pd',
            'akreditasi'         => 'B',
            'tahun_berdiri'      => '1980',
            'jumlah_ruang_kelas' => 12,
            'visi'               => 'Terwujudnya peserta didik yang cerdas, berkarakter mulia, berwawasan luas, berbudaya, dan berdaya saing tinggi berlandaskan iman dan takwa kepada Tuhan Yang Maha Esa.',
            'misi'               => "1. Menyelenggarakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan (PAIKEM)\n2. Mengembangkan potensi peserta didik secara optimal melalui berbagai kegiatan akademik dan non-akademik\n3. Menanamkan nilai-nilai karakter bangsa yang berlandaskan Pancasila dan Bhinneka Tunggal Ika\n4. Membangun budaya literasi dan numerasi sebagai fondasi pembelajaran sepanjang hayat\n5. Menjalin kemitraan yang harmonis antara sekolah, keluarga, dan masyarakat\n6. Melestarikan budaya dan kearifan lokal Maluku sebagai identitas dan kebanggaan bersama\n7. Mewujudkan lingkungan sekolah yang bersih, sehat, aman, dan kondusif untuk belajar",
            'sejarah'            => "SD Negeri Warialau didirikan pada tahun 1980 atas prakarsa masyarakat Warialau yang menyadari pentingnya pendidikan bagi generasi penerus bangsa. Pada awal berdirinya, sekolah ini hanya memiliki tiga ruang kelas dengan fasilitas yang sangat sederhana dan tenaga pengajar yang terbatas.\n\nDengan semangat pantang menyerah dan dukungan penuh dari seluruh lapisan masyarakat, sekolah ini terus berkembang dari tahun ke tahun. Pada dekade 1990-an, sekolah mendapatkan bantuan pembangunan gedung baru dari pemerintah daerah sehingga dapat menampung lebih banyak peserta didik.\n\nMemasuki abad ke-21, SD Negeri Warialau terus berinovasi dalam bidang pembelajaran. Dengan dukungan tenaga pendidik yang kompeten dan berdedikasi tinggi, sekolah ini berhasil mencetak banyak alumni yang sukses di berbagai bidang kehidupan, mulai dari profesional, akademisi, hingga tokoh masyarakat yang memberikan kontribusi nyata bagi kemajuan Kepulauan Aru dan Maluku pada umumnya.",
            'alamat'             => 'Jl. Pendidikan No. 1, Warialau, Kec. Aru Utara, Kab. Kepulauan Aru, Maluku 97662',
            'kontak'             => '085243210001',
        ]);
    }
}
