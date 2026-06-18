<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Renstra;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $renstraIds = Renstra::pluck('id')->toArray();
        $defaultRenstraId = !empty($renstraIds) ? $renstraIds[0] : null;

        $data = [
            // Pendidikan (bidang_id = 1)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.1', 'nama_program' => 'Pengembangan Kurikulum Berbasis KKNI',        'anggaran' => 75000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.2', 'nama_program' => 'Pelatihan Metode Pembelajaran Aktif',         'anggaran' => 45000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.3', 'nama_program' => 'Audit Mutu Akademik',                         'anggaran' => 65000000,  'status' => 'Aktif'],
            // Penelitian dan Pengabdian (bidang_id = 2)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.1', 'nama_program' => 'Hibah Penelitian Internal',                   'anggaran' => 120000000, 'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.2', 'nama_program' => 'Peningkatan Publikasi Ilmiah',                'anggaran' => 95000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.3', 'nama_program' => 'Pengabdian Masyarakat Desa Binaan',           'anggaran' => 80000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.4', 'nama_program' => 'HKI & Paten Karya Dosen',                    'anggaran' => 45000000,  'status' => 'Tidak Aktif'],
            // Kemahasiswaan (bidang_id = 3)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 3, 'kode_program' => '3.1', 'nama_program' => 'Pembinaan Organisasi Kemahasiswaan',          'anggaran' => 40000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 3, 'kode_program' => '3.2', 'nama_program' => 'Kompetisi & Prestasi Mahasiswa',             'anggaran' => 80000000,  'status' => 'Aktif'],
            // Kerjasama & Kemitraan (bidang_id = 4)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 4, 'kode_program' => '4.1', 'nama_program' => 'MOU Kerjasama Nasional',                     'anggaran' => 35000000,  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 4, 'kode_program' => '4.2', 'nama_program' => 'Kerjasama Internasional',                    'anggaran' => 60000000,  'status' => 'Aktif'],
            // Tata Kelola & SDM (bidang_id = 5)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 5, 'kode_program' => '5.1', 'nama_program' => 'Pengembangan SDM Non-Dosen',                 'anggaran' => 60000000,  'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            Program::create($item);
        }
    }
}