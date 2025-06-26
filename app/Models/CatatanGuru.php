<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanGuru extends Model
{
    use HasFactory;
    protected $table = 'catatan_guru';

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'catatan',
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
