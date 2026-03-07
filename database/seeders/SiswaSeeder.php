<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAjaran = '2025/2026';

        $siswa = [
            ['nama' => 'Abigail Tuhuleruw',      'nis' => '2025001', 'kelas' => 'I A',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Ahmad Fauzi Buton',       'nis' => '2025002', 'kelas' => 'I A',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Berlian Papilaya',        'nis' => '2025003', 'kelas' => 'I B',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Calvin Siahaya',          'nis' => '2025004', 'kelas' => 'I B',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Debora Wattimena',        'nis' => '2025005', 'kelas' => 'II A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Elias Soplanit',          'nis' => '2025006', 'kelas' => 'II A',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Felicia Latupeirissa',    'nis' => '2025007', 'kelas' => 'II B',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Gabriel Leimena',         'nis' => '2025008', 'kelas' => 'II B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Hana Pattimura',          'nis' => '2025009', 'kelas' => 'III A', 'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Irfan Manuputty',         'nis' => '2025010', 'kelas' => 'III A', 'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Jasmine Noya',            'nis' => '2025011', 'kelas' => 'III B', 'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Kevin Nikijuluw',         'nis' => '2025012', 'kelas' => 'III B', 'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Laura Marantika',         'nis' => '2025013', 'kelas' => 'IV A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Marco Nanlohy',           'nis' => '2025014', 'kelas' => 'IV A',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Naomi Pelupessy',         'nis' => '2025015', 'kelas' => 'IV B',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Oscar Sapulette',         'nis' => '2025016', 'kelas' => 'IV B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Patricia Siwabessy',      'nis' => '2025017', 'kelas' => 'V A',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Quentin Pattinasarany',   'nis' => '2025018', 'kelas' => 'V A',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Rachel Tehupeiory',       'nis' => '2025019', 'kelas' => 'V B',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Samuel Waisapy',          'nis' => '2025020', 'kelas' => 'V B',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Tania Kissya',            'nis' => '2025021', 'kelas' => 'VI A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Ulrich Rehatta',          'nis' => '2025022', 'kelas' => 'VI A',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Vanny Loppies',           'nis' => '2025023', 'kelas' => 'VI B',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'William Huliselan',       'nis' => '2025024', 'kelas' => 'VI B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Xena Ririhena',           'nis' => '2025025', 'kelas' => 'I A',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Yosua Pattiapon',         'nis' => '2025026', 'kelas' => 'I B',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Zahra Picauly',           'nis' => '2025027', 'kelas' => 'II A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Aldi Maspaitella',        'nis' => '2025028', 'kelas' => 'II B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Bella Sopamena',          'nis' => '2025029', 'kelas' => 'III A', 'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Chandra Tamaela',         'nis' => '2025030', 'kelas' => 'III B', 'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Dini Waas',               'nis' => '2025031', 'kelas' => 'IV A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Eko Louhenapessy',        'nis' => '2025032', 'kelas' => 'IV B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Fiona Sahetapy',          'nis' => '2025033', 'kelas' => 'V A',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Gilang Hattu',            'nis' => '2025034', 'kelas' => 'V B',   'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Hesti Talakua',           'nis' => '2025035', 'kelas' => 'VI A',  'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Ivan Hitipeuw',           'nis' => '2025036', 'kelas' => 'VI B',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Jesika Matulessya',       'nis' => '2025037', 'kelas' => 'I A',   'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Keanu Rahayaan',          'nis' => '2025038', 'kelas' => 'II A',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
            ['nama' => 'Lina Pelu',               'nis' => '2025039', 'kelas' => 'III A', 'jenis_kelamin' => 'P', 'status' => 'aktif'],
            ['nama' => 'Marsel Buton',            'nis' => '2025040', 'kelas' => 'IV A',  'jenis_kelamin' => 'L', 'status' => 'aktif'],
        ];

        foreach ($siswa as $s) {
            Siswa::create(array_merge($s, ['tahun_ajaran' => $tahunAjaran]));
        }
    }
}
