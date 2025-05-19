<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Joko Santoso',
            'Dewi Lestari',
            'Ivan Petrov',
            'Hans Müller',
            'Siti Aminah',
            'Bambang Hartono',
            'Anna Ivanova',
            'Greta Schmidt',
            'Rina Kusuma',
            'Andi Gunawan',
            'Alexei Smirnov',
            'Klaus Becker',
            'Teguh Raharjo',
            'Yulianti Puspita',
            'Olga Sokolova',
            'Lena Fischer',
            'Wahyu Prasetyo',
            'Sri Wahyuni',
            'Dmitry Ivanov',
            'Fritz Schneider'
        ];

        $nimStart = 2441070001;

        foreach ($names as $index => $name) {
            $nim = (string) ($nimStart + $index);
            $firstName = strtolower(Str::before($name, ' '));
            $email = $firstName . '@achieveup.com';
            $programStudiId = rand(1, 3);

            DB::table('mahasiswa')->insert([
                'nim' => $nim,
                'nama' => $name,
                'username' => $firstName,
                'email' => $email,
                'password' => Hash::make('password'),
                'foto' => null,
                'program_studi_id' => $programStudiId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
