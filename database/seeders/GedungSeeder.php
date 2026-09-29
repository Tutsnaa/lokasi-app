<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data sampel gedung
        $dataGedung = [
            [
                'nama_gedung' => 'Mart Pusat KPN Kamadhuk',
                'latitude'    => -8.67426225,
                'longitude'   => 115.21273856,
                'keterangan'  => 'Pertokoan/tempat perbelanjaan umum.',
                'foto'        => null,
            ],
            [
                'nama_gedung' => 'Pura Cadu Sakti',
                'latitude'    => -8.67438585,
                'longitude'   => 115.21212622,
                'keterangan'  => 'Pura tempat persembahyangan.',
                'foto'        => null,
            ],
        ];

        foreach ($dataGedung as $gedung) {
            Gedung::create($gedung);
        }
    }
}