<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function registerSave(Request $request){
        Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ])->validate();

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'orang_tua'
        ]);
        
        return redirect()->route('login');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginAction(Request $request){
        Validator::make($request->all(),[
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
            return redirect()->route('beranda.guru');
        } elseif ($user->role == 'orang_tua') {
            return redirect()->route('beranda.orangtua');
        } else {
            // Kalau role tidak terdaftar, redirect ke halaman utama atau logout
            return redirect('/');
        }
        
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
 
        return redirect()->route('login');
    }
}
