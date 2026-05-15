<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradeKualitas;

class GradeKualitasSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            [
                'kode_grade'  => 'A',
                'nama_grade'  => 'Premium',
                'cf_min'      => 0.75,
                'cf_max'      => 1.00,
                'deskripsi'   => 'Biji kakao berkualitas tinggi, memenuhi standar ekspor internasional.',
                'rekomendasi' => 'Biji kakao Anda memenuhi standar ekspor. Segera hubungi eksportir atau koperasi kakao untuk mendapatkan harga terbaik.',
            ],
            [
                'kode_grade'  => 'B',
                'nama_grade'  => 'Menengah',
                'cf_min'      => 0.50,
                'cf_max'      => 0.74,
                'deskripsi'   => 'Biji kakao berkualitas menengah, layak dijual di pasar lokal.',
                'rekomendasi' => 'Biji kakao Anda layak jual di pasar lokal. Pastikan fermentasi 5-6 hari dan keringkan hingga kadar air di bawah 7.5%.',
            ],
            [
                'kode_grade'  => 'C',
                'nama_grade'  => 'Rendah',
                'cf_min'      => 0.25,
                'cf_max'      => 0.49,
                'deskripsi'   => 'Biji kakao berkualitas rendah, perlu perbaikan proses.',
                'rekomendasi' => 'Perbaiki proses fermentasi minimal 5 hari, hindari pengeringan di lantai tanah, pisahkan biji yang berjamur.',
            ],
            [
                'kode_grade'  => 'D',
                'nama_grade'  => 'Tidak Layak',
                'cf_min'      => 0.00,
                'cf_max'      => 0.24,
                'deskripsi'   => 'Biji kakao tidak memenuhi standar minimum.',
                'rekomendasi' => 'Biji kakao tidak layak dijual. Evaluasi seluruh proses dari panen hingga pengeringan.',
            ],
        ];

        foreach ($grades as $grade) {
            GradeKualitas::create($grade);
        }
    }
}