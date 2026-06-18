<?php

namespace Database\Seeders;

use App\Models\Renstra;
use Illuminate\Database\Seeder;

class RenstraSeeder extends Seeder
{
    public function run(): void
    {
        $fakultasIds = \App\Models\Fakultas::pluck('id')->toArray();
        $defaultFakultasId = !empty($fakultasIds) ? $fakultasIds[0] : null;

        $data = [
            ['fakultas_id' => $defaultFakultasId, 'kode' => 'SS1', 'sasaran' => 'Meningkatkan kualitas dan kuantitas penelitian dosen',            'strategi' => 'Mendorong penelitian nasional dan internasional',                    'program_tahunan' => 'Program peningkatan publikasi ilmiah dosen',     'tahun_mulai' => 2021, 'tahun_selesai' => 2025],
            ['fakultas_id' => $defaultFakultasId, 'kode' => 'SS2', 'sasaran' => 'Memperkuat pengabdian masyarakat berbasis riset',                 'strategi' => 'Membangun desa binaan yang berkelanjutan',                           'program_tahunan' => 'Program pengabdian masyarakat desa binaan',     'tahun_mulai' => 2021, 'tahun_selesai' => 2025],
            ['fakultas_id' => $defaultFakultasId, 'kode' => 'SS3', 'sasaran' => 'Meningkatkan akreditasi dan mutu akademik',                       'strategi' => 'Penguatan sistem penjaminan mutu internal',                          'program_tahunan' => 'Program audit mutu akademik terpadu',           'tahun_mulai' => 2026, 'tahun_selesai' => 2030],
            ['fakultas_id' => $defaultFakultasId, 'kode' => 'SS4', 'sasaran' => 'Mengembangkan prestasi mahasiswa di tingkat nasional',            'strategi' => 'Fasilitasi kompetisi dan pengembangan bakat mahasiswa',               'program_tahunan' => 'Program pembinaan prestasi mahasiswa',          'tahun_mulai' => 2026, 'tahun_selesai' => 2030],
            ['fakultas_id' => $defaultFakultasId, 'kode' => 'SS5', 'sasaran' => 'Memperluas kemitraan strategis dengan industri dan pemerintah',   'strategi' => 'Membangun ekosistem kolaborasi tri-dharma',                           'program_tahunan' => 'Program pengembangan jejaring kemitraan',       'tahun_mulai' => 2026, 'tahun_selesai' => 2030],
        ];

        foreach ($data as $item) {
            Renstra::create($item);
        }
    }
}