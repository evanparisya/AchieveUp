<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($year = 2023; $year <= 2025; $year++) {
            $kodeGenap = $year . '-2';
            $namaGenap = 'Semester Genap ' . $year;

            $kodeGanjil = ($year + 1) . '-1';
            $namaGanjil = 'Semester Ganjil ' . ($year + 1);

            $data[] = [
                'kode' => $kodeGenap,
                'nama' => $namaGenap,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $data[] = [
                'kode' => $kodeGanjil,
                'nama' => $namaGanjil,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('periode')->insert($data);
    }
}
