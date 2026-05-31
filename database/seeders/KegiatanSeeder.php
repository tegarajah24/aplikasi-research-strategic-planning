<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_kegiatan'     => '2.1.1',
                'nama_kegiatan'     => 'Pelaksanaan Penelitian Dosen sesuai Roadmap',
                'indikator_kinerja' => 'Persentase penelitian sesuai roadmap/dosen/tahun',
                'target_kegiatan'   => '30%',
                'penanggung_jawab'  => 'LPPM',
                'waktu_pelaksanaan' => 'September 2023 - Juni 2024',
                'tahun_akademik'    => '2023/2024',
                'kebutuhan_anggaran'=> 'Anggaran LPPM',
                'status'            => 'berjalan',
                'catatan'           => 'Penelitian disesuaikan dengan roadmap institusi.',
            ],
            [
                'kode_kegiatan'     => '2.1.2',
                'nama_kegiatan'     => 'Pelaksanaan Penelitian Lingkup Nasional',
                'indikator_kinerja' => 'Persentase penelitian lingkup nasional/dosen/tahun',
                'target_kegiatan'   => '40%',
                'penanggung_jawab'  => 'LPPM',
                'waktu_pelaksanaan' => 'September 2023 - Juni 2024',
                'tahun_akademik'    => '2023/2024',
                'kebutuhan_anggaran'=> 'Anggaran LPPM',
                'status'            => 'berjalan',
                'catatan'           => 'Mencakup penelitian tingkat nasional yang diakui.',
            ],
            [
                'kode_kegiatan'     => '2.1.3',
                'nama_kegiatan'     => 'Fasilitasi Penelitian Dosen yang Melibatkan Mahasiswa',
                'indikator_kinerja' => 'Persentase penelitian dosen yang melibatkan mahasiswa/tahun',
                'target_kegiatan'   => '30%',
                'penanggung_jawab'  => 'LPPM',
                'waktu_pelaksanaan' => 'September 2023 - Juni 2024',
                'tahun_akademik'    => '2023/2024',
                'kebutuhan_anggaran'=> 'Anggaran LPPM',
                'status'            => 'perencanaan',
                'catatan'           => 'Kolaborasi dosen-mahasiswa dalam kegiatan riset.',
            ],
            [
                'kode_kegiatan'     => '2.2.1',
                'nama_kegiatan'     => 'Peningkatan Publikasi Ilmiah Dosen di Jurnal Terindeks',
                'indikator_kinerja' => 'Jumlah artikel terbit di jurnal terindeks Scopus/SINTA per tahun',
                'target_kegiatan'   => '20 artikel',
                'penanggung_jawab'  => 'LPPM',
                'waktu_pelaksanaan' => 'Januari 2024 - Desember 2024',
                'tahun_akademik'    => '2023/2024',
                'kebutuhan_anggaran'=> 'Anggaran Penelitian & Publikasi',
                'status'            => 'berjalan',
                'catatan'           => 'Target publikasi di jurnal Scopus Q1-Q2 dan SINTA 1-2.',
            ],
            [
                'kode_kegiatan'     => '2.3.1',
                'nama_kegiatan'     => 'Pengabdian Masyarakat Berbasis Kebutuhan Lokal',
                'indikator_kinerja' => 'Jumlah kegiatan pengabdian masyarakat terlaksana per tahun',
                'target_kegiatan'   => '15 kegiatan',
                'penanggung_jawab'  => 'LPPM',
                'waktu_pelaksanaan' => 'Maret 2024 - November 2024',
                'tahun_akademik'    => '2023/2024',
                'kebutuhan_anggaran'=> 'Anggaran Pengabdian Masyarakat',
                'status'            => 'selesai',
                'catatan'           => 'Program selesai dengan dampak positif di komunitas lokal.',
            ],
            [
                'kode_kegiatan'     => '2.4.1',
                'nama_kegiatan'     => 'Pelatihan Metodologi Penelitian bagi Dosen',
                'indikator_kinerja' => 'Persentase dosen yang mengikuti pelatihan metodologi penelitian',
                'target_kegiatan'   => '80%',
                'penanggung_jawab'  => 'Wakil Rektor I',
                'waktu_pelaksanaan' => 'Juli 2024 - Agustus 2024',
                'tahun_akademik'    => '2024/2025',
                'kebutuhan_anggaran'=> 'Anggaran Pengembangan SDM',
                'status'            => 'tertunda',
                'catatan'           => 'Tertunda karena jadwal bentrok dengan kegiatan akademik.',
            ],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}
