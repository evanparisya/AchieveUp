<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([            
            [
                'nim' => '233107023003',
                'nama_mhs' => 'Jatmiko Wibowo',
                'username_mhs' => 'jatmiko',
                'email_mhs' => 'jatmiko@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023004',
                'nama_mhs' => 'Sundari Rahayu',
                'username_mhs' => 'sundari',
                'email_mhs' => 'sundari@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023005',
                'nama_mhs' => 'Bagus Prabowo',
                'username_mhs' => 'bagus',
                'email_mhs' => 'bagus@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023006',
                'nama_mhs' => 'Dewi Sartika',
                'username_mhs' => 'dewi',
                'email_mhs' => 'dewi@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023007',
                'nama_mhs' => 'Suryo Nugroho',
                'username_mhs' => 'suryo',
                'email_mhs' => 'suryo@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023008',
                'nama_mhs' => 'Rini Kartika',
                'username_mhs' => 'rini',
                'email_mhs' => 'rini@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023009',
                'nama_mhs' => 'Wahyu Santoso',
                'username_mhs' => 'wahyu',
                'email_mhs' => 'wahyu@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023010',
                'nama_mhs' => 'Maya Sari',
                'username_mhs' => 'maya',
                'email_mhs' => 'maya@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023011',
                'nama_mhs' => 'Agus Setiawan',
                'username_mhs' => 'agus',
                'email_mhs' => 'agus@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023012',
                'nama_mhs' => 'Nina Melati',
                'username_mhs' => 'nina',
                'email_mhs' => 'nina@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023013',
                'nama_mhs' => 'Hadi Susanto',
                'username_mhs' => 'hadi',
                'email_mhs' => 'hadi@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023014',
                'nama_mhs' => 'Ratna Dewi',
                'username_mhs' => 'ratna',
                'email_mhs' => 'ratna@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '233107023015',
                'nama_mhs' => 'Teguh Prasetyo',
                'username_mhs' => 'teguh',
                'email_mhs' => 'teguh@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
