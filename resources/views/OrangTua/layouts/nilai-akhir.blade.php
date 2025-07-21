@extends('OrangTua.main-orang-tua')

@section('title', 'Nilai Akhir')

@section('content')
    <div class="mb-4">
        <a href="{{ route('orang-tua.dashboard') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Nilai Akhir Anak</h5>
            <div>
                <form action="{{ route('orang-tua.nilai-akhir') }}" method="GET" class="flex items-center gap-2">
                    <div>
                        <select name="tahun_id" id="tahun"
                            class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="">Pilih Tahun</option>
                            </option>
                            @php
                                $tahunIdsArray = $tahunIds->toArray();
                                $tahunAktif = $tahuns->where('status', 1)->first();
                            @endphp
                            @foreach ($tahuns->whereIn('id', $tahunIdsArray) as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
                                    Semester {{ $item->semester }} - {{ $item->tahun }}
                                </option>
                            @endforeach
                            @if ($tahunAktif && !in_array($tahunAktif->id, $tahunIdsArray))
                                <option value="{{ $tahunAktif->id }}"
                                    {{ isset($tahun) && $tahunAktif->id == $tahun->id ? 'selected' : '' }}>
                                    Semester {{ $tahunAktif->semester }} - {{ $tahunAktif->tahun }}
                                </option>
                            @endif
                        </select>
                        <input type="hidden" name="siswa_id" value="{{ $siswaId }}">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </form>
            </div>
        </div>
        @if ($nilaiAkhirs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                            <th class="w-px-4 py-3  border border-gray-300">Mata Pelajaran</th>
                            <th class="w-px-4 py-3  border border-gray-300">Nilai Akhir</th>
                            <th class="w-px-4 py-3  border border-gray-300">Keterangan</th>
                            <th class="w-px-4 py-3  border border-gray-300 ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiAkhirs as $key => $nilai)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-12 w-px-4 py-3 border border-gray-300 text-center">{{ $key + 1 }}</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ $nilai->mataPelajaran->nama }}
                                </td>
                                <td
                                    class="w-px-4 py-3 border border-gray-300 text-center font-semibold text-gray-900 dark:text-white">
                                    {{ $nilai->nilai_akhir }}
                                </td>
                                <td
                                    class="w-px-4 py-3 border border-gray-300 text-center font-semibold text-gray-900 dark:text-white breaks">
                                    {{ $nilai->keterangan ?? '-' }}
                                </td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    <form action="{{ route('orang-tua.nilai') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="siswa_id" value="{{ $nilai->siswa_id }}">
                                        <input type="hidden" name="mapel_id" value="{{ $nilai->mata_pelajaran_id }}">
                                        <input type="hidden" name="kelas_id" value="{{ $kelasId->kelas->id }}">
                                        <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                        <button type="submit"
                                            class="px-3 py-1 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Lihat Detail Nilai
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-sm text-gray-500 dark:text-gray-300">Belum ada data nilai akhir tersedia.</p>
        @endif
    </div>

@endsection
