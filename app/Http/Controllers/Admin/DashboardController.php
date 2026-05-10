<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\HasilAnalisis;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik singkat untuk kotak informasi di dashboard
        $data = [
            'total_petani'   => User::where('role', 'user')->count(),
            'total_kriteria' => Kriteria::count(),
            'total_diagnosis' => HasilAnalisis::count(),
            'total_artikel'  => Edukasi::count(),
            // Mengambil 5 riwayat diagnosis terbaru untuk ditampilkan di tabel dashboard
            'riwayat_terbaru' => HasilAnalisis::with(['user', 'grade'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}