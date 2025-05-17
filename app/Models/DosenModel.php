<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenModel extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $primaryKey = 'id_dsn';

    protected $fillable = [
        'nidn',
        'username',
        'nama_dsn',
        'email_dsn',
        'password_dsn',
        'foto_dsn',
        'role_dsn',
    ];

}
