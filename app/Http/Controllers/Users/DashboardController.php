<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\CertaintyFactorService;

class DashboardController extends Controller
{
    public function __construct(private readonly CertaintyFactorService $certaintyFactorService)
    {
    }

    public function index()
    {
        return view('petani.dashboard', $this->formData());
    }

    private function formData(?array $result = null, array $selected = []): array
    {
        return [
            'criteriaCount' => count($this->certaintyFactorService->criteria()),
            'gradeCount' => count($this->certaintyFactorService->grades()),
            'fieldLabels' => array_values(array_map(
                fn ($definition) => $definition['label'] ?? '',
                $this->certaintyFactorService->criteria()
            )),
        ];
    }
}