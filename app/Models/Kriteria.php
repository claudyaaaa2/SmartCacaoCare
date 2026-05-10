<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model {
    protected $table = 'kriteria';
    protected $fillable = ['nama_kriteria'];

    public function pilihan() {
        return $this->hasMany(PilihanKriteria::class, 'kriteria_id');
    }
}