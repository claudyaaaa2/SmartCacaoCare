<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Relasi ke hasil analisis
    public function hasilAnalisis()
    {
        return $this->hasMany(HasilAnalisis::class);
    }
}