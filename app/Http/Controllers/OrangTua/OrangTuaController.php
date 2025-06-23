<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullabel|exists:users,id',
            'siswa_id' => 'required|exists:siswa,id',
            'status' => 'required|in:ayah,ibu,wali',
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:30',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',

        ]);

        OrangTua::create($validatedData);
        return redirect()->back()->with('success', 'Data Orang Tua berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'siswa_id' => 'required|exists:siswa,id',
            'status' => 'required|in:ayah,ibu,wali',
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:30',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $orangTua = OrangTua::findOrFail($id);
        $orangTua->update($validatedData);

        return redirect()->back()->with('success', 'Data Orang Tua berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        $orangTua->delete();
        return redirect()->back()->with('success', 'Data orang tua berhasil dihapus.');
    }
}
