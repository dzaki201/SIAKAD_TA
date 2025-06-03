<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:50',
        ]);
        Guru::create($validatedData);
        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
        ]);
        $guru = Guru::findOrFail($id);
        $guru->update($validatedData);
        return redirect()->back()->with('success', 'Data guru berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
    }
    
}
