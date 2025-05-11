<?php

namespace App\Http\Controllers\User;

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
            'nip' => 'nullable|string|max:50',
            'kelas_id' => 'nullable|exists:kelas,id',
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajaran,id',
        ]);

        if (!$request->kelas_id && !$request->mata_pelajaran_id) {
            return redirect()->route('admin.guru')->with('errors', 'Kelas atau Mata Pelajaran harus dipilih.');
        }elseif ($request->kelas_id && $request->mata_pelajaran_id) {
            return redirect()->route('admin.guru')->with('errors','Hanya satu pilihan yang boleh diisi, pilih Kelas atau Mata Pelajaran.');
        }

        if ($request->kelas_id) {
            $validatedData['status'] = 'guru kelas';
        } elseif ($request->mata_pelajaran_id) {
            $validatedData['status']  = 'guru mata pelajaran';
        }
    
        $validatedData['kelas_id'] = $request->kelas_id ?? null;
        $validatedData['mata_pelajaran_id'] = $request->mata_pelajaran_id ?? null;
    
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
            'kelas_id' => 'nullable|exists:kelas,id',
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajaran,id',
        ]);
        
        if (!$request->kelas_id && !$request->mata_pelajaran_id) {
            return redirect()->route('admin.guru')->with('errors', 'Kelas atau Mata Pelajaran harus dipilih.');
        }elseif ($request->kelas_id && $request->mata_pelajaran_id) {
            return redirect()->route('admin.guru')->with('errors','Hanya satu pilihan yang boleh diisi, pilih Kelas atau Mata Pelajaran.');
        }

        if ($request->kelas_id) {
            $validatedData['status'] = 'guru kelas';
        } elseif ($request->mata_pelajaran_id) {
            $validatedData['status']  = 'guru mata pelajaran';
        }
    
        $validatedData['kelas_id'] = $request->kelas_id ?? null;
        $validatedData['mata_pelajaran_id'] = $request->mata_pelajaran_id ?? null;
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
