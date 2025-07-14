<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ]);


        $validatedData['password'] = Hash::make($validatedData['password']);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $namaFoto = $this->generateFotoUserName() . '.' . $extension;
            $foto->storeAs('public/foto-users', $namaFoto);
            $validatedData['foto'] = $namaFoto;
        }
        User::create($validatedData);
        return redirect()->back()->with('success', 'Akun berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'role' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user = User::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/foto-users/' . $user->foto);
                $namaFoto = $user->foto;
            } else {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namaFoto = $this->generateFotoUserName() . '.' . $extension;
            }
            $request->file('foto')->storeAs('public/foto-users', $namaFoto);
            $validatedData['foto'] = $namaFoto;
        }
        $user->update($validatedData);
        return redirect()->back()->with('success', 'Akun berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->foto) {
            Storage::delete('public/foto-users/' . $user->foto);
        }
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
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
