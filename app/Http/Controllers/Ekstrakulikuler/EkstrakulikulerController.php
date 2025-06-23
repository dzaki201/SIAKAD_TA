<?php

namespace App\Http\Controllers\Ekstrakulikuler;

use Illuminate\Http\Request;
use App\Models\Ekstrakulikuler;
use App\Http\Controllers\Controller;

class EkstrakulikulerController extends Controller
{
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
        ]);

        Ekstrakulikuler::create($validatedData);
        return redirect()->back()->with('success', 'Ekstrakulikuler berhasil ditambahkan');
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
        ]);

        $ekskul = Ekstrakulikuler::findOrFail($id);
        $ekskul->update($validatedData);
        return redirect()->back()->with('success', 'Ekstrakulikuler berhasil diperbaharui');
    }

    public function destroy(string $id)
    {
        $ekskul = Ekstrakulikuler::findOrFail($id);
        $ekskul->delete();
        return redirect()->back()->with('success', 'Ekstrakulikuler berhasil dihapus');
    }
}
