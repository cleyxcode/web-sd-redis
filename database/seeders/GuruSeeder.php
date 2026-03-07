<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $guru = [
            ['nama' => 'Yusuf Rahayaan, S.Pd',         'nip' => '196801021994031002', 'jabatan' => 'Kepala Sekolah',          'mata_pelajaran' => null,              'no_hp' => '081234560001', 'status' => 'aktif'],
            ['nama' => 'Maria Latupeirissa, S.Pd',      'nip' => '197203141998042001', 'jabatan' => 'Guru Kelas I A',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560002', 'status' => 'aktif'],
            ['nama' => 'Petrus Wattimena, S.Pd',        'nip' => '197505221999031003', 'jabatan' => 'Guru Kelas I B',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560003', 'status' => 'aktif'],
            ['nama' => 'Theresia Siahaya, S.Pd',        'nip' => '197804102001042002', 'jabatan' => 'Guru Kelas II A',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560004', 'status' => 'aktif'],
            ['nama' => 'Hendrik Tuhuleruw, S.Pd',       'nip' => '197912302002121001', 'jabatan' => 'Guru Kelas II B',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560005', 'status' => 'aktif'],
            ['nama' => 'Susana Matulessya, S.Pd',       'nip' => '198001152003042001', 'jabatan' => 'Guru Kelas III A',        'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560006', 'status' => 'aktif'],
            ['nama' => 'Antonius Leimena, S.Pd',        'nip' => '198105202004121002', 'jabatan' => 'Guru Kelas III B',        'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560007', 'status' => 'aktif'],
            ['nama' => 'Yuliana Pattimura, S.Pd',       'nip' => '198209082005042001', 'jabatan' => 'Guru Kelas IV A',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560008', 'status' => 'aktif'],
            ['nama' => 'Daniel Sahetapy, S.Pd',         'nip' => '198306172006031003', 'jabatan' => 'Guru Kelas IV B',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560009', 'status' => 'aktif'],
            ['nama' => 'Christina Louhenapessy, S.Pd',  'nip' => '198410252007042002', 'jabatan' => 'Guru Kelas V A',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560010', 'status' => 'aktif'],
            ['nama' => 'Samuel Papilaya, S.Pd',         'nip' => '198512042008121001', 'jabatan' => 'Guru Kelas V B',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560011', 'status' => 'aktif'],
            ['nama' => 'Melinda Hitipeuw, S.Pd',        'nip' => '198701182009042001', 'jabatan' => 'Guru Kelas VI A',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560012', 'status' => 'aktif'],
            ['nama' => 'Benyamin Talakua, S.Pd',        'nip' => '198802252010121002', 'jabatan' => 'Guru Kelas VI B',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560013', 'status' => 'aktif'],
            ['nama' => 'Agnes Lesnussa, S.Pd.I',        'nip' => '198903112011042001', 'jabatan' => 'Guru Pendidikan Agama',   'mata_pelajaran' => 'PAI',             'no_hp' => '081234560014', 'status' => 'aktif'],
            ['nama' => 'Rinto Soplanit, S.Pd',          'nip' => '199001202012121003', 'jabatan' => 'Guru PJOK',               'mata_pelajaran' => 'Penjaskes',       'no_hp' => '081234560015', 'status' => 'aktif'],
            ['nama' => 'Fatima Manuputty, S.Pd',        'nip' => '199103082013042002', 'jabatan' => 'Guru Seni Budaya',        'mata_pelajaran' => 'Seni Budaya',     'no_hp' => '081234560016', 'status' => 'aktif'],
            ['nama' => 'Daud Waas, S.Pd',               'nip' => '199205162014031001', 'jabatan' => 'Guru Bahasa Inggris',     'mata_pelajaran' => 'Bahasa Inggris',  'no_hp' => '081234560017', 'status' => 'aktif'],
            ['nama' => 'Naomi Noya, S.Kom',             'nip' => '199307242015042001', 'jabatan' => 'Guru TIK',                'mata_pelajaran' => 'TIK',             'no_hp' => '081234560018', 'status' => 'aktif'],
            ['nama' => 'Ezra Nikijuluw, S.Pd',          'nip' => '199409012016121002', 'jabatan' => 'Guru Mulok',              'mata_pelajaran' => 'Muatan Lokal',    'no_hp' => '081234560019', 'status' => 'aktif'],
            ['nama' => 'Gracia Pelu, A.Md',             'nip' => null,                 'jabatan' => 'Operator Sekolah',         'mata_pelajaran' => null,              'no_hp' => '081234560020', 'status' => 'aktif'],
            ['nama' => 'Henderikus Hattu, S.Pd',        'nip' => '198501122005031004', 'jabatan' => 'Guru Kelas III C',        'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560021', 'status' => 'aktif'],
            ['nama' => 'Irene Marantika, S.Pd',         'nip' => '198603192006042003', 'jabatan' => 'Guru Kelas IV C',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560022', 'status' => 'aktif'],
            ['nama' => 'Johanes Nanlohy, S.Pd',         'nip' => '198705272007121004', 'jabatan' => 'Guru Kelas V C',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560023', 'status' => 'aktif'],
            ['nama' => 'Kornelia Pelupessy, S.Pd',      'nip' => '198807042008042003', 'jabatan' => 'Guru Kelas VI C',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560024', 'status' => 'aktif'],
            ['nama' => 'Levi Sapulette, S.Pd',          'nip' => '198909122009121005', 'jabatan' => 'Guru BK',                 'mata_pelajaran' => 'Bimbingan Konseling', 'no_hp' => '081234560025', 'status' => 'aktif'],
            ['nama' => 'Martha Siwabessy, S.Pd',        'nip' => '199011202010042004', 'jabatan' => 'Guru Kelas I C',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560026', 'status' => 'aktif'],
            ['nama' => 'Naftali Pattinasarany, S.Pd',   'nip' => '199112282011121006', 'jabatan' => 'Guru Kelas II C',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560027', 'status' => 'aktif'],
            ['nama' => 'Olivia Tehupeiory, S.Pd',       'nip' => '199204062012042005', 'jabatan' => 'Guru PAK',                'mata_pelajaran' => 'Pendidikan Agama Kristen', 'no_hp' => '081234560028', 'status' => 'aktif'],
            ['nama' => 'Philipus Waisapy, S.Pd',        'nip' => '199306142013121007', 'jabatan' => 'Guru Matematika',         'mata_pelajaran' => 'Matematika',      'no_hp' => '081234560029', 'status' => 'aktif'],
            ['nama' => 'Ruth Kissya, S.Pd',             'nip' => '199408222014042006', 'jabatan' => 'Guru Bahasa Indonesia',   'mata_pelajaran' => 'Bahasa Indonesia', 'no_hp' => '081234560030', 'status' => 'aktif'],
            ['nama' => 'Stevanus Rehatta, S.Pd',        'nip' => '199510302015121008', 'jabatan' => 'Guru IPA',                'mata_pelajaran' => 'IPA',             'no_hp' => '081234560031', 'status' => 'aktif'],
            ['nama' => 'Tina Loppies, S.Pd',            'nip' => '199612082016042007', 'jabatan' => 'Guru IPS',                'mata_pelajaran' => 'IPS',             'no_hp' => '081234560032', 'status' => 'aktif'],
            ['nama' => 'Usman Buton, S.Pd.I',           'nip' => '199714162017121009', 'jabatan' => 'Guru Agama Islam',        'mata_pelajaran' => 'PAI',             'no_hp' => '081234560033', 'status' => 'aktif'],
            ['nama' => 'Veronika Picauly, S.Pd',        'nip' => '199816242018042008', 'jabatan' => 'Guru Tata Usaha',         'mata_pelajaran' => null,              'no_hp' => '081234560034', 'status' => 'aktif'],
            ['nama' => 'Wilhelmus Maspaitella, S.Pd',   'nip' => '199918022019121010', 'jabatan' => 'Penjaga Sekolah',         'mata_pelajaran' => null,              'no_hp' => '081234560035', 'status' => 'aktif'],
            ['nama' => 'Xenia Sopamena, S.Pd',          'nip' => '200020102020042009', 'jabatan' => 'Guru Kelas I D',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560036', 'status' => 'aktif'],
            ['nama' => 'Yolanda Tamaela, S.Pd',         'nip' => '200122182021121011', 'jabatan' => 'Guru Kelas II D',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560037', 'status' => 'aktif'],
            ['nama' => 'Zakarias Huliselan, S.Pd',      'nip' => '200224262022031001', 'jabatan' => 'Guru Kelas III D',        'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560038', 'status' => 'aktif'],
            ['nama' => 'Andreas Pattiapon, S.Pd',       'nip' => '200326042023121012', 'jabatan' => 'Guru Kelas IV D',         'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560039', 'status' => 'aktif'],
            ['nama' => 'Beatrix Ririhena, S.Pd',        'nip' => '200428122024042010', 'jabatan' => 'Guru Kelas V D',          'mata_pelajaran' => 'Tematik',         'no_hp' => '081234560040', 'status' => 'aktif'],
        ];

        foreach ($guru as $g) {
            Guru::create($g);
        }
    }
}
