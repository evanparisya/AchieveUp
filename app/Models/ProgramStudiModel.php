<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudiModel extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $primaryKey = 'id_prodi';

    public $timestamps = false;

    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
    ];

    public function mahasiswas()
    {
        return $this->hasMany(MahasiswaModel::class, 'program_studi', 'id_prodi');
    }
}
