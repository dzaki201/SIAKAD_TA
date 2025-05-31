<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasMataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'kelas_mata_pelajaran';

    protected $fillable = [
        'kelas_id',
        'mata_pelajaran_id',
    ];

    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
}
