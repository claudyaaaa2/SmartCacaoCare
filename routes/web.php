<?php

use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\RuleCfController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('grade', GradeController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('rule-cf', RuleCfController::class);
    Route::resource('edukasi', EdukasiController::class);
    Route::resource('users', UserController::class);
    Route::resource('riwayat', RiwayatController::class);
});