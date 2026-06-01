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
use App\Http\Controllers\Users\AnalisisController as UserAnalisisController;
use App\Http\Controllers\Users\DashboardController as UserDashboardController;
use App\Http\Controllers\Users\EdukasiController as UserEdukasiController;

// --- 1. GUEST ROUTES (Belum Login) ---
// Rute ini hanya bisa diakses oleh orang yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('welcome'); }); 
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- 2. USER / PETANI ROUTES ---
// Dilindungi Middleware: Wajib login & role harus 'user'
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/riwayat', [UserAnalisisController::class, 'riwayat'])->name('user.riwayat');
});

Route::prefix('petani')->group(function () {
    // Tampilkan form analisis di /petani untuk pengguna umum
    Route::get('/', [UserAnalisisController::class, 'index'])->name('petani.index');
    Route::get('/analisis', [UserAnalisisController::class, 'index'])->name('petani.analysis');
    Route::post('/analisis', [UserAnalisisController::class, 'store'])->name('petani.analyze');
});

// Public-facing edukasi route for main landing page
Route::get('/edukasi', [UserEdukasiController::class, 'index'])->name('mainpage.edukasi');

// --- 3. ADMIN ROUTES ---
// Dilindungi Middleware: Wajib login & role harus 'admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('grade', GradeController::class)->names('admin.grade');
    Route::resource('kriteria', KriteriaController::class)->names('admin.kriteria');
    Route::resource('rule-cf', RuleCfController::class)->names('admin.rule');
    Route::resource('edukasi', EdukasiController::class)->names('admin.edukasi');
    Route::resource('users', UserController::class)->names('admin.user');
    Route::resource('riwayat', RiwayatController::class)->names('admin.riwayat');
    
});

// --- ROUTE LOGOUT ---
// Wajib login untuk bisa logout
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');