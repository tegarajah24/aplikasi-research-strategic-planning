<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_bidang' => 'BD-01', 'nama_bidang' => 'Pendidikan',                   'deskripsi' => 'Bidang yang mencakup seluruh kegiatan pengembangan kurikulum, pembelajaran, dan mutu akademik.', 'status' => 'Aktif'],
            ['kode_bidang' => 'BD-02', 'nama_bidang' => 'Penelitian dan Pengabdian',    'deskripsi' => 'Mencakup kegiatan penelitian ilmiah, pengabdian masyarakat, dan publikasi karya dosen.', 'status' => 'Aktif'],
            ['kode_bidang' => 'BD-03', 'nama_bidang' => 'Kemahasiswaan',                 'deskripsi' => 'Kegiatan pembinaan, pengembangan minat-bakat, dan kesejahteraan mahasiswa.', 'status' => 'Aktif'],
            ['kode_bidang' => 'BD-04', 'nama_bidang' => 'Kerjasama & Kemitraan',        'deskripsi' => 'Pengelolaan MOU, kerjasama dengan industri, pemerintah, dan lembaga internasional.', 'status' => 'Aktif'],
            ['kode_bidang' => 'BD-05', 'nama_bidang' => 'Tata Kelola & SDM',            'deskripsi' => 'Pengembangan sumber daya manusia, penguatan kelembagaan, dan tata kelola organisasi.', 'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            Bidang::create($item);
        }
    }
}
