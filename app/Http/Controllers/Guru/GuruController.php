<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\UserController;

class GuruController extends Controller
{
    public function store(Request $request)
    {
        $akunData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $akunData['password'] = Hash::make($akunData['password']);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $namaFoto = $this->generateFotoUserName() . '.' . $extension;
            $foto->storeAs('public/foto-users', $namaFoto);
            $akunData['foto'] = $namaFoto;
        }

        $user = User::create($akunData);

        $GuruData = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $GuruData['user_id'] = $user->id;
        Guru::create($GuruData);
        return redirect()->back()->with('success', 'Akun dan data guru berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $user   = User::findOrFail($guru->user_id);

        $validatedUser = $request->validate([
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validatedGuru = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $validatedUser['password'] = Hash::make($request->password);
        } else {
            unset($validatedUser['password']);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/foto-users/' . $user->foto);
                $namaFoto = $user->foto;
            } else {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namaFoto = $this->generateFotoUserName() . '.' . $extension;
            }
            $request->file('foto')->storeAs('public/foto-users', $namaFoto);
            $validatedUser['foto'] = $namaFoto;
        }

        $user->update($validatedUser);
        $guru->update($validatedGuru);
        return redirect()->back()->with('success', 'Data guru & akun berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $userId = $guru->user_id;
        $user = User::findOrFail($userId);
        if ($user->foto) {
            Storage::delete('public/foto-users/' . $user->foto);
        }
        $user->delete();
        $guru->delete();
        return redirect()->back()->with('success', 'Data guru dan akun user berhasil dihapus.');
    }
    private function generateFotoUserName()
    {
        $files = Storage::files('public/foto-users');
        $filteredFiles = array_filter($files, function ($file) {
            return str_contains(basename($file), 'foto-user-');
        });
        $count = count($filteredFiles) + 1;
        return 'foto-user-' . $count;
    }
}
