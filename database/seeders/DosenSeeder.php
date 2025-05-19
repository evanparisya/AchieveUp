<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Agus Prasetyo', // admin
            'Suryani Lestari',
            'Budi Santosa',
            'Lina Hartati',
            'Ivan Nikolaev',
            'Greta Schneider',
            'Anton Rahman',
            'Nina Kartika',
            'Sergei Petrov',
            'Helga Bauer'
        ];

        $nidnStart = 1001000001;

        foreach ($names as $index => $name) {
            $nidn = (string) ($nidnStart + $index);
            $firstName = strtolower(Str::before($name, ' '));
            $email = $firstName . '@achieveup.ac.id';
            $role = $index === 0 ? 'admin' : 'dosen pembimbing';

            DB::table('dosen')->insert([
                'nidn' => $nidn,
                'username' => $firstName,
                'nama' => $name,
                'email' => $email,
                'password' => Hash::make('dosen123'),
                'foto' => null,
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
