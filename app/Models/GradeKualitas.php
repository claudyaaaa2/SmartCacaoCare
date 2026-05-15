<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeKualitas extends Model
{
    protected $table = 'grade_kualitas';

    protected $fillable = [
        'kode_grade',
        'nama_grade',
        'cf_min',
        'cf_max',
        'deskripsi',
        'rekomendasi',
    ];

    public function ruleCf()
    {
        return $this->hasMany(RuleCf::class, 'grade_id');
    }
}