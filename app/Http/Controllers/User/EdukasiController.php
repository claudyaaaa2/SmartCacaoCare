<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;

        $edukasi = Edukasi::when($kategori, function ($query) use ($kategori) {
                        return $query->where('kategori', $kategori);
                    })
                    ->latest()
                    ->paginate(9);

        return view('user.edukasi.index', compact('edukasi', 'kategori'));
    }

    public function show($id)
    {
        $edukasi = Edukasi::findOrFail($id);

        // Ambil artikel lain sebagai rekomendasi
        $artikelLain = Edukasi::where('id', '!=', $id)
                        ->where('kategori', $edukasi->kategori)
                        ->take(3)
                        ->get();

        return view('user.edukasi.show', compact('edukasi', 'artikelLain'));
    }
}