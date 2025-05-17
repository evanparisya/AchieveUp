<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'nidn' => '2020108001',
                'username' => 'admin',
                'nama_dsn' => 'Dr. Andi Wijaya',
                'email_dsn' => 'andiwijaya@mail.com',
                'password_dsn' => Hash::make('admin123'), // hash password
                'foto_dsn' => null,
                'role_dsn' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108002',
                'username' => 'saridewi',
                'nama_dsn' => 'Prof. Sari Dewi',
                'email_dsn' => 'sari_dewi@example.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
