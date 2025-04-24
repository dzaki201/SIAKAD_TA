<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function adminIndex()
    {
        return view('Admin.dashboard');
    }
    public function adminGuru()
    {
        return view('admin.guru');
    }
    
}
