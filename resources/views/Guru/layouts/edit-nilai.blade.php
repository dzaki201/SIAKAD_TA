@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="flex items-center justify-between mt-4 mb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Edit Nilai</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Capaian Kompetensi: <span class="font-medium">{{ $cp->nama }}/{{ $cp->tanggal }}</span><br>
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
        <form action="" method="POST">
            @csrf
            <input type="hidden" name="cp_id" value="{{ $cpId }}">
            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
            <div class="overflow-x-auto rounded-lg">
                <table
                    class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th class="w-16 px-4 py-3 text-left border border-gray-300">No</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">NIS</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nama</th>
                            <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-16 px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="w-60 px-4 py-3 border border-gray-300">{{ $siswa->nis }}</td>
                                <td class="w-60 px-4 py-3 border border-gray-300">{{ $siswa->nama }}</td>
                                @php
                                    $nilai = $nilais
                                        ->where('siswa_id', $siswa->id)
                                        ->where('capaian_pembelajaran_id', $cpId)
                                        ->first();
                                @endphp
                                <td class="w-24 px-4 py-3 border border-gray-300"> <input type="number" name="nilai[]"
                                        min="0" max="100"
                                        class="w-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        value="{{ $nilai ? $nilai->nilai : '' }}" placeholder="0-100" required />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 text-right">
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                        Simpan Nilai
                    </button>
                </div>
        </form>
    </div>
@endsection
