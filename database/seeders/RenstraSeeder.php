<?php

namespace Database\Seeders;

use App\Models\Renstra;
use Illuminate\Database\Seeder;

class RenstraSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'SS1', 'sasaran' => 'Meningkatkan kualitas dan kuantitas penelitian dosen',            'strategi' => 'Mendorong penelitian nasional dan internasional',                    'program_tahunan' => 'Program peningkatan publikasi ilmiah dosen',     'periode' => '2026'],
            ['kode' => 'SS2', 'sasaran' => 'Memperkuat pengabdian masyarakat berbasis riset',                 'strategi' => 'Membangun desa binaan yang berkelanjutan',                           'program_tahunan' => 'Program pengabdian masyarakat desa binaan',     'periode' => '2026'],
            ['kode' => 'SS3', 'sasaran' => 'Meningkatkan akreditasi dan mutu akademik',                       'strategi' => 'Penguatan sistem penjaminan mutu internal',                          'program_tahunan' => 'Program audit mutu akademik terpadu',           'periode' => '2026'],
            ['kode' => 'SS4', 'sasaran' => 'Mengembangkan prestasi mahasiswa di tingkat nasional',            'strategi' => 'Fasilitasi kompetisi dan pengembangan bakat mahasiswa',               'program_tahunan' => 'Program pembinaan prestasi mahasiswa',          'periode' => '2026'],
            ['kode' => 'SS5', 'sasaran' => 'Memperluas kemitraan strategis dengan industri dan pemerintah',   'strategi' => 'Membangun ekosistem kolaborasi tri-dharma',                           'program_tahunan' => 'Program pengembangan jejaring kemitraan',       'periode' => '2026'],
        ];

        foreach ($data as $item) {
            Renstra::create($item);
        }
    }
}
