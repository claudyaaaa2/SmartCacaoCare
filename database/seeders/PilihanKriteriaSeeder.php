<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PilihanKriteria;

class PilihanKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Warna Biji (kriteria_id: 1)
            ['kriteria_id' => 1, 'nama_pilihan' => 'Coklat merata dan gelap'],
            ['kriteria_id' => 1, 'nama_pilihan' => 'Coklat tapi tidak merata'],
            ['kriteria_id' => 1, 'nama_pilihan' => 'Warna pucat/keabu-abuan'],
            ['kriteria_id' => 1, 'nama_pilihan' => 'Hitam atau sangat tidak merata'],

            // Ukuran Biji (kriteria_id: 2)
            ['kriteria_id' => 2, 'nama_pilihan' => 'Seragam dan besar'],
            ['kriteria_id' => 2, 'nama_pilihan' => 'Cukup seragam'],
            ['kriteria_id' => 2, 'nama_pilihan' => 'Kurang seragam'],
            ['kriteria_id' => 2, 'nama_pilihan' => 'Sangat tidak seragam/kecil'],

            // Aroma (kriteria_id: 3)
            ['kriteria_id' => 3, 'nama_pilihan' => 'Aroma coklat khas fermentasi'],
            ['kriteria_id' => 3, 'nama_pilihan' => 'Aroma coklat cukup baik'],
            ['kriteria_id' => 3, 'nama_pilihan' => 'Aroma kurang/sedikit asam'],
            ['kriteria_id' => 3, 'nama_pilihan' => 'Berbau busuk/asam menyengat'],

            // Tekstur (kriteria_id: 4)
            ['kriteria_id' => 4, 'nama_pilihan' => 'Keras dan padat'],
            ['kriteria_id' => 4, 'nama_pilihan' => 'Cukup keras'],
            ['kriteria_id' => 4, 'nama_pilihan' => 'Agak lembek'],
            ['kriteria_id' => 4, 'nama_pilihan' => 'Sangat lembek/berair'],

            // Kondisi Fisik (kriteria_id: 5)
            ['kriteria_id' => 5, 'nama_pilihan' => 'Utuh, bersih, tidak berjamur'],
            ['kriteria_id' => 5, 'nama_pilihan' => 'Ada sedikit cacat/bercak'],
            ['kriteria_id' => 5, 'nama_pilihan' => 'Banyak cacat/jamur sedikit'],
            ['kriteria_id' => 5, 'nama_pilihan' => 'Berjamur parah/ada serangga'],
        ];

        foreach ($data as $item) {
            PilihanKriteria::create($item);
        }
    }
}