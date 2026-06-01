<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnalisisController extends Controller
{
    public function __construct(private readonly CertaintyFactorService $certaintyFactorService)
    {
    }

    public function index()
    {
        return view('petani.index', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        $result = $this->certaintyFactorService->evaluate($validated);

        if (auth()->check()) {
            \App\Models\HasilAnalisis::create([
                'user_id' => auth()->id(),
                'pilihan_user' => $validated,
                'grade_hasil' => $result['best_grade']['grade_key'],
                'persentase_cf' => $result['best_grade']['percentage'],
                'rekomendasi' => \App\Models\GradeKualitas::where('kode_grade', $result['best_grade']['grade_key'])->value('rekomendasi') ?? 'Lakukan pemeliharaan dan pasca panen yang baik.',
            ]);
        }

        return view('petani.index', $this->formData($result, $validated));
    }

    public function riwayat()
    {
        $riwayat = \App\Models\HasilAnalisis::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('petani.riwayat', compact('riwayat'));
    }

    private function validationRules(): array
    {
        $rules = [];

        foreach ($this->certaintyFactorService->allowedSelections() as $field => $allowedSelections) {
            $rules[$field] = ['required', Rule::in($allowedSelections)];
        }

        return $rules;
    }

    private function formData(?array $result = null, array $selected = []): array
    {
        return [
            'criteria' => $this->certaintyFactorService->criteria(),
            'options' => $this->certaintyFactorService->options(),
            'result' => $result,
            'selected' => $selected,
        ];
    }
}