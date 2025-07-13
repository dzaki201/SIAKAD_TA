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
            <div class="text-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">BUKU INDUK</h2>
            </div>
            <table class="mb-4 w-full border-collapse table-auto text-gray-800 dark:text-gray-200">
                <tbody>
                    <tr class="align-top">
                        <td class="p-2 font-medium w-48">Nama Peserta Didik</td>
                        <td class="p-2 max-w-[380px] break-words">: {{ $siswa->nama }}</td>
                        <td class="p-2 font-medium w-36">Kelas</td>
                        <td class="p-2 w-28">: {{ $siswa->kelasSiswa->first()->nama ?? '-' }}</td>
                    </tr>
                    <tr class="align-top">
                        <td class="p-2 font-medium">NIS/NISN</td>
                        <td class="p-2 break-words">: {{ $siswa->nis }}/{{ $siswa->nisn }}</td>
                        <td class="p-2 font-medium">Fase</td>
                        <td class="p-2">: {{ $fase }}</td>
                    </tr>
                    <tr class="align-top">
                        <td class="p-2 font-medium">Nama Sekolah</td>
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
            <table class="mb-4 w-auto mx-auto border border-gray-300 text-sm">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <tr>
                        <th class="border p-2 w-12">No</th>
                        <th class="border p-2 w-80">Muatan Pelajaran</th>
                        <th class="border p-2 w-40">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapels as $index => $mapel)
                        @php
                            $nilai = $nilaiakhirs->where('mata_pelajaran_id', $mapel->id)->first();
                            $nilaiAkhir = $nilai ? $nilai->nilai_akhir : 0;
                        @endphp
                        <tr>
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $mapel->nama }}</td>
                            <td class="border p-2 text-center">{{ $nilaiAkhir }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="mb-4 w-auto mx-auto border border-gray-300 text-sm">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <tr>
                        <th class="border p-2 w-12">No</th>
                        <th class="border p-2 w-40">Ekstrakurikuler</th>
                        <th class="border p-2 w-80">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekskuls as $index => $ekskul)
                        <tr>
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $ekskul->ekskul->nama }}</td>
                            <td class="border p-2">{{ $ekskul->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="mb-4 w-auto mx-auto border border-gray-300 text-sm">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <tr>
                        <th class="border p-2 w-10">No</th>
                        <th class="border p-2">Ketidakhadiran</th>
                        <th class="border p-2 w-24">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php $absen = $absensi->where('siswa_id', $siswa->id)->first(); @endphp
                    <tr>
                        <td class="border p-2 text-center">1</td>
                        <td class="border p-2">Sakit</td>
                        <td class="border p-2 text-center">{{ $absen?->sakit ?? '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">2</td>
                        <td class="border p-2">Izin</td>
                        <td class="border p-2 text-center">{{ $absen?->ijin ?? '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">3</td>
                        <td class="border p-2">Tanpa Keterangan</td>
                        <td class="border p-2 text-center">{{ $absen?->alpa ?? '0' }} Hari</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="page-break-before: always;"></div>
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
