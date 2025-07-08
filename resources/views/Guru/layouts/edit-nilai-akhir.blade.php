@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')

    <div class="flex items-center justify-between mt-4 mb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Keterangan Nilai Akhir</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Kelas: <span class="font-medium">{{ $kelas->nama }}</span><br>
                Mata Pelajaran: <span class="font-medium">{{ $mapel->nama }}</span>
            </p>
        </div>
        <div class="pr-2 text-right">
            <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                Semester {{ $tahun->semester }} - Tahun Ajaran {{ $tahun->tahun }}
            </span>
        </div>
    </div>

    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <form action="{{ route('guru.nilai-akhir.update', ['id' => $mapel->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
            <div class="overflow-x-auto rounded-lg">
                <table
                    class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th class="w-16 px-4 py-3 text-left border border-gray-300">No</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">NIS</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nama</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nilai</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $siswa->nis }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $siswa->nama }}</td>
                                @php
                                    $nilaiAkhirSiswa = $nilaiakhirs->where('siswa_id', $siswa->id)->first();
                                @endphp
                                <td class="px-4 py-3 border border-gray-300">{{ $nilaiAkhirSiswa ? $nilaiAkhirSiswa->nilai_akhir : '-' }}</td>
                                <td class="w-80 px-4 py-3 border border-gray-300 text-center">
                                    <input type="text" name="keterangan[{{ $siswa->id }}]"
                                        value="{{ $nilaiAkhirSiswa ? $nilaiAkhirSiswa->keterangan : '-' }}"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-500">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('guru.nilai', $mapel->id) }}"
                        class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                        Simpan Nilai
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
