<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardOrangTuaController extends Controller
{
    public function orangTuaIndex()
    {
        return view('OrangTua.main-orang-tua');
    }
}
