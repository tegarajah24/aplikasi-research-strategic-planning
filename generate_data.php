<?php
use App\Models\Artikel;
use App\Models\Buku;
use App\Models\Hki;
use Faker\Factory as Faker;

$faker = Faker::create('id_ID');

for ($i = 0; $i < 10; $i++) {
    Artikel::create([
        'judul' => rtrim($faker->sentence(), '.'),
        'penulis' => $faker->name(),
        'tahun' => $faker->year(),
        'penerbit' => $faker->company(),
        'doi' => '10.' . $faker->randomNumber(4, true) . '/' . $faker->word(),
        'file_path' => null
    ]);

    Buku::create([
        'judul' => rtrim($faker->sentence(4), '.'),
        'penulis' => $faker->name(),
        'penerbit' => $faker->company(),
        'tahun_terbit' => $faker->year(),
        'isbn' => $faker->isbn13(),
        'file_path' => null
    ]);

    Hki::create([
        'judul' => rtrim($faker->sentence(3), '.'),
        'pencipta' => $faker->name(),
        'jenis_hki' => $faker->randomElement(['Paten', 'Hak Cipta', 'Merek', 'Desain Industri']),
        'nomor_pendaftaran' => $faker->numerify('HKI-####-####'),
        'tahun' => $faker->year(),
        'file_path' => null
    ]);
}
echo "10 records generated for Artikel, Buku, and Hki.\n";
