<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
    return view('Guru.berandaguru');

   }
}
