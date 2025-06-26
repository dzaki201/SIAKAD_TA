<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkm extends Model
{
    use HasFactory;
     protected $table = 'kkm';

    protected $fillable = [
        'mata_pelajaran_id',
        'kelas_id',
        'nilai',
        'tahun_ajaran_id',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
     public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
