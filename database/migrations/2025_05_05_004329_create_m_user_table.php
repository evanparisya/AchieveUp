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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('identifier', 20);
            $table->string('username', 50)->unique();
            $table->string('full_name', 100);
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->enum('role', ['mahasiswa', 'dosen', 'admin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
