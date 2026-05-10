<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GradeKualitas extends Model {
    protected $table = 'grade_kualitas';
    protected $fillable = ['nama_grade', 'deskripsi', 'saran_penanganan'];
}