<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\PilihanKriteria;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // Kriteria Warna
        $k1 = Kriteria::create(['nama_kriteria' => 'Warna Biji']);
        PilihanKriteria::create(['kriteria_id' => $k1->id, 'nama_pilihan' => 'Cokelat Terang', 'bobot' => 1.0]);
        PilihanKriteria::create(['kriteria_id' => $k1->id, 'nama_pilihan' => 'Cokelat Gelap', 'bobot' => 0.5]);

        // Kriteria Tekstur
        $k2 = Kriteria::create(['nama_kriteria' => 'Tekstur Kulit']);
        PilihanKriteria::create(['kriteria_id' => $k2->id, 'nama_pilihan' => 'Rapuh/Garing', 'bobot' => 0.8]);
        PilihanKriteria::create(['kriteria_id' => $k2->id, 'nama_pilihan' => 'Liat/Basah', 'bobot' => 0.2]);
    }
}