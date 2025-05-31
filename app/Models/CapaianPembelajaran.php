<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    use HasFactory;
    protected $table = 'capaian_pembelajaran';

    protected $fillable = [
        'nama',
        'mata_pelajaran_id',
        'guru_id',
        'tanggal',
        'tahun_ajaran_id'
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
   
}
