<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    use HasFactory;
     protected $table = 'nilai_akhir';

    protected $fillable = [
        'nilai_akhir',
        'siswa_id',
        'mata_pelajaran_id',
        'tahun_ajaran_id',
        'keterangan'
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
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
    // Relasi ke Tahun Ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
