<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul' => 'National UI/UX Championship',
                'tempat' => 'Jakarta Convention Center',
                'tanggal_daftar' => '2025-06-01',
                'tanggal_daftar_terakhir' => '2025-06-15',
                'url' => 'https://uiuxchamp.id',
                'tingkat' => 'nasional',
                'is_individu' => true,
                'is_active' => true,
                'file_poster' => 'poster_uiux.jpg',
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'ASEAN Cyber Security Challenge',
                'tempat' => 'Singapore Expo',
                'tanggal_daftar' => '2025-07-10',
                'tanggal_daftar_terakhir' => '2025-07-25',
                'url' => 'https://aseancyber.org',
                'tingkat' => 'internasional',
                'is_individu' => false,
                'is_active' => true,
                'file_poster' => 'cybersec_poster.pdf',
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'West Java Business Plan Competition',
                'tempat' => 'Bandung Creative Hub',
                'tanggal_daftar' => '2025-08-05',
                'tanggal_daftar_terakhir' => '2025-08-20',
                'url' => null,
                'tingkat' => 'provinsi',
                'is_individu' => true,
                'is_active' => false,
                'file_poster' => null,
                'is_akademik' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Regional App Development Hackathon',
                'tempat' => 'Surabaya Techno Park',
                'tanggal_daftar' => '2025-09-01',
                'tanggal_daftar_terakhir' => '2025-09-15',
                'url' => 'https://hackregional.dev',
                'tingkat' => 'regional',
                'is_individu' => false,
                'is_active' => true,
                'file_poster' => 'hackathon.jpg',
                'is_akademik' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'International Data Science Olympiad',
                'tempat' => 'Berlin University of Technology',
                'tanggal_daftar' => '2025-10-01',
                'tanggal_daftar_terakhir' => '2025-10-30',
                'url' => 'https://datascienceolymp.org',
                'tingkat' => 'internasional',
                'is_individu' => true,
                'is_active' => false,
                'file_poster' => null,
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('lomba')->insert($data);
    }
}
