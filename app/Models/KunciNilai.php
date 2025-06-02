<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunciNilai extends Model
{
    use HasFactory;
    protected $table = 'kunci_nilai';

    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'tahun_ajaran_id',
        'is_locked',
        'locked_at',
    ];

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
