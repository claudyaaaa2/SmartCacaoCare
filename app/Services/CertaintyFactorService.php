<?php

namespace App\Services;

use App\Models\GradeKualitas;
use App\Models\Kriteria;
use InvalidArgumentException;

class CertaintyFactorService
{
    private const FIELD_MAP = [
        'warna' => ['label' => 'Warna', 'kriteria' => 'Warna Biji', 'weight' => 0.25],
        'ukuran' => ['label' => 'Ukuran', 'kriteria' => 'Ukuran Biji', 'weight' => 0.20],
        'aroma' => ['label' => 'Aroma', 'kriteria' => 'Aroma', 'weight' => 0.20],
        'tekstur' => ['label' => 'Tekstur', 'kriteria' => 'Tekstur', 'weight' => 0.20],
        'kondisi_fisik' => ['label' => 'Kondisi Fisik', 'kriteria' => 'Kondisi Fisik', 'weight' => 0.15],
    ];

    private const FALLBACK_OPTIONS = [
        'sangat_baik' => 'Sangat Baik',
        'baik' => 'Baik',
        'cukup' => 'Cukup',
        'buruk' => 'Buruk',
    ];

    private const FALLBACK_GRADES = [
        'A' => ['label' => 'Grade A - Premium', 'priority' => 4, 'cf_min' => 0.75, 'cf_max' => 1.00],
        'B' => ['label' => 'Grade B - Menengah', 'priority' => 3, 'cf_min' => 0.50, 'cf_max' => 0.74],
        'C' => ['label' => 'Grade C - Rendah', 'priority' => 2, 'cf_min' => 0.25, 'cf_max' => 0.49],
        'D' => ['label' => 'Grade D - Tidak Layak', 'priority' => 1, 'cf_min' => 0.00, 'cf_max' => 0.24],
    ];

    private const FALLBACK_RULES = [
        'warna' => [
            'Coklat merata dan gelap' => ['A' => 0.90, 'B' => 0.40, 'C' => 0.10, 'D' => 0.05],
            'Coklat tapi tidak merata' => ['A' => 0.50, 'B' => 0.80, 'C' => 0.30, 'D' => 0.10],
            'Warna pucat/keabu-abuan' => ['A' => 0.10, 'B' => 0.40, 'C' => 0.80, 'D' => 0.30],
            'Hitam atau sangat tidak merata' => ['A' => 0.05, 'B' => 0.10, 'C' => 0.40, 'D' => 0.90],
        ],
        'ukuran' => [
            'Seragam dan besar' => ['A' => 0.90, 'B' => 0.40, 'C' => 0.10, 'D' => 0.05],
            'Cukup seragam' => ['A' => 0.50, 'B' => 0.80, 'C' => 0.30, 'D' => 0.10],
            'Kurang seragam' => ['A' => 0.10, 'B' => 0.40, 'C' => 0.80, 'D' => 0.30],
            'Sangat tidak seragam/kecil' => ['A' => 0.05, 'B' => 0.10, 'C' => 0.40, 'D' => 0.90],
        ],
        'aroma' => [
            'Aroma coklat khas fermentasi' => ['A' => 0.90, 'B' => 0.40, 'C' => 0.10, 'D' => 0.05],
            'Aroma coklat cukup baik' => ['A' => 0.50, 'B' => 0.80, 'C' => 0.30, 'D' => 0.10],
            'Aroma kurang/sedikit asam' => ['A' => 0.10, 'B' => 0.40, 'C' => 0.80, 'D' => 0.30],
            'Berbau busuk/asam menyengat' => ['A' => 0.05, 'B' => 0.10, 'C' => 0.40, 'D' => 0.90],
        ],
        'tekstur' => [
            'Keras dan padat' => ['A' => 0.90, 'B' => 0.40, 'C' => 0.10, 'D' => 0.05],
            'Cukup keras' => ['A' => 0.50, 'B' => 0.80, 'C' => 0.30, 'D' => 0.10],
            'Agak lembek' => ['A' => 0.10, 'B' => 0.40, 'C' => 0.80, 'D' => 0.30],
            'Sangat lembek/berair' => ['A' => 0.05, 'B' => 0.10, 'C' => 0.40, 'D' => 0.90],
        ],
        'kondisi_fisik' => [
            'Utuh, bersih, tidak berjamur' => ['A' => 0.90, 'B' => 0.40, 'C' => 0.10, 'D' => 0.05],
            'Ada sedikit cacat/bercak' => ['A' => 0.50, 'B' => 0.80, 'C' => 0.30, 'D' => 0.10],
            'Banyak cacat/jamur sedikit' => ['A' => 0.10, 'B' => 0.40, 'C' => 0.80, 'D' => 0.30],
            'Berjamur parah/ada serangga' => ['A' => 0.05, 'B' => 0.10, 'C' => 0.40, 'D' => 0.90],
        ],
    ];

    /**
     * @return array<string, array{field: string, label: string, weight: float, options: array<string, string>}>
     */
    public function criteria(): array
    {
        try {
            $criteriaRecords = Kriteria::with('pilihanKriteria.ruleCf.grade')->orderBy('id')->get();
        } catch (\Throwable) {
            $criteriaRecords = collect();
        }
        $criteria = [];

        foreach (self::FIELD_MAP as $field => $definition) {
            $record = $this->findCriterionRecord($criteriaRecords, $definition['kriteria']);
            $options = $record?->pilihanKriteria?->pluck('nama_pilihan', 'nama_pilihan')->all() ?? $this->fallbackOptionsForField($field);

            $criteria[$field] = [
                'field' => $field,
                'label' => $definition['label'],
                'weight' => $definition['weight'],
                'options' => $options,
            ];
        }

        return $criteria;
    }

    /**
     * @return array<string, string>
     */
    public function options(): array
    {
        return self::FALLBACK_OPTIONS;
    }

    /**
     * @return array<string, array{label: string, priority: int, cf_min: float, cf_max: float}>
     */
    public function grades(): array
    {
        try {
            $gradeRecords = GradeKualitas::orderBy('id')->get();
        } catch (\Throwable) {
            $gradeRecords = collect();
        }

        if ($gradeRecords->isEmpty()) {
            return self::FALLBACK_GRADES;
        }

        $grades = [];
        $priority = count($gradeRecords);

        foreach ($gradeRecords as $grade) {
            $grades[$grade->kode_grade] = [
                'label' => 'Grade ' . $grade->kode_grade . ' - ' . $grade->nama_grade,
                'priority' => $priority,
                'cf_min' => (float) $grade->cf_min,
                'cf_max' => (float) $grade->cf_max,
            ];

            $priority--;
        }

        return $grades;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function allowedSelections(): array
    {
        $allowedSelections = [];

        foreach ($this->criteria() as $field => $definition) {
            $allowedSelections[$field] = array_values(array_unique(array_merge(
                array_keys(self::FALLBACK_OPTIONS),
                array_keys($definition['options'])
            )));
        }

        return $allowedSelections;
    }

    /**
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
        $grades = $this->grades();
        $matrix = $this->buildEvidenceMatrix();

        $selectedCriteria = [];

        foreach ($criteria as $field => $definition) {
            if (! array_key_exists($field, $selections)) {
                throw new InvalidArgumentException('Kriteria ' . $definition['label'] . ' wajib diisi.');
            }

            $normalizedSelection = $this->normalizeSelection($selections[$field], $definition['options']);

            if ($normalizedSelection === null) {
                throw new InvalidArgumentException('Pilihan untuk ' . $definition['label'] . ' tidak valid.');
            }

            $selectedCriteria[] = [
                'field' => $field,
                'label' => $definition['label'],
                'selection_key' => $normalizedSelection,
                'selection_label' => $normalizedSelection,
                'weight' => $definition['weight'],
            ];
        }

        $rankings = [];

        foreach ($grades as $gradeKey => $gradeDefinition) {
            $score = 0.0;
            $details = [];

            foreach ($selectedCriteria as $criterion) {
                $evidence = $matrix[$criterion['field']][$criterion['selection_key']][$gradeKey] ?? 0.0;
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

    /**
     * @return array<string, array<string, array<string, float>>>
     */
    public function buildEvidenceMatrix(): array
    {
        try {
            $criteriaRecords = Kriteria::with('pilihanKriteria.ruleCf.grade')->orderBy('id')->get();
        } catch (\Throwable) {
            $criteriaRecords = collect();
        }
        $matrix = [];

        foreach (self::FIELD_MAP as $field => $definition) {
            $record = $this->findCriterionRecord($criteriaRecords, $definition['kriteria']);

            if ($record) {
                foreach ($record->pilihanKriteria as $choice) {
                    $grades = [];

                    foreach ($choice->ruleCf as $rule) {
                        $gradeKey = $rule->grade?->kode_grade ?? (string) $rule->grade_id;
                        $grades[$gradeKey] = (float) $rule->nilai_cf;
                    }

                    if ($grades !== []) {
                        $matrix[$field][$choice->nama_pilihan] = $grades;
                    }
                }

                if (($matrix[$field] ?? []) !== []) {
                    continue;
                }
            }

            $matrix[$field] = $this->fallbackRulesForField($field);
        }

        return $matrix;
    }

    private function combine(float $current, float $incoming): float
    {
        if ($current <= 0) {
            return $incoming;
        }

        return $current + ($incoming * (1 - $current));
    }

    /**
     * @param  iterable<int, Kriteria>  $criteriaRecords
     */
    private function findCriterionRecord(iterable $criteriaRecords, string $criterionName): ?Kriteria
    {
        foreach ($criteriaRecords as $record) {
            if ($this->normalizeText($record->nama_kriteria) === $this->normalizeText($criterionName)) {
                return $record;
            }
        }

        return null;
    }

    /**
     * @return array<string, string>
     */
    private function fallbackOptionsForField(string $field): array
    {
        return match ($field) {
            'warna' => [
                'Coklat merata dan gelap' => 'Coklat merata dan gelap',
                'Coklat tapi tidak merata' => 'Coklat tapi tidak merata',
                'Warna pucat/keabu-abuan' => 'Warna pucat/keabu-abuan',
                'Hitam atau sangat tidak merata' => 'Hitam atau sangat tidak merata',
            ],
            'ukuran' => [
                'Seragam dan besar' => 'Seragam dan besar',
                'Cukup seragam' => 'Cukup seragam',
                'Kurang seragam' => 'Kurang seragam',
                'Sangat tidak seragam/kecil' => 'Sangat tidak seragam/kecil',
            ],
            'aroma' => [
                'Aroma coklat khas fermentasi' => 'Aroma coklat khas fermentasi',
                'Aroma coklat cukup baik' => 'Aroma coklat cukup baik',
                'Aroma kurang/sedikit asam' => 'Aroma kurang/sedikit asam',
                'Berbau busuk/asam menyengat' => 'Berbau busuk/asam menyengat',
            ],
            'tekstur' => [
                'Keras dan padat' => 'Keras dan padat',
                'Cukup keras' => 'Cukup keras',
                'Agak lembek' => 'Agak lembek',
                'Sangat lembek/berair' => 'Sangat lembek/berair',
            ],
            'kondisi_fisik' => [
                'Utuh, bersih, tidak berjamur' => 'Utuh, bersih, tidak berjamur',
                'Ada sedikit cacat/bercak' => 'Ada sedikit cacat/bercak',
                'Banyak cacat/jamur sedikit' => 'Banyak cacat/jamur sedikit',
                'Berjamur parah/ada serangga' => 'Berjamur parah/ada serangga',
            ],
            default => self::FALLBACK_OPTIONS,
        };
    }

    /**
     * @return array<string, array<string, float>>
     */
    private function fallbackRulesForField(string $field): array
    {
        return self::FALLBACK_RULES[$field] ?? [];
    }

    /**
     * @param  array<string, string>  $availableOptions
     */
    private function normalizeSelection(string $selection, array $availableOptions): ?string
    {
        if (array_key_exists($selection, $availableOptions)) {
            return $selection;
        }

        if (in_array($selection, $availableOptions, true)) {
            return $selection;
        }

        $aliases = array_keys(self::FALLBACK_OPTIONS);
        $index = array_search($selection, $aliases, true);

        if ($index === false) {
            return null;
        }

        $labels = array_keys($availableOptions);

        return $labels[$index] ?? null;
    }

    private function normalizeText(string $value): string
    {
        $value = mb_strtolower($value);
        $value = preg_replace('/[^a-z0-9]+/u', '', $value) ?? $value;

        return $value;
    }
}