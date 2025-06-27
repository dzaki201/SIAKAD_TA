<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'alamat',
        'no_hp',
        'kelas_id',
        'mata_pelajaran_id',
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function kelasGuruMapel()
    {
        return $this->belongsToMany(Kelas::class, 'plot_guru_mapel', 'guru_id', 'kelas_id');
    }

    // Relasi ke tabel mata pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
}
