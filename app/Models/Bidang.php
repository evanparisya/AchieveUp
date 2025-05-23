<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang';

    protected $fillable = [
        'kode',
        'nama',
    ];

    /**
     * Relasi many-to-many ke model Lomba
     */
    public function lomba()
    {
        return $this->belongsToMany(Lomba::class, 'bidang_lomba', 'bidang_id', 'lomba_id')->withTimestamps();
    }
}
