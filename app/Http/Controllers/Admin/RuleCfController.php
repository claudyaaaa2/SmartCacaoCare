<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuleCf;
use App\Models\GradeKualitas;
use App\Models\PilihanKriteria;
use Illuminate\Http\Request;

class RuleCfController extends Controller
{
    public function index()
    {
        $rules   = RuleCf::with(['pilihanKriteria.kriteria', 'grade'])->get();
        return view('admin.rule.index', compact('rules'));
    }

    public function create()
    {
        $grades  = GradeKualitas::all();
        $pilihan = PilihanKriteria::with('kriteria')->get();
        return view('admin.rule.create', compact('grades', 'pilihan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pilihan_kriteria_id' => 'required|exists:pilihan_kriteria,id',
            'grade_id'            => 'required|exists:grade_kualitas,id',
            'nilai_cf'            => 'required|numeric|min:0|max:1',
        ]);

        RuleCf::create($request->all());

        return redirect()->route('admin.rule.index')
                         ->with('success', 'Rule CF berhasil ditambahkan!');
    }

    public function edit(RuleCf $rule)
    {
        $grades  = GradeKualitas::all();
        $pilihan = PilihanKriteria::with('kriteria')->get();
        return view('admin.rule.edit', compact('rule', 'grades', 'pilihan'));
    }

    public function update(Request $request, RuleCf $rule)
    {
        $request->validate([
            'pilihan_kriteria_id' => 'required|exists:pilihan_kriteria,id',
            'grade_id'            => 'required|exists:grade_kualitas,id',
            'nilai_cf'            => 'required|numeric|min:0|max:1',
        ]);

        $rule->update($request->all());

        return redirect()->route('admin.rule.index')
                         ->with('success', 'Rule CF berhasil diperbarui!');
    }

    public function destroy(RuleCf $rule)
    {
        $rule->delete();

        return redirect()->route('admin.rule.index')
                         ->with('success', 'Rule CF berhasil dihapus!');
    }
}