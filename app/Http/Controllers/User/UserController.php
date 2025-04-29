<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function update (Request $request, string $id){
        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);
        $validatedData['role'] = $request->role;
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }
        $user = User::findOrFail($id);

        $user->update($validatedData);
        
        return redirect()->back()->with('success','Akun Berhasil di Update');
    }
}
