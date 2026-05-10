<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilAnalisis;

class RiwayatController extends Controller
{
    public function index()
    {
        // Admin bisa melihat semua riwayat konsultasi petani
        $riwayat = HasilAnalisis::with(['user', 'grade'])->latest()->get();
        return view('admin.riwayat.index', compact('riwayat'));
    }

    public function show($id)
    {
        $detail = HasilAnalisis::with(['user', 'grade'])->findOrFail($id);
        return view('admin.riwayat.show', compact('detail'));
    }
}