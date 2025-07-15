<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapor Peserta Didik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .print-wrapper {
                padding: 4mm;
            }

            .avoid-break {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .avoid-break * {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    @foreach ($siswas as $siswa)
        <div class="print-wrapper">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">RAPOR DAN PROFIL PESERTA DIDIK</h2>
            </div>
            <div class="mb-6">
                <table class="w-full border-collapse table-auto text-gray-800">
                    <tbody>
                        <tr class="align-top">
                            <td class="p-2 font-medium w-48">Nama Peserta Didik</td>
                            <td class="p-2 break-words">: {{ $siswa->nama }}</td>
                            <td class="p-2 font-medium w-36">Kelas</td>
                            <td class="p-2 w-[120px]">: {{ $siswa->kelasSiswa->first()->nama ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 font-medium">NIS/NISN</td>
                            <td class="p-2 break-words">: {{ $siswa->nis }}/{{ $siswa->nisn }}</td>
                            <td class="p-2 font-medium">Fase</td>
                            <td class="p-2">: {{ $fase }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 font-medium ">Nama Sekolah</td>
                            <td class="p-2 break-words">: SD Negeri 2 Karangrewas Lor</td>
                            <td class="p-2 font-medium">Semester</td>
                            <td class="p-2">: {{ $semester }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 font-medium">Alamat</td>
                            <td class="p-2 break-words">: Jl. Laksda Yos Sudarso No.18 Purwokerto</td>
                            <td class="p-2 font-medium">Tahun Pelajaran</td>
                            <td class="p-2">: {{ $tahun->tahun }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-8">
                <table class="table-auto w-full border border-gray-400 text-gray-800">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-12 p-2 border">No</th>
                            <th class="w-72 p-2 border">Mata Pelajaran</th>
                            <th class="w-20 p-2 border">Nilai Akhir</th>
                            <th class="p-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapels as $mapel)
                            <tr>
                                <td class="p-2 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-2 border">{{ $mapel->nama }}</td>
                                @php
                                    $nilaiAkhir = $nilaiakhirs
                                        ->where('siswa_id', $siswa->id)
                                        ->where('mata_pelajaran_id', $mapel->id)
                                        ->first();
                                @endphp
                                <td class="p-2 border text-center">
                                    {{ $nilaiAkhir ? $nilaiAkhir->nilai_akhir : '-' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $nilaiAkhir ? $nilaiAkhir->keterangan : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="avoid-break mb-8">
                <h4 class="font-semibold mb-2 text-gray-900">Ekstrakurikuler</h4>
                <table class="table-auto w-full border border-gray-400 text-gray-800">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-12 p-2 border">No</th>
                            <th class="w-56 p-2 border">Ekstrakurikuler</th>
                            <th class="p-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dataEkskul = $ekskuls->where('siswa_id', $siswa->id);
                        @endphp
                        @foreach ($dataEkskul as $item)
                            <tr>
                                <td class="p-2 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-2 border">{{ $item->ekskul->nama }}</td>
                                <td class="p-2 border">{{ $item->keterangan ?? 'Baik' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @php
                $catatan = $catatans->where('siswa_id', $siswa->id)->first();
                if ($keputusans) {
                    $keputusan = $keputusans->where('siswa_id', $siswa->id)->first();
                    if ($keputusan) {
                        if ($keputusan->status == 'naik') {
                            $nextKelas = $angkaKelas + 1;
                        } elseif ($keputusan->status == 'tinggal') {
                            $nextKelas = $angkaKelas;
                        }
                        $angkaKeHuruf = [1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima', 6 => 'Enam'];
                        $teksKelas = $angkaKeHuruf[$nextKelas] ?? $nextKelas;
                    } else {
                        $nextKelas = null;
                        $teksKelas = null;
                    }
                }else{
                    $keputusan = false;
                }
            @endphp
            <div class="mb-8">
                <h4 class="font-semibold mb-2 text-gray-900">Catatan Guru</h4>
                <p class="p-2 border border-gray-400 text-gray-800">{{ $catatan->catatan }}</p>
            </div>
            <div class="avoid-break mb-8 grid grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold mb-2 text-gray-900">Kehadiran</h4>
                    <table class="table-auto border border-gray-400 w-full text-gray-800">
                        <tbody>
                            @php $absen = $absensis->where('siswa_id', $siswa->id)->first(); @endphp
                            <tr>
                                <td class="w-40 p-2 border">Sakit</td>
                                <td class="w-40 p-2 border">{{ $absen?->sakit ?? '0' }} Hari</td>
                            </tr>
                            <tr>
                                <td class="w-40 p-2 border">Izin</td>
                                <td class="w-40 p-2 border">{{ $absen?->ijin ?? '0' }} Hari</td>
                            </tr>
                            <tr>
                                <td class="w-40 p-2 border">Tanpa Keterangan</td>
                                <td class="w-40 p-2 border">{{ $absen?->alpa ?? '0' }} Hari</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($keputusan)
                    <div>
                        <h4 class="font-semibold mb-2 text-gray-900">Keputusan</h4>
                        <div class="border border-gray-400 p-4 leading-relaxed text-gray-800">
                            Berdasarkan pencapaian seluruh kompetensi peserta didik, dinyatakan:
                            <br><br>
                            <strong class="uppercase">
                                @if ($keputusan->status == 'naik')
                                    Naik Kelas {{ $nextKelas }} ({{ $teksKelas }})
                                @elseif ($keputusan->status == 'tinggal')
                                    Tinggal Kelas {{ $nextKelas }} ({{ $teksKelas }})
                                @elseif ($keputusan->status == 'lulua')
                                    Lulus
                                @endif
                            </strong>
                        </div>
                    </div>
                @endif
            </div>
            <div class="avoid-break">
                <div class="flex justify-between mb-4 text-gray-800">
                    <p class="ml-16 text-left">Mengetahui,</p>
                    <p class="mr-8 text-right">Purwokerto, .........................................</p>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center text-gray-800">
                    <div>
                        <p class="font-medium">Orang Tua/Wali</p>
                        <div class="h-24"></div>
                        <p>..................................</p>
                    </div>
                    <div>
                        <p class="font-medium">Guru Kelas</p>
                        <div class="h-24"></div>
                        <p>{{ $guru->nama }}<br>NIP. {{ $guru->nip }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Kepala Sekolah</p>
                        <div class="h-24"></div>
                        <p>{{ $kepsek->nama }}<br>NIP. {{ $kepsek->nip }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
