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

        return view('petani.index', $this->formData($result, $validated));
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