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
            'user_id'   => 'nullable|exists:users,id',
            'nik'       => 'required|string|max:20',
            'nama'      => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:30',
            'alamat'    => 'required|string',
            'no_hp'     => 'nullable|string|max:20',
            'siswa_id'  => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'status' => 'required|in:ayah,ibu,wali',
        ]);

        $orangTua = OrangTua::create([
            'user_id'   => $validatedData['user_id'] ?? null,
            'nik'       => $validatedData['nik'],
            'nama'      => $validatedData['nama'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'alamat'    => $validatedData['alamat'],
            'no_hp'     => $validatedData['no_hp'],
        ]);

        $pivotData = collect($validatedData['siswa_id'])
            ->mapWithKeys(function ($siswaId, $index) use ($validatedData) {
                return [$siswaId => ['status' => $validatedData['status']]];
            })
            ->toArray();

        $orangTua->siswa()->attach($pivotData);
        return redirect()->back()->with('success', 'Data Orang Tua berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id'   => 'nullable|exists:users,id',
            'nik'       => 'required|string|max:20',
            'nama'      => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:30',
            'alamat'    => 'required|string',
            'no_hp'     => 'nullable|string|max:20',
            'siswa_id'  => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'status'    => 'required|in:ayah,ibu,wali',
        ]);

        $orangTua = OrangTua::findOrFail($id);
        $orangTua->update([
            'user_id'   => $validatedData['user_id'] ?? null,
            'nik'       => $validatedData['nik'],
            'nama'      => $validatedData['nama'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'alamat'    => $validatedData['alamat'],
            'no_hp'     => $validatedData['no_hp'],
        ]);

        $pivotData = collect($validatedData['siswa_id'])
            ->mapWithKeys(function ($siswaId) use ($validatedData) {
                return [$siswaId => ['status' => $validatedData['status']]];
            })
            ->toArray();

        $orangTua->siswa()->sync($pivotData);
        return redirect()->back()->with('success', 'Data Orang Tua berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        $orangTua->siswa()->detach();
        $orangTua->delete();
        return redirect()->back()->with('success', 'Data orang tua berhasil dihapus.');
    }
}
