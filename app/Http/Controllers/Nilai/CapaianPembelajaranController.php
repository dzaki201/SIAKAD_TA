<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KunciNilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CapaianPembelajaranController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tanggal' => 'required|date'
        ]);

        $guru = Guru::where('user_id', Auth::id())->first();
        $kelasId = $guru->kelas_id;
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        //cek kunci nilai
        $isLocked = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $validatedData['mata_pelajaran_id'])
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('error', 'Data nilai untuk mata pelajaran ini sudah dikunci dan tidak bisa ditambahkan.');
        }
        $validatedData['status'] = 'CP';
        $validatedData['guru_id'] = $guru->id;
        $validatedData['tahun_ajaran_id'] = $tahunAjaran->id;
        $capaian = CapaianPembelajaran::create($validatedData);

        $siswaIds = Siswa::where('kelas_id', $kelasId)->pluck('id');
        $dataNilai = $siswaIds->map(function ($siswaId) use ($capaian, $tahunAjaran, $guru) {
            return [
                'siswa_id' => $siswaId,
                'guru_id' => $guru->id,
                'capaian_pembelajaran_id' => $capaian->id,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nilai' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
        })->toArray();

        Nilai::insert($dataNilai);
        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $cp = CapaianPembelajaran::findOrFail($id);
        $cp->update($validatedData);
        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cp = CapaianPembelajaran::findOrFail($id);
        $cp->delete();
        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil dihapus.');
    }

    public function tambahPtsPas(Request $request)
    {
        $validatedData = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:PTS,PAS',
        ]);

        $guru = Guru::where('user_id', Auth::id())->first();
        $kelasId = $guru->kelas_id;
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        //cek kunci nilai
        $isLocked = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $validatedData['mata_pelajaran_id'])
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('error', 'Data nilai untuk mata pelajaran ini sudah dikunci dan tidak bisa ditambahkan.');
        }

        $mapel = MataPelajaran::findOrFail($validatedData['mata_pelajaran_id']);

        $validatedData['nama'] = $validatedData['status'] . ' ' . $mapel->nama;
        $validatedData['guru_id'] = $guru->id;
        $validatedData['tahun_ajaran_id'] = $tahunAjaran->id;
        $capaian = CapaianPembelajaran::create($validatedData);

        $siswaIds = Siswa::where('kelas_id', $kelasId)->pluck('id');
        $dataNilai = $siswaIds->map(function ($siswaId) use ($capaian, $tahunAjaran, $guru) {
            return [
                'siswa_id' => $siswaId,
                'guru_id' => $guru->id,
                'capaian_pembelajaran_id' => $capaian->id,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nilai' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
        })->toArray();

        Nilai::insert($dataNilai);
        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil ditambahkan.');
    }
    public function updatePtsPas(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:PTS,PAS',
            'tanggal' => 'required|date',
        ]);

        $cp = CapaianPembelajaran::findOrFail($id);
        $cp->update($validatedData);
        $message = $cp->status == 'PTS'
            ? 'Data PTS berhasil diperbarui.'
            : 'Data PAS berhasil diperbarui.';
        return redirect()->back()->with('success', $message);
    }
}
