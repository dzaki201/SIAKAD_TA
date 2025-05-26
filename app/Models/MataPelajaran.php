<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama',
    ];

    // Relasi: Satu mata pelajaran bisa diajar oleh banyak guru
    public function guru()
    {
        return $this->hasMany(Guru::class, 'mata_pelajaran_id');
    }
}
