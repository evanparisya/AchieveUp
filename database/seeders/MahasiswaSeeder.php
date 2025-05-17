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
                'nim' => '222107023001',
                'nama_mhs' => 'Sarwono Haryadi',
                'username_mhs' => 'ryadis',
                'email_mhs' => 'ryadi@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '244107023002',
                'nama_mhs' => 'Ilya Kosipov',
                'username_mhs' => 'monesy',
                'email_mhs' => 'ilya@mail.com',
                'password_mhs' => Hash::make('password123'),
                'foto_mhs' => null,
                'program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
