<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $table = 'orang_tua';

    protected $fillable = [
        'siswa_id',
        'status',
        'nik',
        'nama',
        'pekerjaan',
        'alamat',
        'no_hp',
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
