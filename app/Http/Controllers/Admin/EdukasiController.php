<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;


class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::latest()->paginate(10);
        return view('admin.edukasi.index', compact('edukasi'));
    }

    public function create()
    {
        return view('admin.edukasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'kategori'  => 'required|in:budidaya,perawatan,panen,pasca_panen,hama_penyakit,kualitas',
            'ringkasan' => 'required|string',
            'konten'    => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/edukasi'), $filename);
            $data['thumbnail'] = $filename;
        }

        Edukasi::create($data);

        return redirect()->route('admin.edukasi.index')
                         ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Edukasi $edukasi)
    {
        return view('admin.edukasi.edit', compact('edukasi'));
    }

    public function update(Request $request, Edukasi $edukasi)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'kategori'  => 'required|in:budidaya,perawatan,panen,pasca_panen,hama_penyakit,kualitas',
            'ringkasan' => 'required|string',
            'konten'    => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($edukasi->thumbnail) {
                $oldPath = public_path('images/edukasi/' . $edukasi->thumbnail);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/edukasi'), $filename);
            $data['thumbnail'] = $filename;
        }

        $edukasi->update($data);

        return redirect()->route('admin.edukasi.index')
                         ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Edukasi $edukasi)
    {
        if ($edukasi->thumbnail) {
            $oldPath = public_path('images/edukasi/' . $edukasi->thumbnail);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $edukasi->delete();

        return redirect()->route('admin.edukasi.index')
                         ->with('success', 'Artikel berhasil dihapus!');
    }
}