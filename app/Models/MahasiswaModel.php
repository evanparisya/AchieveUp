<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; 

    protected $primaryKey = 'id_mhs'; 

    public $timestamps = false; 

    protected $fillable = [
        'nim',
        'nama_mhs',
        'username_mhs',
        'email_mhs',
        'password_mhs',
        'foto_mhs',
        'program_studi', 
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudiModel::class, 'program_studi', 'id_prodi');
    }
}
