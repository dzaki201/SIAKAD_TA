<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // public function register()
    // {
    //     return view('auth.register');
    // }

    // public function registerSave(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed',
    //     ])->validate();

    //     User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'orang_tua'
    //     ]);

    //     return redirect()->route('login');
    // }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($user->role == 'guru_mapel') {
            return redirect()->route('guru-mapel.dashboard');
        } elseif ($user->role == 'kepsek') {
            return redirect()->route('kepsek.dashboard');
        } elseif ($user->role == 'orang_tua') {
            return redirect()->route('orang-tua.dashboard');
        } else {
            return redirect('/');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('login');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
            'role' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user = User::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/foto_users/' . $user->foto);
                $namaFoto = $user->foto;
            } else {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namaFoto = $this->generateFotoUserName() . '.' . $extension;
            }
            $request->file('foto')->storeAs('public/foto_users', $namaFoto);
            $validatedData['foto'] = $namaFoto;
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Akun berhasil diupdate.');
    }
}
