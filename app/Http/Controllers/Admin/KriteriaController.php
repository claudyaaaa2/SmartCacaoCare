<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\PilihanKriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::with('pilihan')->get();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kriteria' => 'required']);
        Kriteria::create($request->only('nama_kriteria'));
        return redirect()->back()->with('success', 'Kriteria berhasil ditambah');
    }

    // Fungsi Tambah Pilihan Kriteria (Bobot CF)
    public function storePilihan(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'nama_pilihan' => 'required',
            'bobot' => 'required|numeric'
        ]);

        PilihanKriteria::create($request->all());
        return redirect()->back()->with('success', 'Pilihan & Bobot berhasil ditambah');
    }

    public function destroy($id)
    {
        Kriteria::destroy($id);
        return redirect()->back()->with('success', 'Kriteria dihapus');
    }
}