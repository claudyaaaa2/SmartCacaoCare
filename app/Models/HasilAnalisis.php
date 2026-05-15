<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    protected $table = 'hasil_analisis';

    protected $fillable = [
        'user_id',
        'pilihan_user',
        'grade_hasil',
        'persentase_cf',
        'rekomendasi',
    ];

    protected $casts = [
        'pilihan_user' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}