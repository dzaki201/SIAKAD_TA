<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
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

        $guruId = Guru::where('user_id', Auth::user()->id)->first()->id;
        $tahunId = TahunAjaran::where('status', '1')->first()->id;
        $validatedData['guru_id'] = $guruId;
        $validatedData['tahun_ajaran_id'] = $tahunId;
        CapaianPembelajaran::create($validatedData);
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
}
