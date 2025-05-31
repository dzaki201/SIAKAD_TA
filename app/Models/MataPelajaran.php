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

    public function guru()
    {
        return $this->hasMany(Guru::class, 'mata_pelajaran_id');
    }
     public function kelases()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_pelajaran', 'mata_pelajaran_id', 'kelas_id');
    }
}
