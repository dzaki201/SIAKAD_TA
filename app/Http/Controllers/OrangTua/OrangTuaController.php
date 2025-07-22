<?php

namespace App\Http\Controllers\OrangTua;

use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\AkunLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OrangTuaController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled(['email', 'password', 'role'])) {
            $akunData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $passwordAsli = $akunData['password'];
            $akunData['password'] = Hash::make($akunData['password']);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $extension = $foto->getClientOriginalExtension();
                $namaFoto = $this->generateFotoUserName() . '.' . $extension;
                $foto->storeAs('public/foto-users', $namaFoto);
                $akunData['foto'] = $namaFoto;
            }

            $user = User::create($akunData);
            Mail::to($user->email)->send(new AkunLogin($user->email, $passwordAsli));
        }

        $validatedData = $request->validate([
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
            'user_id'   => $user->id ?? null,
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
        $orangTua = OrangTua::findOrFail($id);
        $user = User::find($orangTua->user_id);
        if ($user == null && $request->filled(['email', 'password'])) {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $passwordAsli = $request->password;

            $newUserData = [
                'email' => $request->email,
                'password' => Hash::make($passwordAsli),
                'role' => 'orang_tua',
            ];

            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namaFoto = $this->generateFotoUserName() . '.' . $extension;
                $request->file('foto')->storeAs('public/foto-users', $namaFoto);
                $newUserData['foto'] = $namaFoto;
            }

            $user = User::create($newUserData);
            $orangTua->update(['user_id' => $user->id]);

            Mail::to($user->email)->send(new AkunLogin($user->email, $passwordAsli));
        } elseif ($user && $request->filled(['email'])) {
            $validatedUser = $request->validate([
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6',
                'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($request->filled('password')) {
                $passwordAsli = $request->password;
                $validatedUser['password'] = Hash::make($passwordAsli);
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

            if (isset($plainPassword)) {
                Mail::to($user->email)->send(new AkunLogin($user->email, $passwordAsli));
            }
        }

        $validatedOrtu = $request->validate([
            'nik'        => 'required|string|max:20',
            'nama'       => 'required|string|max:50',
            'pekerjaan'  => 'required|string|max:30',
            'alamat'     => 'required|string',
            'no_hp'      => 'nullable|string|max:20',
            'siswa_id'   => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'status'     => 'required|in:ayah,ibu,wali',
        ]);

        $orangTua->update([
            'nik'       => $validatedOrtu['nik'],
            'nama'      => $validatedOrtu['nama'],
            'pekerjaan' => $validatedOrtu['pekerjaan'],
            'alamat'    => $validatedOrtu['alamat'],
            'no_hp'     => $validatedOrtu['no_hp'],
        ]);

        $pivotData = collect($validatedOrtu['siswa_id'])
            ->mapWithKeys(fn($siswaId) => [$siswaId => ['status' => $validatedOrtu['status']]])
            ->toArray();
        $orangTua->siswa()->sync($pivotData);

        return redirect()->back()->with('success', 'Data orang tua & akun berhasil diperbarui.');
    }


    public function destroy($id)
    {

        $orangTua = OrangTua::findOrFail($id);
        $userId = $orangTua->user_id;
        if ($orangTua->user_id) {
            $user = User::find($orangTua->user_id);
            if ($user) {
                if ($user->foto) {
                    Storage::delete('public/foto-users/' . $user->foto);
                }
                $user->delete();
            }
        }
        $orangTua->siswa()->detach();
        $orangTua->delete();

        return redirect()->back()->with('success', 'Data orang tua berhasil dihapus.');
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
