<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Renstra;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Kegiatan::truncate();
        Program::truncate();
        User::whereNotNull('prodi_id')->update(['prodi_id' => null]);
        Dosen::truncate();
        Prodi::truncate();
        Fakultas::truncate();
        Bidang::truncate();
        Renstra::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // ===== 1. FAKULTAS =====
        $fakultas = [
            ['kode_fakultas' => 'FST', 'nama_fakultas' => 'Fakultas Sains & Teknologi', 'dekan' => 'Dr. Rizky Amalia, S.T., M.Kom.'],
            ['kode_fakultas' => 'FIS', 'nama_fakultas' => 'Fakultas Ilmu Sosial',        'dekan' => 'Dr. Ari Prabowo, M.Si.'],
            ['kode_fakultas' => 'FK',  'nama_fakultas' => 'Fakultas Kesehatan',          'dekan' => 'dr. Hj. Fatimah Nurhayati, Sp.A., M.Kes.'],
        ];
        foreach ($fakultas as $f) {
            Fakultas::create($f);
        }

        $fst = Fakultas::where('kode_fakultas', 'FST')->value('id');
        $fis = Fakultas::where('kode_fakultas', 'FIS')->value('id');
        $fk  = Fakultas::where('kode_fakultas', 'FK')->value('id');

        // ===== 2. PROGRAM STUDI =====
        $prodi = [
            ['kode_prodi' => 'IF',   'nama_prodi' => 'S1 Informatika',              'fakultas_id' => $fst],
            ['kode_prodi' => 'SI',   'nama_prodi' => 'S1 Sistem Informasi',          'fakultas_id' => $fst],
            ['kode_prodi' => 'ILKOM','nama_prodi' => 'S1 Ilmu Komunikasi',           'fakultas_id' => $fis],
            ['kode_prodi' => 'HI',   'nama_prodi' => 'S1 Hubungan Internasional',    'fakultas_id' => $fis],
            ['kode_prodi' => 'KEP',  'nama_prodi' => 'S1 Keperawatan',               'fakultas_id' => $fk],
            ['kode_prodi' => 'FARM', 'nama_prodi' => 'S1 Farmasi',                   'fakultas_id' => $fk],
        ];
        foreach ($prodi as $p) {
            Prodi::create($p);
        }

        $if    = Prodi::where('kode_prodi', 'IF')->value('id');
        $si    = Prodi::where('kode_prodi', 'SI')->value('id');
        $ilkom = Prodi::where('kode_prodi', 'ILKOM')->value('id');
        $hi    = Prodi::where('kode_prodi', 'HI')->value('id');
        $kep   = Prodi::where('kode_prodi', 'KEP')->value('id');
        $farm  = Prodi::where('kode_prodi', 'FARM')->value('id');

        // ===== 3. DOSEN =====
        $dosen = [
            ['nidn' => '0012037801', 'nama_dosen' => 'Prof. Dr. Ahmad Subarjo',           'prodi_id' => $if],
            ['nidn' => '0015038201', 'nama_dosen' => 'Citra Lestari, M.T.',                'prodi_id' => $si],
            ['nidn' => '0020118602', 'nama_dosen' => 'Nadia Utami, M.I.Kom.',              'prodi_id' => $ilkom],
            ['nidn' => '0014097703', 'nama_dosen' => 'Budi Dermawan, Ph.D.',               'prodi_id' => $hi],
            ['nidn' => '0022058101', 'nama_dosen' => 'Dr. dr. Siti Aminah, Sp.PD.',        'prodi_id' => $kep],
            ['nidn' => '0015038201', 'nama_dosen' => 'apt. Citra Lestari, M.Farm.',        'prodi_id' => $farm],
        ];
        foreach ($dosen as $d) {
            Dosen::create($d);
        }

        // ===== 4. BIDANG KEAHLIAN =====
        $bidang = [
            ['kode_bidang' => 'BD-01', 'nama_bidang' => 'Artificial Intelligence & Data Science',             'deskripsi' => 'Pengembangan sistem cerdas dan analisis data untuk solusi industri 4.0', 'status' => 'Aktif'],
            ['kode_bidang' => 'BD-02', 'nama_bidang' => 'Enterprise Architecture & E-Business',                 'deskripsi' => 'Perancangan arsitektur enterprise dan pengembangan bisnis digital',       'status' => 'Aktif'],
            ['kode_bidang' => 'BD-03', 'nama_bidang' => 'Digital Marketing & Fintech',                         'deskripsi' => 'Strategi pemasaran digital dan inovasi teknologi keuangan',              'status' => 'Aktif'],
            ['kode_bidang' => 'BD-04', 'nama_bidang' => 'Audit & Tax Analytics',                               'deskripsi' => 'Audit berbasis data dan analisis perpajakan modern',                    'status' => 'Aktif'],
            ['kode_bidang' => 'BD-05', 'nama_bidang' => 'Media Siber & Public Relations',                      'deskripsi' => 'Komunikasi digital, media siber, dan hubungan masyarakat era digital',  'status' => 'Aktif'],
            ['kode_bidang' => 'BD-06', 'nama_bidang' => 'Diplomasi Ekonomi & Isu Global',                      'deskripsi' => 'Kajian diplomasi ekonomi dan isu-isu global kontemporer',              'status' => 'Aktif'],
            ['kode_bidang' => 'BD-07', 'nama_bidang' => 'Keamanan Siber & Jaringan Komputer',                  'deskripsi' => 'Keamanan informasi, ethical hacking, dan infrastruktur jaringan',       'status' => 'Aktif'],
        ];
        foreach ($bidang as $b) {
            Bidang::create($b);
        }

        $bd1 = Bidang::where('kode_bidang', 'BD-01')->value('id');
        $bd2 = Bidang::where('kode_bidang', 'BD-02')->value('id');
        $bd3 = Bidang::where('kode_bidang', 'BD-03')->value('id');
        $bd4 = Bidang::where('kode_bidang', 'BD-04')->value('id');
        $bd5 = Bidang::where('kode_bidang', 'BD-05')->value('id');

        // ===== 5. RENSTRA =====
        $renstra = [
            ['fakultas_id' => $fst, 'kode' => 'R-001', 'sasaran' => 'Pengembangan Kurikulum Berbasis AI & IoT 2026-2030',                       'strategi' => 'Mengintegrasikan kecerdasan buatan dan IoT ke dalam kurikulum lintas prodi',                          'program_tahunan' => 'Program review & pengembangan kurikulum berbasis AI',     'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fst, 'kode' => 'R-002', 'sasaran' => 'Digitalisasi Tata Kelola Kampus & UMKM Daerah',                            'strategi' => 'Mengembangkan sistem digital terpadu untuk tata kelola kampus dan pendampingan UMKM',                'program_tahunan' => 'Program pengembangan aplikasi tata kelola & digitalisasi UMKM', 'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fis, 'kode' => 'R-003', 'sasaran' => 'Literasi Digital & Pengabdian Masyarakat Anti-Hoaks',                      'strategi' => 'Meningkatkan literasi digital masyarakat dan memerangi penyebaran hoaks',                            'program_tahunan' => 'Program pengabdian masyarakat literasi digital & anti-hoaks', 'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fis, 'kode' => 'R-004', 'sasaran' => 'Peningkatan Kerja Sama Akademik Internasional Asia-Pasifik',                'strategi' => 'Memperluas jaringan kerja sama dengan universitas mitra di kawasan Asia-Pasifik',                    'program_tahunan' => 'Program mobilitas mahasiswa & dosen internasional',        'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fk,  'kode' => 'R-005', 'sasaran' => 'Peningkatan Kualitas Pelayanan Kesehatan Masyarakat',                      'strategi' => 'Mengembangkan program kesehatan berbasis riset dan pengabdian masyarakat',                            'program_tahunan' => 'Program pengabdian kesehatan masyarakat desa binaan',    'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fk,  'kode' => 'R-006', 'sasaran' => 'Inovasi Teknologi Farmasi & Kesehatan',                                    'strategi' => 'Mendorong penelitian dan inovasi di bidang farmasi dan kesehatan',                                   'program_tahunan' => 'Program riset dan pengembangan obat herbal',             'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
            ['fakultas_id' => $fst, 'kode' => 'R-007', 'sasaran' => 'Internasionalisasi Jurnal Ilmiah Terakreditasi Scopus',                    'strategi' => 'Mendorong publikasi ilmiah dosen pada jurnal bereputasi internasional dan indeks Scopus',           'program_tahunan' => 'Program pendanaan publikasi & pelatihan penulisan jurnal internasional', 'tahun_mulai' => 2026, 'tahun_selesai' => 2030, 'status' => 'belum_tercapai'],
        ];
        foreach ($renstra as $r) {
            Renstra::create($r);
        }

        // ===== 6. PROGRAM =====
        $fstRenstra = Renstra::where('fakultas_id', $fst)->pluck('id')->toArray();
        $defaultRenstraId = !empty($fstRenstra) ? $fstRenstra[0] : null;

        $program = [
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => $bd1, 'kode_program' => 'P-001', 'nama_program' => 'Reguler Pagi',                             'deskripsi' => 'Program perkuliahan reguler pagi hari untuk mahasiswa penuh waktu',               'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => $bd2, 'kode_program' => 'P-002', 'nama_program' => 'Reguler Malam / Kelas Karyawan',            'deskripsi' => 'Program perkuliahan malam hari untuk mahasiswa yang sudah bekerja',               'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => $bd3, 'kode_program' => 'P-003', 'nama_program' => 'Program Internasional',                    'deskripsi' => 'Program perkuliahan dengan kurikulum dan standar internasional',                  'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => $bd4, 'kode_program' => 'P-004', 'nama_program' => 'Program Eksekutif',                        'deskripsi' => 'Program pendidikan eksekutif untuk profesional dan pemimpin bisnis',             'status' => 'Aktif'],
            ['renstra_id' => $defaultRenstraId, 'bidang_id' => $bd5, 'kode_program' => 'P-005', 'nama_program' => 'Blended Learning (Online-Offline)',        'deskripsi' => 'Program pembelajaran hybrid yang menggabungkan tatap muka dan daring',            'status' => 'Aktif'],
        ];
        foreach ($program as $p) {
            Program::create($p);
        }

        $this->command->info('Master data berhasil ditambahkan:');
        $this->command->info('- ' . count($fakultas) . ' fakultas');
        $this->command->info('- ' . count($prodi) . ' program studi');
        $this->command->info('- ' . count($dosen) . ' dosen');
        $this->command->info('- ' . count($bidang) . ' bidang keahlian');
        $this->command->info('- ' . count($renstra) . ' renstra');
        $this->command->info('- ' . count($program) . ' program');
    }
}