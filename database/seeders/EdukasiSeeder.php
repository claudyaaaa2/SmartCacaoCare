<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Edukasi;
use Illuminate\Support\Str;

class EdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'judul' => 'Pengenalan Grade Kakao dan Standar Mutu',
                'kategori' => 'kualitas',
                'ringkasan' => 'Memahami apa yang dimaksud Grade A, B, dan C serta parameter penilaian mutu biji kakao.',
                'konten' => '<p>Grade kakao menentukan nilai jual dan penggunaan akhir biji. Artikel ini menjelaskan parameter utama seperti ukuran biji, kadar kelembapan, dan cacat fisik yang mempengaruhi penilaian.</p><h3>Parameter Penilaian</h3><ul><li>Ukuran dan bobot biji</li><li>Kadar kelembapan optimal (5-7%)</li><li>Kehadiran jamur dan cacat</li></ul><p>Praktik pengambilan sampel yang baik akan membantu menghindari kesalahan inspeksi di lapangan.</p>',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Teknik Pengeringan untuk Mencegah Jamur',
                'kategori' => 'pasca_panen',
                'ringkasan' => 'Langkah-langkah praktis pengeringan biji kakao untuk meminimalkan risiko jamur dan menjaga kualitas.',
                'konten' => '<p>Pengeringan yang benar penting untuk menurunkan kelembapan biji ke kadar aman. Gunakan kombinasi pengeringan alami dan mekanik sesuai cuaca.</p><h3>Langkah Praktis</h3><ol><li>Sortir biji berdasarkan kualitas</li><li>Gunakan rak pengering yang berventilasi</li><li>Keringkan sampai kadar <strong>5-7%</strong></li></ol><p>Periksa rutin dan hindari penyimpanan saat masih lembap.</p>',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Deteksi Hama dan Penyakit Umum',
                'kategori' => 'hama_penyakit',
                'ringkasan' => 'Panduan singkat mengenali tanda-tanda serangan hama dan penyakit pada pohon kakao.',
                'konten' => '<p>Beberapa hama dan penyakit dapat mengurangi hasil secara signifikan. Artikel ini membantu Anda mengenali gejala awal dan tindakan mitigasi cepat.</p><h3>Gejala Umum</h3><ul><li>Daun menguning dan gugur</li><li>Bercak pada buah</li><li>Kerusakan akibat serangga penggerek</li></ul><p>Langkah awal: identifikasi, isolasi, lalu terapkan pengendalian terukur.</p>',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Waktu Panen Optimal dan Praktik Pemeliharaan',
                'kategori' => 'panen',
                'ringkasan' => 'Kapan memanen dan bagaimana merawat pohon untuk hasil terbaik.',
                'konten' => '<p>Waktu panen yang tepat meningkatkan kualitas biji. Perhatikan tanda kematangan dan lakukan pemeliharaan rutin.</p><h3>Tips Pemeliharaan</h3><ul><li>Pemangkasan teratur untuk sirkulasi udara</li><li>Penyiraman sesuai kebutuhan</li><li>Pemupukan seimbang</li></ul>',
                'thumbnail' => null,
            ],
        ];

        foreach ($items as $item) {
            Edukasi::create($item);
        }
    }
}
