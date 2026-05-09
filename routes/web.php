<?php

use App\Http\Controllers\PetaniController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PetaniController::class, 'index'])->name('home');

Route::prefix('petani')->name('petani.')->group(function () {
    Route::get('/', [PetaniController::class, 'index'])->name('index');
    Route::post('/analisis', [PetaniController::class, 'store'])->name('analyze');
});
