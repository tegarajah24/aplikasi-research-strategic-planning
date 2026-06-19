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
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.1', 'nama_program' => 'Pengembangan Kurikulum Berbasis KKNI',        'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.2', 'nama_program' => 'Pelatihan Metode Pembelajaran Aktif',         'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 1, 'kode_program' => '1.3', 'nama_program' => 'Audit Mutu Akademik',                         'status' => 'Aktif'],
            // Penelitian dan Pengabdian (bidang_id = 2)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.1', 'nama_program' => 'Hibah Penelitian Internal',                   'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.2', 'nama_program' => 'Peningkatan Publikasi Ilmiah',                'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.3', 'nama_program' => 'Pengabdian Masyarakat Desa Binaan',           'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 2, 'kode_program' => '2.4', 'nama_program' => 'HKI & Paten Karya Dosen',                    'status' => 'Tidak Aktif'],
            // Kemahasiswaan (bidang_id = 3)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 3, 'kode_program' => '3.1', 'nama_program' => 'Pembinaan Organisasi Kemahasiswaan',          'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 3, 'kode_program' => '3.2', 'nama_program' => 'Kompetisi & Prestasi Mahasiswa',             'status' => 'Aktif'],
            // Kerjasama & Kemitraan (bidang_id = 4)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 4, 'kode_program' => '4.1', 'nama_program' => 'MOU Kerjasama Nasional',                     'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 4, 'kode_program' => '4.2', 'nama_program' => 'Kerjasama Internasional',                    'status' => 'Aktif'],
            // Tata Kelola & SDM (bidang_id = 5)
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => 5, 'kode_program' => '5.1', 'nama_program' => 'Pengembangan SDM Non-Dosen',                 'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            Program::create($item);
        }
    }
}