<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaikKelas extends Model
{
    use HasFactory;
    protected $table = 'naik_kelas';

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'status',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
