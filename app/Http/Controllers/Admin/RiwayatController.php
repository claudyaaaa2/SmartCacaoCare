<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilAnalisis;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = HasilAnalisis::with('user')
                    ->latest()
                    ->paginate(10);

        return view('admin.riwayat.index', compact('riwayat'));
    }
    
}