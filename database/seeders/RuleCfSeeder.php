<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RuleCf;

class RuleCfSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ID Grade dan Kriteria sesuai dengan urutan input
        RuleCf::create(['grade_id' => 1, 'kriteria_id' => 1]);
        RuleCf::create(['grade_id' => 1, 'kriteria_id' => 2]);
    }
}