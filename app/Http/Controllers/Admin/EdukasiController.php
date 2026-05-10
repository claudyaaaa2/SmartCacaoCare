<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EdukasiController extends Controller
{
    public function index() {
        $edukasi = Edukasi::latest()->get();
        return view('admin.edukasi.index', compact('edukasi'));
    }

    public function create() {
        return view('admin.edukasi.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'kategori' => 'required'
        ]);

        Edukasi::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            // Jika ada upload gambar, tambahkan logika di sini
        ]);

        return redirect()->route('edukasi.index')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id) {
        Edukasi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}