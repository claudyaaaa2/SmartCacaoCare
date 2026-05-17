<?php

namespace App\Services;

use App\Models\GradeKualitas;

class CertaintyFactorService
{
    public function evaluate(array $selections): array
    {
        // $selections = ['kriteria_id' => 'pilihan_kriteria_id']
        // Contoh: [1 => 3, 2 => 6, 3 => 9, 4 => 13, 5 => 18]

        $grades = GradeKualitas::with('ruleCf')->get();
        $hasil  = [];

        foreach ($grades as $grade) {
            $cfKombinasi = 0.0;
            $pertama     = true;

            foreach ($selections as $kriteriaId => $pilihanId) {
                $rule = $grade->ruleCf
                              ->where('pilihan_kriteria_id', $pilihanId)
                              ->first();

                if (!$rule) continue;

                $nilaiCf = (float) $rule->nilai_cf;

                if ($pertama) {
                    $cfKombinasi = $nilaiCf;
                    $pertama     = false;
                } else {
                    $cfKombinasi = $this->combine($cfKombinasi, $nilaiCf);
                }
            }

            $hasil[] = [
                'grade'      => $grade,
                'cf_value'   => $cfKombinasi,
                'persentase' => round($cfKombinasi * 100, 2),
            ];
        }

        // Urutkan dari CF tertinggi
        usort($hasil, fn($a, $b) => $b['cf_value'] <=> $a['cf_value']);

        return [
            'rankings'   => $hasil,
            'best_grade' => $hasil[0],
        ];
    }

    private function combine(float $cf1, float $cf2): float
    {
        if ($cf1 <= 0) return $cf2;
        return $cf1 + $cf2 * (1 - $cf1);
    }
}