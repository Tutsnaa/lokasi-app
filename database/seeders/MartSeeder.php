<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;

class MartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create([
            'nama_gedung' => 'Mart Pusat KPN Kamadhuk',
            'latitude'    => -8.67426225,
            'longitude'   => 115.21273856,
            'keterangan'  => 'Pertokoan/tempat perbelanjaan umum.',
            'foto'        => null,
        ]);
    }
}