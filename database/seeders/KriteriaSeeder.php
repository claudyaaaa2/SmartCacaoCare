<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;


class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            [
                'nama_kriteria' => 'Warna Biji',
                'deskripsi'     => 'Kondisi warna permukaan biji kakao',
            ],
            [
                'nama_kriteria' => 'Ukuran Biji',
                'deskripsi'     => 'Keseragaman ukuran biji kakao',
            ],
            [
                'nama_kriteria' => 'Aroma',
                'deskripsi'     => 'Aroma biji kakao hasil fermentasi',
            ],
            [
                'nama_kriteria' => 'Tekstur',
                'deskripsi'     => 'Kondisi tekstur biji kakao',
            ],
            [
                'nama_kriteria' => 'Kondisi Fisik',
                'deskripsi'     => 'Kondisi fisik biji kakao secara keseluruhan',
            ],
        ];

        foreach ($kriteria as $k) {
            Kriteria::create($k);
        }
    }
}