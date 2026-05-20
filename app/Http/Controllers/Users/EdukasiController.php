<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $edukasi = Edukasi::when($search !== '', function ($query) use ($search) {
                        $query->where(function ($innerQuery) use ($search) {
                            $innerQuery->where('judul', 'like', '%' . $search . '%')
                                ->orWhere('ringkasan', 'like', '%' . $search . '%')
                                ->orWhere('konten', 'like', '%' . $search . '%');
                        });
                    })
                    ->latest()
                    ->paginate(6)
                    ->withQueryString();

        return view('petani.edukasi.index', compact('edukasi', 'search'));
    }
}