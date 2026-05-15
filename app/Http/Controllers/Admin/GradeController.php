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

    public function create()
    {
        return view('admin.grade.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_grade'  => 'required|string|max:2|unique:grade_kualitas',
            'nama_grade'  => 'required|string|max:100',
            'cf_min'      => 'required|numeric|min:0|max:1',
            'cf_max'      => 'required|numeric|min:0|max:1',
            'deskripsi'   => 'required|string',
            'rekomendasi' => 'required|string',
        ]);

        GradeKualitas::create($request->all());

        return redirect()->route('admin.grade.index')
                         ->with('success', 'Grade berhasil ditambahkan!');
    }

    public function edit(GradeKualitas $grade)
    {
        return view('admin.grade.edit', compact('grade'));
    }

    public function update(Request $request, GradeKualitas $grade)
    {
        $request->validate([
            'nama_grade'  => 'required|string|max:100',
            'cf_min'      => 'required|numeric|min:0|max:1',
            'cf_max'      => 'required|numeric|min:0|max:1',
            'deskripsi'   => 'required|string',
            'rekomendasi' => 'required|string',
        ]);

        $grade->update($request->all());

        return redirect()->route('admin.grade.index')
                         ->with('success', 'Grade berhasil diperbarui!');
    }

    public function destroy(GradeKualitas $grade)
    {
        $grade->delete();

        return redirect()->route('admin.grade.index')
                         ->with('success', 'Grade berhasil dihapus!');
    }
}