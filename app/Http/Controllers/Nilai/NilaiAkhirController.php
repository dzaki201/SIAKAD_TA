<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiAkhirController extends Controller
{
    public function store($id)
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $kelasId = $guru->kelas_id;
        $tahunAjaran = TahunAjaran::where('status', '1')->firstOrFail();
        // Cek apakah nilai untuk mapel ini sudah dikunci
        $isLocked = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $id)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->where('kelas_id', $kelasId)
            ->where('is_locked', 1)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('errors', 'Data nilai untuk mata pelajaran ini sudah dikunci dan tidak bisa ditambahkan.');
        }

        $siswaIds = Siswa::where('kelas_id', $kelasId)->pluck('id');
        $cpIds = CapaianPembelajaran::whereIn('status', ['CP', 'PTS', 'PAS'])->pluck('id');

        // Ambil kombinasi nilai yang sudah ada
        $existing = Nilai::whereIn('siswa_id', $siswaIds)
            ->whereIn('capaian_pembelajaran_id', $cpIds)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->select('siswa_id', 'capaian_pembelajaran_id')
            ->get()
            ->map(fn($item) => $item->siswa_id . '-' . $item->capaian_pembelajaran_id);

        // Buat semua kombinasi siswa dan capaian pembelajaran
        $combinations = collect($siswaIds)->crossJoin($cpIds)->map(fn($pair) => [
            'siswa_id' => $pair[0],
            'capaian_pembelajaran_id' => $pair[1],
        ]);

        // Filter kombinasi yang belum ada
        $missing = $combinations->reject(fn($item) => $existing->contains($item['siswa_id'] . '-' . $item['capaian_pembelajaran_id']));

        // Insert nilai default 0 untuk yang belum ada
        $toInsert = $missing->map(fn($item) => [
            'nilai' => 0,
            'siswa_id' => $item['siswa_id'],
            'guru_id' => $guru->id,
            'capaian_pembelajaran_id' => $item['capaian_pembelajaran_id'],
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);

        if ($toInsert->isNotEmpty()) {
            Nilai::insert($toInsert->toArray());
        }

        // Ambil semua nilai untuk proses hitung nilai akhir
        $nilaiSiswas = Nilai::whereIn('siswa_id', $siswaIds)
            ->whereHas('capaianPembelajaran', fn($q) => $q->whereIn('status', ['CP', 'PTS', 'PAS']))
            ->with('capaianPembelajaran')
            ->get();

        // Group by siswa_id
        $nilaiGroup = $nilaiSiswas->groupBy('siswa_id');

        // Mapping data nilai akhir
        $dataNilaiAkhir = $nilaiGroup->map(function ($nilaiGroup, $siswaId) use ($tahunAjaran, $id) {

            $cp = $nilaiGroup->filter(fn($item) => $item->capaianPembelajaran->status === 'CP')->pluck('nilai');
            $pts = $nilaiGroup->filter(fn($item) => $item->capaianPembelajaran->status === 'PTS')->pluck('nilai')->first() ?? 0;
            $pas = $nilaiGroup->filter(fn($item) => $item->capaianPembelajaran->status === 'PAS')->pluck('nilai')->first() ?? 0;

            $rataCP = $cp->count() ? $cp->avg() : 0;
            $nilaiAkhir = round(($rataCP * 0.6) + ($pts * 0.2) + ($pas * 0.2), 2);

            return [
                'siswa_id' => $siswaId,
                'guru_id' => $nilaiGroup->first()->guru_id,
                'mata_pelajaran_id' => $id,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nilai_akhir' => $nilaiAkhir,
                'keterangan' => 'Generated otomatis',
            ];
        });

        //menghapus data yang sudah ada
        if ($dataNilaiAkhir->isNotEmpty()) {
            $keysToDelete = $dataNilaiAkhir->map(fn($item) => [
                $item['siswa_id'],
                $item['mata_pelajaran_id'],
                $item['tahun_ajaran_id'],
            ])->unique()->toArray();

            // Buat string tuple untuk whereRaw
            $tupleString = collect($keysToDelete)
                ->map(fn($key) => "({$key[0]}, {$key[1]}, {$key[2]})")
                ->implode(',');

            // Hapus data nilai akhir yang lama sebelum upsert
            NilaiAkhir::whereRaw("(siswa_id, mata_pelajaran_id, tahun_ajaran_id) IN ({$tupleString})")->delete();

            // Insert/update nilai akhir
            NilaiAkhir::upsert(
                $dataNilaiAkhir->toArray(),
                ['siswa_id', 'guru_id', 'mata_pelajaran_id', 'tahun_ajaran_id'],
                ['nilai_akhir', 'keterangan']
            );
        }

        return redirect()->back()->with('success', 'Nilai akhir berhasil dihitung.');
    }
}
