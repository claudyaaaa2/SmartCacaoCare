<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradeKualitas;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        GradeKualitas::create([
            'nama_grade' => 'Grade A',
            'deskripsi' => 'Kualitas ekspor, biji kering sempurna.',
            'saran_penanganan' => 'Pertahankan metode pasca panen saat ini.'
        ]);
        GradeKualitas::create([
            'nama_grade' => 'Grade B',
            'deskripsi' => 'Kualitas menengah, terdapat sedikit biji pecah.',
            'saran_penanganan' => 'Lakukan penyortiran lebih teliti.'
        ]);
    }
}