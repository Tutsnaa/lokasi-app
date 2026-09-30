<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menentukan nama tabel secara spesifik
    protected $table = 'pengguna';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'nama_pengguna',
        'kata_sandi',
        'role',
        'status',
    ];

    // Kolom yang disembunyikan saat data di-serialize (misal ke JSON/API response)
    protected $hidden = [
        'kata_sandi',
    ];

    // Menyesuaikan kolom password default Laravel dengan kolom 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}