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
        'role', // Tambahkan ini jika ada pemisahan admin/petani
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}