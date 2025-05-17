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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dsn');
            $table->string('nidn', 20)->unique();
            $table->string('username', 50)->unique();
            $table->string('nama_dsn', 100);
            $table->string('email_dsn', 100)->unique();
            $table->string('password_dsn');
            $table->string('foto_dsn')->nullable();
            $table->enum('role_dsn', ['admin', 'dosen pembimbing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
