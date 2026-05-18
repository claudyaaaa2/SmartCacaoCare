<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CertaintyFactorService;
use App\Models\Kriteria;
use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalisisController extends Controller
{
    protected CertaintyFactorService $cfService;

    public function __construct(CertaintyFactorService $cfService)
    {
        $this->cfService = $cfService;
    }

    // Tampil form analisis
    public function index()
    {
        $kriteria = Kriteria::with('pilihanKriteria')->get();
        return view('user.analisis.index', compact('kriteria'));
    }

    // Proses analisis CF
    public function proses(Request $request)
    {
        // Validasi semua kriteria harus dipilih
        $kriteria = Kriteria::all();
        $rules    = [];

        foreach ($kriteria as $k) {
            $rules['pilihan_' . $k->id] = 'required';
        }

        $request->validate($rules);

        // Ambil pilihan user
        // Format: [kriteria_id => pilihan_kriteria_id]
        $selections = [];
        foreach ($kriteria as $k) {
            $selections[$k->id] = $request->input('pilihan_' . $k->id);
        }

        // Jalankan algoritma CF
        $hasil = $this->cfService->evaluate($selections);

        // Ambil hasil terbaik
        $bestGrade = $hasil['best_grade'];

        // Simpan ke database
        HasilAnalisis::create([
            'user_id'       => Auth::id(),
            'pilihan_user'  => $selections,
            'grade_hasil'   => $bestGrade['grade']->kode_grade,
            'persentase_cf' => $bestGrade['persentase'],
            'rekomendasi'   => $bestGrade['grade']->rekomendasi,
        ]);

        return view('user.analisis.hasil', [
            'hasil'     => $hasil,
            'bestGrade' => $bestGrade,
            'rankings'  => $hasil['rankings'],
        ]);
    }

    // Riwayat analisis user
    public function riwayat()
    {
        $riwayat = HasilAnalisis::where('user_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('user.analisis.riwayat', compact('riwayat'));
    }
}