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
                'nidn' => '2020108003',
                'username' => 'budianto',
                'nama_dsn' => 'Dr. Budianto Santoso',
                'email_dsn' => 'budianto@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108004',
                'username' => 'intansari',
                'nama_dsn' => 'Dr. Intan Sari',
                'email_dsn' => 'intan_sari@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108005',
                'username' => 'rahmadi',
                'nama_dsn' => 'Prof. Rahmadi Setiawan',
                'email_dsn' => 'rahmadi@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108006',
                'username' => 'melindap',
                'nama_dsn' => 'Dr. Melinda Putri',
                'email_dsn' => 'melinda@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108007',
                'username' => 'aryanto',
                'nama_dsn' => 'Dr. Aryanto Wibowo',
                'email_dsn' => 'aryanto@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108008',
                'username' => 'nurislam',
                'nama_dsn' => 'Dr. Nur Islam',
                'email_dsn' => 'nur_islam@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108009',
                'username' => 'rinas',
                'nama_dsn' => 'Prof. Rina Susanti',
                'email_dsn' => 'rina@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108010',
                'username' => 'joko',
                'nama_dsn' => 'Dr. Joko Prasetyo',
                'email_dsn' => 'joko@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108011',
                'username' => 'dewikasih',
                'nama_dsn' => 'Dr. Dewi Kasih',
                'email_dsn' => 'dewikasih@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108012',
                'username' => 'haryanto',
                'nama_dsn' => 'Prof. Haryanto Wijaya',
                'email_dsn' => 'haryanto@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108013',
                'username' => 'putriman',
                'nama_dsn' => 'Dr. Putri Manik',
                'email_dsn' => 'putriman@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108014',
                'username' => 'sigit',
                'nama_dsn' => 'Dr. Sigit Pranoto',
                'email_dsn' => 'sigit@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '2020108015',
                'username' => 'ayu',
                'nama_dsn' => 'Prof. Ayu Lestari',
                'email_dsn' => 'ayu@mail.com',
                'password_dsn' => Hash::make('dosbing123'),
                'foto_dsn' => null,
                'role_dsn' => 'dosen pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
