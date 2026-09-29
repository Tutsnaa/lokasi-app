<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';

    protected $fillable = [
        'nama_gedung',
        'latitude',
        'longitude',
        'keterangan',
        'foto',
    ];

    /**
     * Relasi ke model Ruangan (opsional, jika 1 gedung punya banyak ruangan)
     */
    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'gedung_id');
    }
}