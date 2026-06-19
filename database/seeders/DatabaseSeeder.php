<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => bcrypt('password'),
        ]);

        // ── Fakultas ──
        $fakultas = [
            ['kode_fakultas' => 'FST', 'nama_fakultas' => 'Fakultas Sains & Teknologi', 'dekan' => 'Dr. Rizky Amalia, S.T., M.Kom.'],
            ['kode_fakultas' => 'FIS', 'nama_fakultas' => 'Fakultas Ilmu Sosial',        'dekan' => 'Dr. Ari Prabowo, M.Si.'],
            ['kode_fakultas' => 'FK',  'nama_fakultas' => 'Fakultas Kesehatan',          'dekan' => 'dr. Hj. Fatimah Nurhayati, Sp.A., M.Kes.'],
        ];
        foreach ($fakultas as $f) {
            Fakultas::firstOrCreate(
                ['kode_fakultas' => $f['kode_fakultas']],
                $f
            );
        }

        $this->call([
            BidangSeeder::class,
            RenstraSeeder::class,
            ProgramSeeder::class,
            KegiatanSeeder::class,
        ]);
    }
}
