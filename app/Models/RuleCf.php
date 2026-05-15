<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleCf extends Model
{
    protected $table = 'rule_cf';

    protected $fillable = [
        'pilihan_kriteria_id',
        'grade_id',
        'nilai_cf',
    ];

    public function pilihanKriteria()
    {
        return $this->belongsTo(PilihanKriteria::class, 'pilihan_kriteria_id');
    }

    public function grade()
    {
        return $this->belongsTo(GradeKualitas::class, 'grade_id');
    }
}