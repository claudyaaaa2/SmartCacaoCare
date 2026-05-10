<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,           // 1. Buat User Admin & Petani
            GradeSeeder::class,          // 2. Buat Target Grade (A, B, C)
            KriteriaSeeder::class,       // 3. Buat Daftar Kriteria
            PilihanKriteriaSeeder::class, // 4. Buat Opsi Jawaban & Bobot MB
            RuleCfSeeder::class,         // 5. Hubungkan Kriteria ke Grade
        ]);
    }
}