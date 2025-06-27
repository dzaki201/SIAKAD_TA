<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlotGuruMapel extends Pivot
{
    use HasFactory;
    protected $table = 'plot_guru_mapel';

    protected $fillable = [
        'guru_id',
        'kelas_id',
    ];

    // relasi ke guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
