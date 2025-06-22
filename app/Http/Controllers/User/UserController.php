<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'nullable'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->back()->with('success', 'Akun berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'nullable',
            'role' => 'nullable',
        ]);
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user = User::findOrFail($id);
        $user->update($validatedData);
        return redirect()->back()->with('success', 'Akun Berhasil di Update');
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }
}
