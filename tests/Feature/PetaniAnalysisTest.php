<?php

it('shows the petani analysis form', function () {
    $response = $this->get('/petani');

    $response->assertOk();
    $response->assertSee('Analisis Mutu');
});

it('calculates the best grade from submitted selections', function () {
    $response = $this->post('/petani/analisis', [
        'warna' => 'sangat_baik',
        'ukuran' => 'sangat_baik',
        'aroma' => 'sangat_baik',
        'tekstur' => 'sangat_baik',
        'kondisi_fisik' => 'sangat_baik',
    ]);

    $response->assertOk();
    $response->assertSee('Grade A - Premium');
});