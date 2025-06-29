<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotSiswaKelas extends Model
{
    use HasFactory;
     protected $table = 'plot_siswa_kelas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_ajaran_id'
    ];

    // relasi ke guru
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    // relasi ke tahun ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
