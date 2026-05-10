<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuleCf;
use App\Models\GradeKualitas;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class RuleCfController extends Controller
{
    public function index()
    {
        $rules = RuleCf::with(['grade', 'kriteria'])->get();
        $grades = GradeKualitas::all();
        $kriterias = Kriteria::all();
        return view('admin.rule_cf.index', compact('rules', 'grades', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required',
            'kriteria_id' => 'required'
        ]);

        RuleCf::create($request->all());
        return redirect()->back()->with('success', 'Aturan CF berhasil ditambahkan');
    }

    public function destroy($id)
    {
        RuleCf::destroy($id);
        return redirect()->back()->with('success', 'Aturan berhasil dihapus');
    }
}