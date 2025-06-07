<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // ProgramStudiSeeder::class,
            // PeriodeSeeder::class,
            // BidangSeeder::class,
            // MahasiswaSeeder::class,
            // DosenSeeder::class,
            
            // PrestasiSeeder::class,
            // BidangPrestasiSeeder::class,
            // BidanglombaSeeder::class,
            // PrestasiMahasiswa::class,
            // PembimbingPrestasi::class,

            // LombaSeeder::class,
            PengajuanLombaMhsSeeder::class
        ]);
    }
}
