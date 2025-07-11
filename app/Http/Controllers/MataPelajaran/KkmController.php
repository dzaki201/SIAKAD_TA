<?php

namespace App\Http\Controllers\MataPelajaran;

use App\Models\Kkm;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KkmController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mata_pelajaran_id' => 'required|integer',
            'kelas_id' => 'required|integer',
            'nilai' => 'required|numeric',
            'tahun_ajaran_id' => 'required|integer',
        ]);

        $cek = Kkm::where('mata_pelajaran_id', $validatedData['mata_pelajaran_id'])
            ->where('kelas_id', $validatedData['kelas_id'])
            ->where('tahun_ajaran_id', $validatedData['tahun_ajaran_id'])
            ->exists();
        if ($cek) {
            return redirect()->back()->with('errors', 'Data KKM dengan mata pelajaran, kelas, dan tahun ajaran tersebut sudah ada.');
        }

        Kkm::create($validatedData);
        return redirect()->back()->with('success', 'KKM berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nilai' => 'required|numeric',
        ]);

        $kkm = Kkm::findOrFail($id);
        $kkm->update($validatedData);
        return redirect()->back()->with('success', 'KKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kkm = Kkm::findOrFail($id);
        $kkm->delete();

        return redirect()->back()->with('success', 'KKM berhasil dihapus');
    }
    public function updateSemua()
    {
        $lastTahunAjaranId = Kkm::max('tahun_ajaran_id');
        $lastTahunAjaran = TahunAjaran::find($lastTahunAjaranId);
        if ($lastTahunAjaran->status == 1) {
            return redirect()->back()->with('errors', 'Tidak bisa update semua KKM karena Tahun Ajaran belum berganti.');
        }

        $tahunAjaranBaru = TahunAjaran::where('status', 1)->first();
        $kkmList = Kkm::where('tahun_ajaran_id', $lastTahunAjaranId)->get();
        $dataInsert = $kkmList->map(function ($kkm) use ($tahunAjaranBaru) {
            return [
                'mata_pelajaran_id' => $kkm->mata_pelajaran_id,
                'kelas_id' => $kkm->kelas_id,
                'nilai' => $kkm->nilai,
                'tahun_ajaran_id' => $tahunAjaranBaru->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        Kkm::insert($dataInsert);
        return redirect()->back()->with('success', 'Semua KKM berhasil disalin ke Tahun Ajaran terbaru.');
    }
}
