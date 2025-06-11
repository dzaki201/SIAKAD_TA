<?php

namespace App\Http\Controllers\Ekstrakulikuler;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiswaEkstrakulikuler;

class SiswaEkstrakulikulerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ekstrakulikuler_id' => 'required|string',
            'siswa_id' => 'required|string'
        ]);
        $tahun = TahunAjaran::where('status', 1)->first();
        $validatedData['tahun_ajaran_id'] = $tahun->id;

        $cekEkskul = SiswaEkstrakulikuler::where('siswa_id', $validatedData['siswa_id'])
            ->where('ekstrakulikuler_id', $validatedData['ekstrakulikuler_id'])
            ->where('tahun_ajaran_id', $validatedData['tahun_ajaran_id'])
            ->first();
        if ($cekEkskul) {
            return redirect()->back()->with('errors', 'Siswa sudah terdaftar di ekstrakulikuler tersebut.');
        }

        SiswaEkstrakulikuler::create($validatedData);
        return redirect()->back()->with('success', 'Keterangan ekstrakulikuler berhasil diperbarui.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string',
        ]);

        $ekskul = SiswaEkstrakulikuler::findOrFail($id);
        $ekskul->update($validated);
        return redirect()->back()->with('success', 'Keterangan ekstrakulikuler berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $ekskul = SiswaEkstrakulikuler::findOrFail($id);
        $ekskul->delete();
        return redirect()->back()->with('success', 'Data ekstrakulikuler siswa berhasil dihapus.');
    }
}
