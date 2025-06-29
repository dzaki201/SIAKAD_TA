<?php

namespace App\Http\Controllers\TahunAjaran;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\PlotSiswaKelas;
use App\Http\Controllers\Controller;

class TahunAjaranController extends Controller
{
    public function store()
    {
        $lastTahunAjaran = TahunAjaran::orderBy('id', 'desc')->first();
        [$tahunAjaranBaru, $semesterBaru] = $this->generateNextTahunAjaran($lastTahunAjaran);
        TahunAjaran::where('status', true)->update(['status' => false]);

        $tahunAjaran = new TahunAjaran();
        $tahunAjaran->tahun = $tahunAjaranBaru;
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
    private function generateNextTahunAjaran($lastTahunAjaran)
    {
        if (!$lastTahunAjaran) {
            $currentYear = date('Y');
            $nextYear = $currentYear + 1;
            return ["{$currentYear}/{$nextYear}", 'Ganjil'];
        }

        $tahunTerakhir = $lastTahunAjaran->tahun;
        $tahunSplit = explode('/', $tahunTerakhir);
        $yearStart = (int)$tahunSplit[0];
        $yearEnd = (int)$tahunSplit[1];

        if ($lastTahunAjaran->semester === 'Genap') {
            $yearStart += 1;
            $yearEnd += 1;
            return ["{$yearStart}/{$yearEnd}", 'Ganjil'];
        } else {
            return [$tahunTerakhir, 'Genap'];
        }
    }
}
