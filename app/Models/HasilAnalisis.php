<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    protected $table = 'hasil_analisis';
    protected $fillable = [
        'user_id',
        'grade_id',
        'nilai_cf',
        'detail_analisis' // Simpan data kriteria yang dipilih dalam bentuk JSON
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grade() {
        return $this->belongsTo(GradeKualitas::class, 'grade_id');
    }
}