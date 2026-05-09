<?php

namespace App\Services;

use InvalidArgumentException;

class CertaintyFactorService
{
    /**
     * Definisi kriteria yang dipakai pada penilaian biji kakao.
     *
     * @return array<string, array{label: string, weight: float}>
     */
    public function criteria(): array
    {
        return [
            'warna' => [
                'label' => 'Warna',
                'weight' => 0.25,
            ],
            'ukuran' => [
                'label' => 'Ukuran',
                'weight' => 0.20,
            ],
            'aroma' => [
                'label' => 'Aroma',
                'weight' => 0.20,
            ],
            'tekstur' => [
                'label' => 'Tekstur',
                'weight' => 0.20,
            ],
            'kondisi_fisik' => [
                'label' => 'Kondisi Fisik',
                'weight' => 0.15,
            ],
        ];
    }

    /**
     * Opsi yang ditampilkan pada dropdown.
     *
     * @return array<string, string>
     */
    public function options(): array
    {
        return [
            'sangat_baik' => 'Sangat Baik',
            'baik' => 'Baik',
            'cukup' => 'Cukup',
            'buruk' => 'Buruk',
        ];
    }

    /**
     * Grade kualitas yang akan diranking dari tertinggi ke terendah.
     *
     * @return array<string, array{label: string, priority: int}>
     */
    public function grades(): array
    {
        return [
            'A' => [
                'label' => 'Grade A - Premium',
                'priority' => 4,
            ],
            'B' => [
                'label' => 'Grade B - Baik',
                'priority' => 3,
            ],
            'C' => [
                'label' => 'Grade C - Standar',
                'priority' => 2,
            ],
            'D' => [
                'label' => 'Grade D - Rendah',
                'priority' => 1,
            ],
        ];
    }

    /**
     * Peta kekuatan bukti dari tiap pilihan dropdown terhadap setiap grade.
     *
     * @return array<string, array<string, float>>
     */
    public function evidenceMatrix(): array
    {
        return [
            'sangat_baik' => [
                'A' => 0.95,
                'B' => 0.70,
                'C' => 0.30,
                'D' => 0.05,
            ],
            'baik' => [
                'A' => 0.75,
                'B' => 0.88,
                'C' => 0.55,
                'D' => 0.10,
            ],
            'cukup' => [
                'A' => 0.45,
                'B' => 0.72,
                'C' => 0.85,
                'D' => 0.25,
            ],
            'buruk' => [
                'A' => 0.15,
                'B' => 0.35,
                'C' => 0.60,
                'D' => 0.80,
            ],
        ];
    }

    /**
     * Hitung certainty factor untuk semua grade lalu pilih grade terbaik.
     *
     * @param  array<string, string>  $selections
     * @return array{
     *     selected_criteria: array<int, array<string, mixed>>,
     *     rankings: array<int, array<string, mixed>>,
     *     best_grade: array<string, mixed>
     * }
     */
    public function evaluate(array $selections): array
    {
        $criteria = $this->criteria();
        $options = $this->options();
        $grades = $this->grades();
        $matrix = $this->evidenceMatrix();

        $selectedCriteria = [];

        foreach ($criteria as $field => $definition) {
            if (! array_key_exists($field, $selections)) {
                throw new InvalidArgumentException("Kriteria {$definition['label']} wajib diisi.");
            }

            $selection = $selections[$field];

            if (! array_key_exists($selection, $options)) {
                throw new InvalidArgumentException("Pilihan untuk {$definition['label']} tidak valid.");
            }

            $selectedCriteria[] = [
                'field' => $field,
                'label' => $definition['label'],
                'selection_key' => $selection,
                'selection_label' => $options[$selection],
                'weight' => $definition['weight'],
            ];
        }

        $rankings = [];

        foreach ($grades as $gradeKey => $gradeDefinition) {
            $score = 0.0;
            $details = [];

            foreach ($selectedCriteria as $criterion) {
                $evidence = $matrix[$criterion['selection_key']][$gradeKey] ?? 0.0;
                $weightedEvidence = $evidence * $criterion['weight'];
                $score = $this->combine($score, $weightedEvidence);

                $details[] = [
                    'field' => $criterion['field'],
                    'label' => $criterion['label'],
                    'selection_label' => $criterion['selection_label'],
                    'weight' => $criterion['weight'],
                    'evidence' => $evidence,
                    'weighted_evidence' => $weightedEvidence,
                ];
            }

            $rankings[] = [
                'grade_key' => $gradeKey,
                'label' => $gradeDefinition['label'],
                'priority' => $gradeDefinition['priority'],
                'confidence' => round($score, 4),
                'percentage' => round($score * 100, 2),
                'details' => $details,
            ];
        }

        usort($rankings, static function (array $left, array $right): int {
            if ($left['confidence'] === $right['confidence']) {
                return $right['priority'] <=> $left['priority'];
            }

            return $right['confidence'] <=> $left['confidence'];
        });

        return [
            'selected_criteria' => $selectedCriteria,
            'rankings' => $rankings,
            'best_grade' => $rankings[0],
        ];
    }

    private function combine(float $current, float $incoming): float
    {
        if ($current <= 0) {
            return $incoming;
        }

        return $current + ($incoming * (1 - $current));
    }
}