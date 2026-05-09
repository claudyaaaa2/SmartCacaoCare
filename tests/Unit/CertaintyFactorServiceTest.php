<?php

use App\Services\CertaintyFactorService;

it('returns grade A for consistently high selections', function () {
    $service = app(CertaintyFactorService::class);

    $result = $service->evaluate([
        'warna' => 'sangat_baik',
        'ukuran' => 'sangat_baik',
        'aroma' => 'sangat_baik',
        'tekstur' => 'sangat_baik',
        'kondisi_fisik' => 'sangat_baik',
    ]);

    expect($result['best_grade']['grade_key'])->toBe('A')
        ->and($result['best_grade']['label'])->toContain('Premium');
});

it('returns grade D for consistently low selections', function () {
    $service = app(CertaintyFactorService::class);

    $result = $service->evaluate([
        'warna' => 'buruk',
        'ukuran' => 'buruk',
        'aroma' => 'buruk',
        'tekstur' => 'buruk',
        'kondisi_fisik' => 'buruk',
    ]);

    expect($result['best_grade']['grade_key'])->toBe('D');
});