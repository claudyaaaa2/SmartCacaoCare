<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GradeKualitas;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = GradeKualitas::all();
        return view('admin.grade.index', compact('grades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_grade' => 'required',
            'deskripsi' => 'required',
            'saran_penanganan' => 'required'
        ]);

        GradeKualitas::create($data);
        return redirect()->back()->with('success', 'Grade berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $grade = GradeKualitas::findOrFail($id);
        $grade->update($request->all());
        return redirect()->back()->with('success', 'Grade berhasil diperbarui');
    }

    public function destroy($id)
    {
        GradeKualitas::destroy($id);
        return redirect()->back()->with('success', 'Grade berhasil dihapus');
    }
}