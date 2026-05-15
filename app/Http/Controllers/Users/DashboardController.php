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
        return redirect()->route('petani.analysis');
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