<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_anak' => 'Alfa Tuhuleruw',       'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-04-12', 'ttl' => 'Warialau',  'ayah' => 'Benyamin Tuhuleruw',   'ibu' => 'Serly Latupeirissa',   'no_hp' => '081211110001', 'status' => 'diterima'],
            ['nama_anak' => 'Bintang Wattimena',    'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-06-20', 'ttl' => 'Dobo',      'ayah' => 'Ferdi Wattimena',      'ibu' => 'Yenny Siahaya',        'no_hp' => '081211110002', 'status' => 'diterima'],
            ['nama_anak' => 'Citra Soplanit',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2019-08-15', 'ttl' => 'Warialau',  'ayah' => 'Ricky Soplanit',       'ibu' => 'Ester Manuputty',      'no_hp' => '081211110003', 'status' => 'diterima'],
            ['nama_anak' => 'Dito Leimena',         'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-02-28', 'ttl' => 'Ambon',     'ayah' => 'Hendra Leimena',       'ibu' => 'Mira Pattimura',       'no_hp' => '081211110004', 'status' => 'diterima'],
            ['nama_anak' => 'Elsa Nikijuluw',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2019-11-03', 'ttl' => 'Warialau',  'ayah' => 'David Nikijuluw',      'ibu' => 'Susi Noya',            'no_hp' => '081211110005', 'status' => 'diterima'],
            ['nama_anak' => 'Fajar Buton',          'jk' => 'L', 'agama' => 'Islam',             'tl' => '2019-07-19', 'ttl' => 'Dobo',      'ayah' => 'Amir Buton',           'ibu' => 'Halimah Manuputty',    'no_hp' => '081211110006', 'status' => 'diterima'],
            ['nama_anak' => 'Grace Papilaya',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2019-09-22', 'ttl' => 'Warialau',  'ayah' => 'George Papilaya',      'ibu' => 'Ruth Hitipeuw',        'no_hp' => '081211110007', 'status' => 'diterima'],
            ['nama_anak' => 'Hary Talakua',         'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-01-14', 'ttl' => 'Ambon',     'ayah' => 'Polce Talakua',        'ibu' => 'Agnes Louhenapessy',   'no_hp' => '081211110008', 'status' => 'diterima'],
            ['nama_anak' => 'Intan Marantika',      'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2019-05-30', 'ttl' => 'Warialau',  'ayah' => 'Ronald Marantika',     'ibu' => 'Tini Sahetapy',        'no_hp' => '081211110009', 'status' => 'diterima'],
            ['nama_anak' => 'Joko Sapulette',       'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-10-08', 'ttl' => 'Dobo',      'ayah' => 'Anton Sapulette',      'ibu' => 'Dewi Siwabessy',       'no_hp' => '081211110010', 'status' => 'diterima'],
            ['nama_anak' => 'Kira Pattinasarany',   'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2019-03-17', 'ttl' => 'Warialau',  'ayah' => 'Lukas Pattinasarany',  'ibu' => 'Lena Tehupeiory',      'no_hp' => '081211110011', 'status' => 'diterima'],
            ['nama_anak' => 'Leon Kissya',          'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2019-12-25', 'ttl' => 'Ambon',     'ayah' => 'Piet Kissya',          'ibu' => 'Voni Waisapy',         'no_hp' => '081211110012', 'status' => 'diterima'],
            ['nama_anak' => 'Maya Rehatta',         'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-01-09', 'ttl' => 'Warialau',  'ayah' => 'Edo Rehatta',          'ibu' => 'Cece Loppies',         'no_hp' => '081211110013', 'status' => 'diterima'],
            ['nama_anak' => 'Nando Huliselan',      'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-04-23', 'ttl' => 'Dobo',      'ayah' => 'Tino Huliselan',       'ibu' => 'Maria Ririhena',       'no_hp' => '081211110014', 'status' => 'diterima'],
            ['nama_anak' => 'Olivia Pattiapon',     'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-07-11', 'ttl' => 'Warialau',  'ayah' => 'Simon Pattiapon',      'ibu' => 'Lita Picauly',         'no_hp' => '081211110015', 'status' => 'diterima'],
            ['nama_anak' => 'Putra Maspaitella',    'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-02-14', 'ttl' => 'Ambon',     'ayah' => 'Yanto Maspaitella',    'ibu' => 'Rina Sopamena',        'no_hp' => '081211110016', 'status' => 'pending'],
            ['nama_anak' => 'Qory Tamaela',         'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-09-06', 'ttl' => 'Warialau',  'ayah' => 'Bob Tamaela',          'ibu' => 'Nely Waas',            'no_hp' => '081211110017', 'status' => 'pending'],
            ['nama_anak' => 'Rafi Pelupessy',       'jk' => 'L', 'agama' => 'Islam',             'tl' => '2020-11-30', 'ttl' => 'Dobo',      'ayah' => 'Karim Pelupessy',      'ibu' => 'Siti Hattu',           'no_hp' => '081211110018', 'status' => 'pending'],
            ['nama_anak' => 'Sinta Matulessya',     'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-03-25', 'ttl' => 'Warialau',  'ayah' => 'Frits Matulessya',     'ibu' => 'Yuli Nanlohy',         'no_hp' => '081211110019', 'status' => 'pending'],
            ['nama_anak' => 'Tomi Rahayaan',        'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-06-18', 'ttl' => 'Ambon',     'ayah' => 'Leo Rahayaan',         'ibu' => 'Desi Pelu',            'no_hp' => '081211110020', 'status' => 'pending'],
            ['nama_anak' => 'Umi Lesnussa',         'jk' => 'P', 'agama' => 'Islam',             'tl' => '2020-08-13', 'ttl' => 'Warialau',  'ayah' => 'Umar Lesnussa',        'ibu' => 'Fatima Hattu',         'no_hp' => '081211110021', 'status' => 'pending'],
            ['nama_anak' => 'Vito Louhenapessy',    'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-10-01', 'ttl' => 'Dobo',      'ayah' => 'Theo Louhenapessy',    'ibu' => 'Grace Leimena',        'no_hp' => '081211110022', 'status' => 'pending'],
            ['nama_anak' => 'Wina Sahetapy',        'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-05-07', 'ttl' => 'Warialau',  'ayah' => 'Bram Sahetapy',        'ibu' => 'Ria Papilaya',         'no_hp' => '081211110023', 'status' => 'pending'],
            ['nama_anak' => 'Xander Siwabessy',     'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-12-20', 'ttl' => 'Ambon',     'ayah' => 'Nico Siwabessy',       'ibu' => 'Jessy Talakua',        'no_hp' => '081211110024', 'status' => 'pending'],
            ['nama_anak' => 'Yara Waisapy',         'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-02-28', 'ttl' => 'Warialau',  'ayah' => 'Ocky Waisapy',         'ibu' => 'Pina Kissya',          'no_hp' => '081211110025', 'status' => 'pending'],
            ['nama_anak' => 'Zaki Hitipeuw',        'jk' => 'L', 'agama' => 'Islam',             'tl' => '2020-07-04', 'ttl' => 'Dobo',      'ayah' => 'Saleh Hitipeuw',       'ibu' => 'Nur Buton',            'no_hp' => '081211110026', 'status' => 'pending'],
            ['nama_anak' => 'Ayu Latupeirissa',     'jk' => 'P', 'agama' => 'Islam',             'tl' => '2020-09-16', 'ttl' => 'Warialau',  'ayah' => 'Ahmad Latupeirissa',   'ibu' => 'Sari Manuputty',       'no_hp' => '081211110027', 'status' => 'ditolak'],
            ['nama_anak' => 'Budi Nikijuluw',       'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-11-11', 'ttl' => 'Ambon',     'ayah' => 'Paul Nikijuluw',       'ibu' => 'Emi Noya',             'no_hp' => '081211110028', 'status' => 'ditolak'],
            ['nama_anak' => 'Cici Pattimura',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-04-02', 'ttl' => 'Warialau',  'ayah' => 'Hans Pattimura',       'ibu' => 'Lena Soplanit',        'no_hp' => '081211110029', 'status' => 'diterima'],
            ['nama_anak' => 'Doni Wattimena',       'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-06-29', 'ttl' => 'Dobo',      'ayah' => 'Yanes Wattimena',      'ibu' => 'Sory Siahaya',         'no_hp' => '081211110030', 'status' => 'diterima'],
            ['nama_anak' => 'Eva Tehupeiory',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-08-08', 'ttl' => 'Warialau',  'ayah' => 'Rocky Tehupeiory',     'ibu' => 'Fitri Rehatta',        'no_hp' => '081211110031', 'status' => 'diterima'],
            ['nama_anak' => 'Fito Loppies',         'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-10-14', 'ttl' => 'Ambon',     'ayah' => 'Santo Loppies',        'ibu' => 'Reny Huliselan',       'no_hp' => '081211110032', 'status' => 'diterima'],
            ['nama_anak' => 'Gita Ririhena',        'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-01-21', 'ttl' => 'Warialau',  'ayah' => 'Alex Ririhena',        'ibu' => 'Ines Pattiapon',       'no_hp' => '081211110033', 'status' => 'diterima'],
            ['nama_anak' => 'Hendra Picauly',       'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-03-10', 'ttl' => 'Dobo',      'ayah' => 'Julius Picauly',       'ibu' => 'Sely Maspaitella',     'no_hp' => '081211110034', 'status' => 'diterima'],
            ['nama_anak' => 'Ira Sopamena',         'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-05-26', 'ttl' => 'Warialau',  'ayah' => 'Chris Sopamena',       'ibu' => 'Ana Tamaela',          'no_hp' => '081211110035', 'status' => 'diterima'],
            ['nama_anak' => 'Juni Waas',            'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-07-17', 'ttl' => 'Ambon',     'ayah' => 'Patrick Waas',         'ibu' => 'Yeti Pelupessy',       'no_hp' => '081211110036', 'status' => 'pending'],
            ['nama_anak' => 'Kaya Marantika',       'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-09-04', 'ttl' => 'Warialau',  'ayah' => 'Haris Marantika',      'ibu' => 'Enny Sahetapy',        'no_hp' => '081211110037', 'status' => 'pending'],
            ['nama_anak' => 'Lando Sapulette',      'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-11-22', 'ttl' => 'Dobo',      'ayah' => 'Ronny Sapulette',      'ibu' => 'Martha Siwabessy',     'no_hp' => '081211110038', 'status' => 'pending'],
            ['nama_anak' => 'Mona Pattinasarany',   'jk' => 'P', 'agama' => 'Kristen Protestan', 'tl' => '2020-02-09', 'ttl' => 'Warialau',  'ayah' => 'Sem Pattinasarany',    'ibu' => 'Lena Tehupeiory',      'no_hp' => '081211110039', 'status' => 'pending'],
            ['nama_anak' => 'Nicky Kisssya',        'jk' => 'L', 'agama' => 'Kristen Protestan', 'tl' => '2020-04-19', 'ttl' => 'Ambon',     'ayah' => 'Dave Kissya',          'ibu' => 'Wina Rehatta',         'no_hp' => '081211110040', 'status' => 'pending'],
        ];

        foreach ($data as $item) {
            // Buat user orangtua
            $user = User::firstOrCreate(
                ['no_hp' => $item['no_hp']],
                [
                    'name'     => $item['ayah'] ?: $item['ibu'],
                    'email'    => $item['no_hp'] . '@pendaftaran.local',
                    'password' => Hash::make($item['no_hp']),
                    'role'     => 'orangtua',
                    'no_hp'    => $item['no_hp'],
                ]
            );

            Pendaftaran::create([
                'user_id'             => $user->id,
                'info_pendaftaran_id' => 2, // ID InfoPendaftaran aktif
                'nama_anak'           => $item['nama_anak'],
                'tempat_lahir'        => $item['ttl'],
                'tanggal_lahir'       => $item['tl'],
                'jenis_kelamin'       => $item['jk'],
                'agama'               => $item['agama'],
                'anak_ke'             => rand(1, 4),
                'asal_sekolah'        => null,
                'nik'                 => null,
                'no_kk'               => null,
                'alamat'              => 'Warialau, Kec. Aru Utara, Kab. Kepulauan Aru, Maluku',
                'nama_ayah'           => $item['ayah'],
                'pekerjaan_ayah'      => 'Nelayan',
                'nama_ibu'            => $item['ibu'],
                'pekerjaan_ibu'       => 'Ibu Rumah Tangga',
                'nama_wali'           => null,
                'no_hp'               => $item['no_hp'],
                'dokumen'             => null,
                'status'              => $item['status'],
            ]);
        }
    }
}
