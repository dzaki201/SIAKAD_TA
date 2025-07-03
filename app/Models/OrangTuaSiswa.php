<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTuaSiswa extends Model
{
    use HasFactory;
    protected $table = 'orang_tua_siswa';

    protected $fillable = [
        'orang_tua_id',
        'siswa_id',
        'status',
    ];

    // Relasi ke Orang Tua
    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
