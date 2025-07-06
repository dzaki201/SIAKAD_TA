@extends('KepalaSekolah.main-kepala-sekolah')

@section('title', 'Dashboard Kepala Sekolah')

@section('content')
    <div class="mb-4">
        <a href="{{ route('kepsek.siswa', ['id' => $kelas->id]) }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>
    <div class="overflow-x-auto w-auto rounded-lg border p-6 bg-white dark:bg-gray-800 shadow space-y-6">
        <div class="text-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">BUKU INDUK</h2>
        </div>
        <table class="w-full border-collapse table-auto text-gray-800 dark:text-gray-200">
            <tbody>
                <tr>
                    <td class="p-2 font-medium w-52">Nama Peserta Didik</td>
                    <td class="p-2 w-[400px] break-words">: {{ $siswa->nama }}</td>
                    <td class="p-2 font-medium w-36">Kelas</td>
                    <td class="p-2 w-[120px]">: {{ $siswa->kelasSiswa->first()->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-medium">NIS/NISN</td>
                    <td class="p-2 break-words">: {{ $siswa->nis }}/{{ $siswa->nisn }}</td>
                    <td class="p-2 font-medium">Fase</td>
                    <td class="p-2">: {{ $fase }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-medium">Nama Sekolah</td>
                    <td class="p-2 break-words">: SD Negeri 2 Karangrewas Lor</td>
                    <td class="p-2 font-medium">Semester</td>
                    <td class="p-2">: {{ $semester }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-medium">Alamat</td>
                    <td class="p-2 break-words">: Jl. Laksda Yos Sudarso No.18 Purwokerto</td>
                    <td class="p-2 font-medium">Tahun Pelajaran</td>
                    <td class="p-2">: {{ $tahun->tahun }}</td>
                </tr>
            </tbody>
        </table>
        <h4 class="font-semibold text-gray-700 dark:text-white mt-4">Muatan Pelajaran</h4>
        <table class="w-auto border border-gray-300 text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                <tr>
                    <th class="w-16 border p-2">No</th>
                    <th class="w-[550px] border p-2">Muatan Pelajaran</th>
                    <th class="w-[400px] border p-2">Nilai</th>
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
        <h4 class="font-semibold text-gray-700 dark:text-white mt-4">Ekstrakurikuler</h4>
        <table class="w-auto border border-gray-300 text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                <tr>
                    <th class="w-16 border p-2">No</th>
                    <th class="w-[250px] border p-2">Ekstrakurikuler</th>
                    <th class="w-[700px] border p-2">Keterangan</th>
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
        <h4 class="font-semibold text-gray-700 dark:text-white mt-4">Ketidakhadiran</h4>
        <table class="w-auto border border-gray-300 text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                <tr>
                    <th class="w-16 border p-2">No</th>
                    <th class="w-80 border p-2">Ketidakhadiran</th>
                    <th class="w-60 border p-2">Jumlah</th>
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
@endsection
