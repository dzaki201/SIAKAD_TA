<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use App\Models\KunciNilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KunciNilaiController extends Controller
{
    public function store($id, $kelasId)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $mapel = MataPelajaran::where('id', $id)->first();
        $tahun = TahunAjaran::where('status', 1)->first();

        KunciNilai::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'tahun_ajaran_id' => $tahun->id,
            'kelas_id' => $kelasId,
            'is_locked' => 0,
        ]);
        return redirect()->back()->with('success', 'Penilaian Baru berhasil dibuat.');;
    }
    public function kunci($id)
    {
        $kunci = KunciNilai::where('id', $id)
            ->first();
        $kunci->update([
            'is_locked' => 1,
            'locked_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Data Nilai berhasil dikunci.');
    }
    public function bukaKunci($id)
    {
        $kunci = KunciNilai::where('id', $id)->first();

        if (!$kunci) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $kunci->update([
            'is_locked' => 0,
            'locked_at' => null,
        ]);
        return redirect()->back()->with('success', 'Kunci nilai berhasil dibuka.');
    }
}
