<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleCf extends Model
{
    protected $table = 'rule_cf';
    protected $fillable = ['grade_id', 'kriteria_id'];

    public function grade() { return $this->belongsTo(GradeKualitas::class); }
    public function kriteria() { return $this->belongsTo(Kriteria::class); }
}