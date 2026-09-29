<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 225);
            $table->string('email', 150)->unique();
            $table->string('no_hp', 20);
            $table->string('nama_pengguna', 100);
            $table->string('kata_sandi', 100);
            $table->enum('role', ['admin', 'karyawan']);    
            $table->enum('status', ['aktif', 'nonaktif']);

            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};