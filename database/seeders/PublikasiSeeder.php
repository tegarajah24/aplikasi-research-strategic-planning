<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Buku;
use App\Models\Hki;
use Illuminate\Database\Seeder;

class PublikasiSeeder extends Seeder
{
    public function run(): void
    {
        Artikel::truncate();
        Buku::truncate();
        Hki::truncate();

        // ===== 10 ARTIKEL (2024-2026) =====
        $artikel = [
            ['judul' => 'Implementasi Machine Learning untuk Prediksi Risiko Kardiovaskular',               'penulis' => 'Prof. Dr. Ahmad Subarjo',                                      'tahun' => 2024, 'penerbit' => 'Jurnal Teknologi Kesehatan Indonesia',               'doi' => '10.1234/jtki.2024.001'],
            ['judul' => 'Enterprise Architecture Framework untuk Transformasi Digital UMKM',               'penulis' => 'Citra Lestari, M.T.',                                            'tahun' => 2024, 'penerbit' => 'Jurnal Sistem Informasi Bisnis',                     'doi' => '10.1234/jsib.2024.015'],
            ['judul' => 'Analisis Pengaruh Digital Marketing terhadap Keputusan Pembelian Generasi Z',     'penulis' => 'Dr. Dian Wijaya, M.M.',                                          'tahun' => 2024, 'penerbit' => 'Jurnal Manajemen & Bisnis Digital',                  'doi' => '10.1234/jmbd.2024.008'],
            ['judul' => 'Penerapan Green Accounting pada Perusahaan Manufaktur di Indonesia',               'penulis' => 'Rian Hidayat, S.E., M.Ak.',                                      'tahun' => 2024, 'penerbit' => 'Jurnal Akuntansi & Auditing Indonesia',              'doi' => '10.1234/jaai.2024.022'],
            ['judul' => 'Strategi Komunikasi Politik di Media Sosial pada Pemilu 2024',                    'penulis' => 'Nadia Utami, M.I.Kom.',                                          'tahun' => 2024, 'penerbit' => 'Jurnal Ilmu Komunikasi Nusantara',                   'doi' => '10.1234/jikn.2024.011'],
            ['judul' => 'Peran Diplomasi Ekonomi Indonesia dalam ASEAN Economic Community 2025',           'penulis' => 'Budi Dermawan, Ph.D.',                                           'tahun' => 2025, 'penerbit' => 'Jurnal Hubungan Internasional Asia-Pasifik',          'doi' => '10.1234/jhiap.2025.003'],
            ['judul' => 'Deep Learning untuk Deteksi Dini Penyakit Retinopati Diabetik',                   'penulis' => 'Prof. Dr. Ahmad Subarjo',                                      'tahun' => 2025, 'penerbit' => 'International Journal of Artificial Intelligence in Medicine', 'doi' => '10.5678/ijaim.2025.007'],
            ['judul' => 'Pengaruh Work From Home terhadap Produktivitas Karyawan Sektor Perbankan',        'penulis' => 'Dr. Dian Wijaya, M.M.',                                          'tahun' => 2025, 'penerbit' => 'Jurnal Manajemen Sumber Daya Manusia',                'doi' => '10.1234/jmsdm.2025.014'],
            ['judul' => 'Cyber Security Framework untuk Perlindungan Data Pribadi di Platform E-Commerce',  'penulis' => 'Citra Lestari, M.T.',                                            'tahun' => 2026, 'penerbit' => 'Jurnal Keamanan Siber & Forensik Digital',             'doi' => '10.5678/jksfd.2026.002'],
            ['judul' => 'Analisis Sentimen Opini Publik terhadap Kebijakan Kenaikan PPN menggunakan NLP',  'penulis' => 'Prof. Dr. Ahmad Subarjo',                                      'tahun' => 2026, 'penerbit' => 'Jurnal Data Science & Analytika',                    'doi' => '10.5678/jdsa.2026.009'],
        ];
        foreach ($artikel as $a) {
            Artikel::create($a);
        }

        // ===== 10 BUKU (2024-2026) =====
        $buku = [
            ['judul' => 'Fundamental Kecerdasan Buatan: Teori & Praktik dengan Python',                   'penulis' => 'Prof. Dr. Ahmad Subarjo',                                      'penerbit' => 'Penerbit Informatika Nusantara',    'tahun_terbit' => 2024, 'isbn' => '978-602-1234-01-5'],
            ['judul' => 'Enterprise Architecture Planning untuk Organisasi Modern',                         'penulis' => 'Citra Lestari, M.T.',                                            'penerbit' => 'Graha Ilmu',                        'tahun_terbit' => 2024, 'isbn' => '978-602-1234-02-2'],
            ['judul' => 'Manajemen Pemasaran Digital di Era Disrupsi',                                     'penulis' => 'Dr. Dian Wijaya, M.M.',                                          'penerbit' => 'Salemba Empat',                     'tahun_terbit' => 2024, 'isbn' => '978-602-1234-03-9'],
            ['judul' => 'Akuntansi Keberlanjutan: Teori & Implementasi Green Accounting',                  'penulis' => 'Rian Hidayat, S.E., M.Ak.',                                      'penerbit' => 'Penerbit Erlangga',                  'tahun_terbit' => 2024, 'isbn' => '978-602-1234-04-6'],
            ['judul' => 'Komunikasi Digital & Public Relations di Era Post-Truth',                         'penulis' => 'Nadia Utami, M.I.Kom.',                                          'penerbit' => 'Prenadamedia Group',                 'tahun_terbit' => 2025, 'isbn' => '978-602-1234-05-3'],
            ['judul' => 'Diplomasi Ekonomi Indonesia: Strategi & Tantangan di Kawasan Asia-Pasifik',       'penulis' => 'Budi Dermawan, Ph.D.',                                           'penerbit' => 'Rajawali Press',                    'tahun_terbit' => 2025, 'isbn' => '978-602-1234-06-0'],
            ['judul' => 'Machine Learning untuk Diagnosis Medis: Pendekatan Praktis',                      'penulis' => 'Prof. Dr. Ahmad Subarjo, Dr. dr. Siti Aminah, Sp.PD.',          'penerbit' => 'Penerbit Deepublish',               'tahun_terbit' => 2025, 'isbn' => '978-602-1234-07-7'],
            ['judul' => 'Audit Forensik & Deteksi Fraud Berbasis Teknologi',                               'penulis' => 'Rian Hidayat, S.E., M.Ak.',                                      'penerbit' => 'Penerbit Salemba',                  'tahun_terbit' => 2025, 'isbn' => '978-602-1234-08-4'],
            ['judul' => 'Keamanan Siber: Ethical Hacking & Vulnerability Assessment',                      'penulis' => 'Citra Lestari, M.T.',                                            'penerbit' => 'Penerbit Andi',                     'tahun_terbit' => 2026, 'isbn' => '978-602-1234-09-1'],
            ['judul' => 'Metode Penelitian Kuantitatif untuk Ilmu Sosial dengan SPSS & R',                 'penulis' => 'Nadia Utami, M.I.Kom., Dr. Dian Wijaya, M.M.',                   'penerbit' => 'Penerbit Bumi Aksara',              'tahun_terbit' => 2026, 'isbn' => '978-602-1234-10-7'],
        ];
        foreach ($buku as $b) {
            Buku::create($b);
        }

        // ===== 10 HKI (2024-2026) =====
        $hki = [
            ['judul' => 'Sistem Pakar Diagnosis Dini Penyakit Diabetes Melitus Tipe 2',                    'pencipta' => 'Prof. Dr. Ahmad Subarjo',                                      'jenis_hki' => 'Paten',             'nomor_pendaftaran' => 'P00202400001',  'tahun' => 2024],
            ['judul' => 'Aplikasi E-Arsip Digital Berbasis Web untuk Tata Kelola Dokumen Kampus',          'pencipta' => 'Citra Lestari, M.T.',                                            'jenis_hki' => 'Hak Cipta',         'nomor_pendaftaran' => 'EC00202400001',  'tahun' => 2024],
            ['judul' => 'Platform Marketplace UMKM Terintegrasi dengan Sistem Pembayaran Digital',         'pencipta' => 'Dr. Dian Wijaya, M.M.',                                          'jenis_hki' => 'Paten Sederhana',   'nomor_pendaftaran' => 'S00202400001',   'tahun' => 2024],
            ['judul' => 'Model Audit Pajak Berbasis Analisis Big Data untuk Peningkatan Kepatuhan Wajib Pajak', 'pencipta' => 'Rian Hidayat, S.E., M.Ak.',                                      'jenis_hki' => 'Hak Cipta',         'nomor_pendaftaran' => 'EC00202400002',  'tahun' => 2024],
            ['judul' => 'Aplikasi Pemantauan Opini Publik Berbasis Social Media Analytics',                'pencipta' => 'Nadia Utami, M.I.Kom.',                                          'jenis_hki' => 'Hak Cipta',         'nomor_pendaftaran' => 'EC00202500001',  'tahun' => 2025],
            ['judul' => 'Framework Diplomasi Ekonomi Digital untuk Pengembangan Ekspor UMKM',              'pencipta' => 'Budi Dermawan, Ph.D.',                                           'jenis_hki' => 'Paten',             'nomor_pendaftaran' => 'P00202500001',  'tahun' => 2025],
            ['judul' => 'Algoritma Deteksi Ujaran Kebencian di Media Sosial Berbasis Transformer',         'pencipta' => 'Prof. Dr. Ahmad Subarjo',                                      'jenis_hki' => 'Paten',             'nomor_pendaftaran' => 'P00202500002',  'tahun' => 2025],
            ['judul' => 'Sistem Monitoring Kesehatan Pasien Jarak Jauh Berbasis IoT',                       'pencipta' => 'Citra Lestari, M.T., Dr. dr. Siti Aminah, Sp.PD.',               'jenis_hki' => 'Paten Sederhana',   'nomor_pendaftaran' => 'S00202500002',   'tahun' => 2025],
            ['judul' => 'Metode Penilaian Kinerja Keuangan Berbasis ESG untuk Perusahaan Publik',           'pencipta' => 'Rian Hidayat, S.E., M.Ak.',                                      'jenis_hki' => 'Hak Cipta',         'nomor_pendaftaran' => 'EC00202600001',  'tahun' => 2026],
            ['judul' => 'Aplikasi Pembelajaran Bahasa Inggris Interaktif Berbasis AI Chatbot',              'pencipta' => 'Nadia Utami, M.I.Kom., Budi Dermawan, Ph.D.',                    'jenis_hki' => 'Hak Cipta',         'nomor_pendaftaran' => 'EC00202600002',  'tahun' => 2026],
        ];
        foreach ($hki as $h) {
            Hki::create($h);
        }

        $this->command->info('Data publikasi berhasil ditambahkan:');
        $this->command->info('- ' . count($artikel) . ' artikel');
        $this->command->info('- ' . count($buku) . ' buku');
        $this->command->info('- ' . count($hki) . ' HKI');
    }
}
