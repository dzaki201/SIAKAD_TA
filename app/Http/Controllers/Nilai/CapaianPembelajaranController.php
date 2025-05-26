<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CapaianPembelajaranController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        $guruId = Guru::where('user_id', Auth::user()->id)->first()->id;
        $validatedData['guru_id'] = $guruId;
        CapaianPembelajaran::create($validatedData);
        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil ditambahkan.');
    }
}
