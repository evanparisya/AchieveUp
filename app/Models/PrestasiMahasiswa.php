<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'tanggal_pengajuan',
        'judul',
        'tempat',
        'tanggal_mulai',
        'tanggal_selesai',
        'url',
        'tingkat',
        'juara',
        'is_individu',
        'status',
        'foto_kegiatan',
        'nomor_surat_tugas',
        'tanggal_surat_tugas',
        'file_surat_tugas',
        'file_sertifikat',
        'file_poster',
        'is_akademik',
    ];

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'prestasi_mahasiswa', 'prestasi_id', 'mahasiswa_id');
    }

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class, 'pembimbing_prestasi', 'prestasi_id', 'dosen_id');
    }
}
