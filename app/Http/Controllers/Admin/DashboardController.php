<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\HasilAnalisis;
use App\Models\Edukasi;
use App\Models\RuleCf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser     = User::where('role', 'user')->count();
        $totalKriteria = Kriteria::count();
        $totalAnalisis = HasilAnalisis::count();
        $totalEdukasi  = Edukasi::count();
        $totalRule     = RuleCf::count();

        $riwayatTerbaru = HasilAnalisis::with('user') ->latest() ->take(5) ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalKriteria',
            'totalAnalisis',
            'totalEdukasi',
            'totalRule',
            'riwayatTerbaru'
        ));
    }
}