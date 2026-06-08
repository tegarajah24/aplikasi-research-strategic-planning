<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Pendidikan (bidang_id = 1)
            ['bidang_id' => 1, 'kode_program' => '1.1', 'nama_program' => 'Pengembangan Kurikulum Berbasis KKNI',        'sasaran' => 'Kurikulum terintegrasi & relevan dengan industri',      'strategi_renstra' => 'Peningkatan mutu akademik berkelanjutan',        'program_tahunan' => 'RKT 2026 — Prioritas A', 'anggaran' => 75000000,  'status' => 'Aktif'],
            ['bidang_id' => 1, 'kode_program' => '1.2', 'nama_program' => 'Pelatihan Metode Pembelajaran Aktif',         'sasaran' => 'Dosen menguasai metode student-centered learning',      'strategi_renstra' => 'Pengembangan kompetensi pendidik',              'program_tahunan' => 'RKT 2026 — Prioritas B', 'anggaran' => 45000000,  'status' => 'Aktif'],
            ['bidang_id' => 1, 'kode_program' => '1.3', 'nama_program' => 'Audit Mutu Akademik',                         'sasaran' => 'Skor akreditasi meningkat minimal 1 level',             'strategi_renstra' => 'Penjaminan mutu internal & eksternal',          'program_tahunan' => 'RKT 2026 — Prioritas A', 'anggaran' => 65000000,  'status' => 'Aktif'],
            // Penelitian dan Pengabdian (bidang_id = 2)
            ['bidang_id' => 2, 'kode_program' => '2.1', 'nama_program' => 'Hibah Penelitian Internal',                   'sasaran' => '30 penelitian dosen per tahun terfasilitasi',           'strategi_renstra' => 'Mendorong budaya riset & inovasi',              'program_tahunan' => 'RKT 2026 — Prioritas A', 'anggaran' => 120000000, 'status' => 'Aktif'],
            ['bidang_id' => 2, 'kode_program' => '2.2', 'nama_program' => 'Peningkatan Publikasi Ilmiah',                'sasaran' => '50 artikel terindeks Scopus/WoS per tahun',             'strategi_renstra' => 'Akselerasi output penelitian bereputasi',       'program_tahunan' => 'RKT 2026 — Prioritas A', 'anggaran' => 95000000,  'status' => 'Aktif'],
            ['bidang_id' => 2, 'kode_program' => '2.3', 'nama_program' => 'Pengabdian Masyarakat Desa Binaan',           'sasaran' => '10 desa mitra mendapat pendampingan aktif',             'strategi_renstra' => 'Tridarma — pengabdian berbasis riset',          'program_tahunan' => 'RKT 2026 — Prioritas B', 'anggaran' => 80000000,  'status' => 'Aktif'],
            ['bidang_id' => 2, 'kode_program' => '2.4', 'nama_program' => 'HKI & Paten Karya Dosen',                    'sasaran' => '15 HKI / paten baru per tahun',                        'strategi_renstra' => 'Perlindungan kekayaan intelektual civitas',     'program_tahunan' => 'RKT 2026 — Prioritas C', 'anggaran' => 45000000,  'status' => 'Tidak Aktif'],
            // Kemahasiswaan (bidang_id = 3)
            ['bidang_id' => 3, 'kode_program' => '3.1', 'nama_program' => 'Pembinaan Organisasi Kemahasiswaan',          'sasaran' => 'BEM & UKM aktif & berprestasi',                         'strategi_renstra' => 'Penguatan karakter & kepemimpinan mahasiswa',   'program_tahunan' => 'RKT 2026 — Prioritas B', 'anggaran' => 40000000,  'status' => 'Aktif'],
            ['bidang_id' => 3, 'kode_program' => '3.2', 'nama_program' => 'Kompetisi & Prestasi Mahasiswa',             'sasaran' => '100+ mahasiswa berprestasi tingkat nasional',           'strategi_renstra' => 'Fasilitasi pengembangan bakat & kompetisi',     'program_tahunan' => 'RKT 2026 — Prioritas A', 'anggaran' => 80000000,  'status' => 'Aktif'],
            // Kerjasama & Kemitraan (bidang_id = 4)
            ['bidang_id' => 4, 'kode_program' => '4.1', 'nama_program' => 'MOU Kerjasama Nasional',                     'sasaran' => '25 MOU aktif dengan industri & pemerintah',            'strategi_renstra' => 'Perluasan jaringan & ekosistem kemitraan',      'program_tahunan' => 'RKT 2026 — Prioritas B', 'anggaran' => 35000000,  'status' => 'Aktif'],
            ['bidang_id' => 4, 'kode_program' => '4.2', 'nama_program' => 'Kerjasama Internasional',                    'sasaran' => '5 MOU internasional baru per tahun',                   'strategi_renstra' => 'Internasionalisasi kampus',                    'program_tahunan' => 'RKT 2026 — Prioritas C', 'anggaran' => 60000000,  'status' => 'Aktif'],
            // Tata Kelola & SDM (bidang_id = 5)
            ['bidang_id' => 5, 'kode_program' => '5.1', 'nama_program' => 'Pengembangan SDM Non-Dosen',                 'sasaran' => '90% tenaga kependidikan tersertifikasi',                'strategi_renstra' => 'Peningkatan profesionalitas tenaga pendukung',  'program_tahunan' => 'RKT 2026 — Prioritas C', 'anggaran' => 60000000,  'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            Program::create($item);
        }
    }
}
