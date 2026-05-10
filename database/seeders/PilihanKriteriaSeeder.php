<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PilihanKriteria;

class PilihanKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Pilihan untuk Kriteria 1 (Warna Biji)
            ['kriteria_id' => 1, 'nama_pilihan' => 'Cokelat Terang', 'bobot' => 1.0],
            ['kriteria_id' => 1, 'nama_pilihan' => 'Cokelat Gelap', 'bobot' => 0.6],
            ['kriteria_id' => 1, 'nama_pilihan' => 'Hitam/Apek', 'bobot' => 0.2],

            // Pilihan untuk Kriteria 2 (Tekstur Kulit)
            ['kriteria_id' => 2, 'nama_pilihan' => 'Rapuh/Garing', 'bobot' => 0.9],
            ['kriteria_id' => 2, 'nama_pilihan' => 'Liat/Alami', 'bobot' => 0.5],
            ['kriteria_id' => 2, 'nama_pilihan' => 'Basah/Berlendir', 'bobot' => 0.1],
        ];

        foreach ($data as $item) {
            PilihanKriteria::create($item);
        }
    }
}