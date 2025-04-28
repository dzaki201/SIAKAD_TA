<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
    ];

    // Relasi: Satu kelas bisa punya banyak guru
    public function guru()
    {
        return $this->hasMany(Guru::class, 'kelas_id');
    }
}
