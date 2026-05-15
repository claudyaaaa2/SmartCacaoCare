<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::latest()->paginate(6);

        return view('petani.edukasi.index', compact('edukasi'));
    }
}