<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function BerandaAdmin(){
        return view('Admin.berandaadmin');
    }
    public function BerandaGuru(){
        return view('Guru.berandaguru');
    }
    public function BerandaOrangTua(){
        return view('OrangTua.berandaorangtua');
    }
}
