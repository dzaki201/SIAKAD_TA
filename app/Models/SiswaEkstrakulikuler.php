<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaEkstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'siswa_ekstrakulikuler';

    protected $fillable = [
        'siswa_id',
        'ekstrakulikuler_id',
        'keterangan',
        'tahun_ajaran_id'
    ];
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
    public function ekskul()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
