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
                'nama_gedung' => 'Gedung Rektorat',
                'latitude'    => -6.17539240,
                'longitude'   => 106.82715300,
                'keterangan'  => 'Gedung utama pusat administrasi dan rektorat.',
                'foto'        => null,
            ],
            [
                'nama_gedung' => 'Gedung Fakultas Teknik',
                'latitude'    => -6.17600000,
                'longitude'   => 106.82800000,
                'keterangan'  => 'Gedung perkuliahan mahasiswa Fakultas Teknik.',
                'foto'        => null,
            ],
            [
                'nama_gedung' => 'Gedung Perpustakaan Pusat',
                'latitude'    => -6.17700000,
                'longitude'   => 106.82900000,
                'keterangan'  => 'Perpustakaan umum dan fasilitas laboratorium komputer.',
                'foto'        => null,
            ],
        ];

        foreach ($dataGedung as $gedung) {
            Gedung::create($gedung);
        }
    }
}