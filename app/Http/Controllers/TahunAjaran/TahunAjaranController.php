<?php

namespace App\Http\Controllers\TahunAjaran;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function store()
    {
        $lastTahunAjaran = TahunAjaran::orderBy('id', 'desc')->first();

        if (!$lastTahunAjaran) {
            $currentYear = date('Y');
            $nextYear = $currentYear + 1;
            $tahunAjaranBaru = "{$currentYear}/{$nextYear}";
            $semesterBaru = 'Ganjil';
        } else {
            $tahunTerakhir = $lastTahunAjaran->tahun;
            $tahunSplit = explode('/', $tahunTerakhir);
            $yearStart = (int)$tahunSplit[0];
            $yearEnd   = (int)$tahunSplit[1];

            if ($lastTahunAjaran->semester === 'Genap') {
                $yearStart += 1;
                $yearEnd   += 1;
                $tahunAjaranBaru = "{$yearStart}/{$yearEnd}";
                $semesterBaru = 'Ganjil';
            } else {
                $tahunAjaranBaru = $tahunTerakhir;
                $semesterBaru = 'Genap';
            }
        }
        TahunAjaran::where('status', true)->update(['status' => false]);
        $tahunAjaran = new TahunAjaran();
        $tahunAjaran->Tahun = $tahunAjaranBaru;
        $tahunAjaran->semester = $semesterBaru;
        $tahunAjaran->status = true;
        $tahunAjaran->save();
        return redirect()->back()->with('success', "Tahun Ajaran {$tahunAjaranBaru} Semester {$semesterBaru} berhasil dibuat.");
    }
    public function aktifkan($id)
    {
        TahunAjaran::where('status', true)->update(['status' => false]);
        $item = TahunAjaran::findOrFail($id);
        $item->status = true;
        $item->save();

        return redirect()->back()->with('success', 'Tahun ajaran berhasil diaktifkan.');
    }

    public function nonaktifkan($id)
    {
        $item = TahunAjaran::findOrFail($id);
        $item->status = false;
        $item->save();

        return redirect()->back()->with('success', 'Tahun ajaran dinonaktifkan.');
    }
     public function destroy($id)
    {
        $tahun = TahunAjaran::findOrFail($id);
        $tahun->delete();

        return redirect()->back()->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
