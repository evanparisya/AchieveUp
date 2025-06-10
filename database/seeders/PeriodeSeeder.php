<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan delete instead of truncate untuk avoid foreign key constraint
        DB::table('periode')->delete();

        $data = [];
        $currentDate = Carbon::now(); // 2025-06-09
        $currentYear = $currentDate->year; // 2025
        $currentMonth = $currentDate->month; // 6 (Juni)

        for ($year = 2023; $year <= 2025; $year++) {
            // Semester Genap (Januari - Juni)
            $kodeGenap = $year . '-2';
            $namaGenap = 'Semester Genap ' . ($year - 1) . '/' . $year;

            // Tentukan apakah semester genap ini aktif
            $isGenapActive = ($year == $currentYear && $currentMonth >= 1 && $currentMonth <= 6);

            // Semester Ganjil (Juli - Desember)
            $kodeGanjil = ($year + 1) . '-1';
            $namaGanjil = 'Semester Ganjil ' . $year . '/' . ($year + 1);

            // Tentukan apakah semester ganjil ini aktif
            $isGanjilActive = ($year == $currentYear && $currentMonth >= 7 && $currentMonth <= 12);

            $data[] = [
                'kode' => $kodeGenap,
                'nama' => $namaGenap,
                'is_active' => $isGenapActive,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $data[] = [
                'kode' => $kodeGanjil,
                'nama' => $namaGanjil,
                'is_active' => $isGanjilActive,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('periode')->insert($data);
    }
}
