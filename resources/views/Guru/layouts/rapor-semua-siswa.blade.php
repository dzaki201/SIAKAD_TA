<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapor Peserta Didik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        @page {
            size: A4;
            margin: 4mm 4mm 4mm 4mm;
        }
    </style>
</head>
<body class="p-8">
    @foreach ($siswas as $siswa)
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">RAPOR DAN PROFIL PESERTA DIDIK</h2>
        </div>
        <div class="mb-6">
            <table class="table-auto w-full ">
                <tbody>
                    <tr>
                        <td class="p-2 font-medium w-1/3">Nama Peserta Didik</td>
                        <td class="p-2">{{ $siswa->nama }}</td>
                        <td class="p-2 font-medium">Kelas</td>
                        <td class="p-2">{{ $siswa->kelas->nama }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 font-medium">NIS</td>
                        <td class="p-2">{{ $siswa->nis }}</td>
                        <td class="p-2 font-medium">NISN</td>
                        <td class="p-2">{{ $siswa->nisn }}</td>
                    </tr>

                    <tr>
                        <td class="p-2 font-medium">Nama Sekolah</td>
                        <td class="p-2">SD Negeri 2 Karangrewas Lor</td>
                        <td class="p-2 font-medium">Semester</td>
                        <td class="p-2">{{ $tahun->semester }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 font-medium">Alamat</td>
                        <td class="p-2">{{ $siswa->alamat }}</td>
                        <td class="p-2 font-medium">Tahun Pelajaran</td>
                        <td class="p-2">{{ $tahun->tahun }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-8">
            <table class="table-auto w-full border border-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Mata Pelajaran</th>
                        <th class="p-2 border">Nilai Akhir</th>
                        <th class="p-2 border">Capaian Kompetensi</th>
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
                    <!-- Tambahkan baris lainnya di sini -->
                </tbody>
            </table>
        </div>

        <div class="mb-8">
            <h4 class="font-semibold mb-2">Ekstrakurikuler</h4>
            <table class="table-auto w-full border border-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Ekstrakurikuler</th>
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

        <div class="mb-8">
            <h4 class="font-semibold mb-2">Catatan Guru</h4>
            <p class="p-2 border border-gray-400">Teruslah belajar dengan giat dan jangan mudah menyerah.</p>
        </div>

        <div class="mb-8">
            <h4 class="font-semibold mb-2">Kehadiran</h4>
            <table class="table-auto w-full border border-gray-400">
                <tbody>
                    @php
                        $absen = $absensi->where('siswa_id', $siswa->id)->first();
                    @endphp

                    <tr>
                        <td class="p-2 border w-1/3">Sakit</td>
                        <td class="p-2 border">{{ $absen ? $absen->sakit : '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td class="p-2 border">Izin</td>
                        <td class="p-2 border">{{ $absen ? $absen->ijin : '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td class="p-2 border">Tanpa Keterangan</td>
                        <td class="p-2 border">{{ $absen ? $absen->alpa : '0' }} Hari</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="flex justify-end mb-4">
            <p class="text-right">Purwokerto, 20 Desember 2024</p>
        </div>

        <div class="grid grid-cols-3 gap-4 text-center">
            <div>
                <p class="font-medium">Mengetahui,<br>Orang Tua/Wali</p>
                <div class="h-16"></div>
                <p>Kana</p>
            </div>
            <div>
                <p class="font-medium">Guru Kelas</p>
                <div class="h-16"></div>
                <p>{{ $guru->nama }}<br>NIP. {{ $guru->nip }}</p>
            </div>
            <div>
                <p class="font-medium">Kepala Sekolah</p>
                <div class="h-16"></div>
                <p>Sri Sugihartini, S.Pd</p>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
