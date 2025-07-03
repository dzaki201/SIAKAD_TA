<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'sekolah_asal',
        'alamat',

    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
    public function siswaekskul()
    {
        return $this->hasMany(SiswaEkstrakulikuler::class);
    }
    public function kelasSiswa()
    {
        return $this->belongsToMany(Kelas::class, 'plot_siswa_kelas', 'siswa_id', 'kelas_id')
            ->withPivot('tahun_ajaran_id');
    }
    public function orangTua()
    {
        return $this->belongsToMany(OrangTua::class, 'orang_tua_siswa')
            ->withPivot('status')
            ->withTimestamps();
    }
}
