<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Controller Admin bawaan Ardiansyah
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\RuleCfController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RiwayatController;

// --- 1. GUEST ROUTES (Belum Login) ---
// Rute ini hanya bisa diakses oleh orang yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('landing'); }); 
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- 2. USER / PETANI ROUTES ---
// Dilindungi Middleware: Wajib login & role harus 'user'
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () { return "Ini Halaman Dashboard Petani"; })->name('user.dashboard');
    // Nanti rute Analisis CF buatan Darean dimasukkan ke dalam blok ini
});

// --- 3. ADMIN ROUTES ---
// Dilindungi Middleware: Wajib login & role harus 'admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('grade', GradeController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('rule-cf', RuleCfController::class);
    Route::resource('edukasi', EdukasiController::class);
    Route::resource('users', UserController::class);
    Route::resource('riwayat', RiwayatController::class);
    
});

// --- ROUTE LOGOUT ---
// Wajib login untuk bisa logout
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');