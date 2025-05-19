<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tanggal_pengajuan' => '2025-05-01',
                'judul' => 'Juara 1 Lomba UI/UX Nasional',
                'tempat' => 'Universitas Indonesia',
                'tanggal_mulai' => '2025-04-20',
                'tanggal_selesai' => '2025-04-22',
                'url' => 'https://kompetisi-uiux.id',
                'tingkat' => 'nasional',
                'juara' => 1,
                'is_individu' => true,
                'status' => 'disetujui',
                'foto_kegiatan' => 'foto_uiux.jpg',
                'nomor_surat_tugas' => 'UI/UX/123/2025',
                'tanggal_surat_tugas' => '2025-04-15',
                'file_surat_tugas' => 'surat_uiux.pdf',
                'file_sertifikat' => 'sertifikat_uiux.pdf',
                'file_poster' => 'poster_uiux.jpg',
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pengajuan' => '2025-06-10',
                'judul' => 'Runner Up Business Plan Competition',
                'tempat' => 'ITB Bandung',
                'tanggal_mulai' => '2025-05-30',
                'tanggal_selesai' => '2025-06-01',
                'url' => null,
                'tingkat' => 'provinsi',
                'juara' => 2,
                'is_individu' => false,
                'status' => 'pending',
                'foto_kegiatan' => null,
                'nomor_surat_tugas' => 'BP/2025/07',
                'tanggal_surat_tugas' => '2025-05-25',
                'file_surat_tugas' => 'surat_bp.pdf',
                'file_sertifikat' => 'sertifikat_bp.pdf',
                'file_poster' => null,
                'is_akademik' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pengajuan' => '2025-07-15',
                'judul' => '3rd Place Data Science Regional',
                'tempat' => 'UNESA Surabaya',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-03',
                'url' => 'https://ds-regional.id',
                'tingkat' => 'regional',
                'juara' => 3,
                'is_individu' => true,
                'status' => 'ditolak',
                'foto_kegiatan' => 'foto_ds.jpg',
                'nomor_surat_tugas' => 'DS/REG/2025/009',
                'tanggal_surat_tugas' => '2025-06-28',
                'file_surat_tugas' => 'surat_ds.pdf',
                'file_sertifikat' => 'sertifikat_ds.pdf',
                'file_poster' => 'poster_ds.jpg',
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pengajuan' => '2025-08-20',
                'judul' => 'Gold Medal Cyber Security Olympiad',
                'tempat' => 'Chulalongkorn University, Bangkok',
                'tanggal_mulai' => '2025-08-10',
                'tanggal_selesai' => '2025-08-15',
                'url' => 'https://cybersec-olymp.org',
                'tingkat' => 'internasional',
                'juara' => 1,
                'is_individu' => false,
                'status' => 'disetujui',
                'foto_kegiatan' => 'cybersec.jpg',
                'nomor_surat_tugas' => 'CSO/INT/2025/112',
                'tanggal_surat_tugas' => '2025-08-01',
                'file_surat_tugas' => 'surat_cso.pdf',
                'file_sertifikat' => 'sertifikat_cso.pdf',
                'file_poster' => 'poster_cso.jpg',
                'is_akademik' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pengajuan' => '2025-09-10',
                'judul' => 'Juara 2 Hackathon Nasional',
                'tempat' => 'BINUS FX Sudirman',
                'tanggal_mulai' => '2025-08-29',
                'tanggal_selesai' => '2025-08-30',
                'url' => null,
                'tingkat' => 'nasional',
                'juara' => 2,
                'is_individu' => false,
                'status' => 'pending',
                'foto_kegiatan' => null,
                'nomor_surat_tugas' => 'HACK/2025/221',
                'tanggal_surat_tugas' => '2025-08-20',
                'file_surat_tugas' => 'surat_hack.pdf',
                'file_sertifikat' => 'sertifikat_hack.pdf',
                'file_poster' => null,
                'is_akademik' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('prestasi')->insert($data);
    }
}
