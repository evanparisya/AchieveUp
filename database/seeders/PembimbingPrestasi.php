<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembimbingPrestasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembimbing_prestasi')->insert([
            [
                'prestasi_id' => 1,
                'dosen_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prestasi_id' => 2,
                'dosen_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
