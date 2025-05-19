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
            // MahasiswaSeeder::class,
            // DosenSeeder::class,
            // ProgramStudiSeeder::class,
            // PeriodeSeeder::class,
            // BidangSeeder::class,
            // LombaSeeder::class,
            PrestasiSeeder::class,
            BidangPrestasiSeeder::class,
            BidanglombaSeeder::class,
        ]);
    }
}
