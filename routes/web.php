<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\RuleCfController;
use App\Http\Controllers\Admin\EdukasiController as AdminEdukasi;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\AnalisisController;
use App\Http\Controllers\User\EdukasiController as UserEdukasi;

// --- LANDING PAGE ---
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// --- GUEST ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- LOGOUT ---
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- USER ROUTES ---
Route::middleware(['auth', 'role:user'])
     ->prefix('user')
     ->name('user.')
     ->group(function () {

    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');

    // Analisis
    Route::get('/analisis',          [AnalisisController::class, 'index'])->name('analisis');
    Route::post('/analisis/proses',  [AnalisisController::class, 'proses'])->name('analisis.proses');
    Route::get('/riwayat',           [AnalisisController::class, 'riwayat'])->name('riwayat');

    // Edukasi
    Route::get('/edukasi',       [UserEdukasi::class, 'index'])->name('edukasi');
    Route::get('/edukasi/{id}',  [UserEdukasi::class, 'show'])->name('edukasi.show');
});

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Grade
    Route::resource('grade', GradeController::class);

    // Kriteria
    Route::resource('kriteria', KriteriaController::class);

    // Rule CF
    Route::resource('rule', RuleCfController::class);

    // Edukasi
    Route::resource('edukasi', AdminEdukasi::class);

    // User
    Route::get('/user',          [UserController::class, 'index'])->name('user.index');
    Route::delete('/user/{user}',[UserController::class, 'destroy'])->name('user.destroy');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});