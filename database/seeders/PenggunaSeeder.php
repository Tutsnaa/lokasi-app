<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'nama'          => 'Pegawai',
                'email'         => 'pegawai@example.com',
                'no_hp'         => '081234567890',
                'nama_pengguna' => 'pegawai',
                'kata_sandi'    => Hash::make('54321'),
                'role'          => 'karyawan',
                'status'        => 'aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}