<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            ['kode' => 'UIUX', 'nama' => 'UI/UX Designer'],
            ['kode' => 'CYBER', 'nama' => 'Cyber Security'],
            ['kode' => 'APPDEV', 'nama' => 'Application Development'],
            ['kode' => 'DATASCI', 'nama' => 'Data Science'],
            ['kode' => 'BIZPLAN', 'nama' => 'Business Plan'],
        ];

        foreach ($bidangs as $bidang) {
            DB::table('bidang')->insert([
                'kode' => $bidang['kode'],
                'nama' => $bidang['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
