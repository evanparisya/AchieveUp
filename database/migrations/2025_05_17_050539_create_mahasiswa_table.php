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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mhs');
            $table->string('nim', 20)->unique();
            $table->string('nama_mhs', 100);
            $table->string('username_mhs', 50)->unique();
            $table->string('email_mhs', 100)->unique();
            $table->string('password_mhs');
            $table->string('foto_mhs')->nullable();
            $table->unsignedBigInteger('program_studi');
            $table->timestamps();

            $table->foreign('program_studi')->references('id_prodi')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
