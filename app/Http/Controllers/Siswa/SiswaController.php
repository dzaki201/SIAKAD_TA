<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\PlotSiswaKelas;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class siswaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nisn' => 'required|unique:siswa,nisn',
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'sekolah_asal' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);
        Siswa::create($validatedData);
        
        return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nis' => ['required', Rule::unique('siswa', 'nis')->ignore($id)],
            'nisn' => ['required', Rule::unique('siswa', 'nisn')->ignore($id)],
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'sekolah_asal' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($validatedData);

        return redirect()->back()->with('success', 'Data siswa berhasil diperbaharui.');
    }

    public function updateKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::whereIn('id', $request->siswa_id)
            ->update(['kelas_id' => $request->kelas_id]);

        return redirect()->back()->with('success', 'Kelas siswa berhasil diubah!');
    }
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
