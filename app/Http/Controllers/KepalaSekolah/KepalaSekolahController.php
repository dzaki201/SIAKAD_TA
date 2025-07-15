<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\KepalaSekolah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\UserController;

class KepalaSekolahController extends Controller
{
    public function store(Request $request)
    {
        if (KepalaSekolah::count() > 0) {
            return redirect()->back()->with('errors', 'Data kepala sekolah sudah ada. Tidak bisa menambahkan lagi.');
        }

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

        $kepsekData = $request->validate([
            'nama'   => 'required|string|max:100',
            'nip'    => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp'  => 'nullable|string|max:20',
        ]);

        $kepsekData['user_id'] = $user->id;
        KepalaSekolah::create($kepsekData);
        return redirect()->back()->with('success', 'Akun dan data kepala sekolah berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $kepsek = KepalaSekolah::findOrFail($id);
        $user   = User::findOrFail($kepsek->user_id);

        $validatedUser = $request->validate([
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedKepsek = $request->validate([
            'nama'   => 'required|string|max:100',
            'nip'    => 'nullable|string|max:50',
            'alamat' => 'required|string',
            'no_hp'  => 'nullable|string|max:20',
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
        $kepsek->update($validatedKepsek);
        return redirect()->back()->with('success', 'Data kepala sekolah & akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kepsek = KepalaSekolah::findOrFail($id);
        $userId = $kepsek->user_id;
        $user = User::findOrFail($userId);
        if ($user->foto) {
            Storage::delete('public/foto-users/' . $user->foto);
        }
        $user->delete();
        $kepsek->delete();
        return redirect()->back()->with('success', 'Data kepala sekolah dan akun user berhasil dihapus.');
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
