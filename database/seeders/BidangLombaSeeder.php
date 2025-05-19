<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bidang_lomba')->insert([
            [
                'bidang_id' => 1, // UI/UX Designer
                'lomba_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 2, // Cyber Security
                'lomba_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 3, // Application Development
                'lomba_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 4, // Data Science
                'lomba_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 5, // Business Plan
                'lomba_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
