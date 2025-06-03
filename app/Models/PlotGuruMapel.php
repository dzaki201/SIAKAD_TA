<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotGuruMapel extends Model
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
