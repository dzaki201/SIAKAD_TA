<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
     protected $table = 'nilai';

    protected $fillable = [
        'nilai',
        'siswa_id',
        'guru_id',
        'capaian_pembelajaran_id',
        'tahun_ajaran_id'
    ];
      // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    // Relasi ke Capaian Pembelajaran
    public function capaianPembelajaran()
    {
        return $this->belongsTo(CapaianPembelajaran::class);
    }
    // Relasi ke Tahun Ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
