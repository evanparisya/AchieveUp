<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiMahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestasi_mahasiswa')->insert([
            [
                'prestasi_id' => 1,
                'mahasiswa_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prestasi_id' => 1,
                'mahasiswa_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prestasi_id' => 1,
                'mahasiswa_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
