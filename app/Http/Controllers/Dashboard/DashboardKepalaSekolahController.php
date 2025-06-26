<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKepalaSekolahController extends Controller
{
    public function kepsekIndex()
    {
        return view('KepalaSekolah.layouts.dashboard');
    }
}
