<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $table = 'orang_tua';

    protected $fillable = [
        'user_id',
        'siswa_id',
        'status',
        'nik',
        'nama',
        'pekerjaan',
        'alamat',
        'no_hp',
    ];
    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'orang_tua_siswa')
            ->withPivot('status')
            ->withTimestamps();
    }
}
