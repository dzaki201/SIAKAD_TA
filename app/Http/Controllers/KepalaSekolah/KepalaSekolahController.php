<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
{
    public function store(Request $request)
    {
        if (KepalaSekolah::count() > 0) {
            return redirect()->back()->with('errors', 'Data kepala sekolah sudah ada. Tidak bisa menambahkan lagi.');
        }
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);
        KepalaSekolah::create($validatedData);
        return redirect()->back()->with('success', 'Data kepala sekolah berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);
        $kepsek = KepalaSekolah::findOrFail($id);
        $kepsek->update($validatedData);
        return redirect()->back()->with('success', 'Data kepala sekolah berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kepsek = KepalaSekolah::findOrFail($id);
        $kepsek->delete();
        return redirect()->back()->with('success', 'Data kepala sekolah berhasil dihapus.');
    }
}
