<?php

namespace App\Http\Controllers;

use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function __construct(private readonly CertaintyFactorService $certaintyFactorService)
    {
    }

    public function index()
    {
        return view('petani.index', [
            'criteria' => $this->certaintyFactorService->criteria(),
            'options' => $this->certaintyFactorService->options(),
            'result' => null,
            'selected' => [],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warna' => ['required', 'in:sangat_baik,baik,cukup,buruk'],
            'ukuran' => ['required', 'in:sangat_baik,baik,cukup,buruk'],
            'aroma' => ['required', 'in:sangat_baik,baik,cukup,buruk'],
            'tekstur' => ['required', 'in:sangat_baik,baik,cukup,buruk'],
            'kondisi_fisik' => ['required', 'in:sangat_baik,baik,cukup,buruk'],
        ]);

        $result = $this->certaintyFactorService->evaluate($validated);

        return view('petani.index', [
            'criteria' => $this->certaintyFactorService->criteria(),
            'options' => $this->certaintyFactorService->options(),
            'result' => $result,
            'selected' => $validated,
        ]);
    }
}