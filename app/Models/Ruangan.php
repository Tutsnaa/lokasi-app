<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ruangan extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (opsional jika sesuai standar Laravel)
    protected $table = 'ruangan';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_gedung',
        'nama_ruangan',
        'lantai',
        'keterangan',
        'foto',
    ];

    /**
     * Relasi ke Model Gedung (Ruangan milik satu Gedung)
     */
    public function gedung(): BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'id_gedung');
    }
}