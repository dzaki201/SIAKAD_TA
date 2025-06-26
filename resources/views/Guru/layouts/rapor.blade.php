@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    @include('components.alert')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-between items-center mt-4 mb-4">
            <div>
                @if ($nilaiPerSiswa->isEmpty())
                @else
                    @php
                        $progres = collect($progresRapor)->keyBy('siswa_id');
                        $Raporcomplited = collect($progres)->every(function ($item) {
                            return $item['persen_rapor'] == 100;
                        });
                        $Nilaicomplited = collect($progres)->every(function ($item) {
                            return $item['persen_nilai'] == 100;
                        });
                        $tahunAktif = $tahuns->firstWhere('status', 1);
                    @endphp
                    @if ($tahun->id == $tahunAktif->id && $Raporcomplited)
                        <form method="GET" action="{{ route('guru.rapor-semua-siswa') }}">
                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                            <button type="submit"
                                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                                </svg>
                                Rapor Semua Siswa
                            </button>
                        </form>
                    @else
                        <form method="GET" action="{{ route('guru.rapor-semua-siswa') }}">
                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                            <button type="submit"
                                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                                </svg>
                                Rapor Semua Siswa
                            </button>
                        </form>
                    @endif
                @endif
            </div>
            <form action="{{ route('guru.rapor') }}" method="GET" class="flex items-center gap-2">
                <div>
                    <select name="tahun_id" id="tahun"
                        class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="">Pilih Tahun</option>
                        </option>
                        @foreach ($tahuns as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
                                Semester {{ $item->semester }} - {{ $item->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    Search
                </button>
            </form>
        </div>
        @if ($nilaiPerSiswa->isEmpty())
            <div class="flex justify-center items-center h-[500px]">
                <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Tidak ada data penilaian di semester
                    {{ $tahun->semester }} - {{ $tahun->tahun }} </span>
            </div>
        @else
            <table
                class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th class="w-10 px-4 py-3 text-left border border-gray-300">No</th>
                        <th class="w-20 py-3  border border-gray-300">NIS</th>
                        <th class="w-60 w-py-3 border border-gray-300">Nama</th>
                        @if ($tahun->id == $tahunAktif->id)
                            <th class="w-80 w-py-3 border border-gray-300">Progres Nilai Akhir</th>
                            <th class="w-80 py-3 border border-gray-300">Progres rapor</th>
                            @if ($Nilaicomplited)
                                <th class="w-60 w-py-3 border border-gray-300">Catatan Guru</th>
                                @if ($tahun->semester == 'Genap')
                                    <th class="w-60 w-py-3 border border-gray-300">Status Naik Kelas</th>
                                @endif
                            @endif
                            @if (@$Raporcomplited)
                                <th class="w-80 py-3 border border-gray-300">Aksi</th>
                            @endif
                        @else
                            <th class="w-80 py-3 border border-gray-300">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-10 w-px-4 py-3 border border-gray-300 text-center">{{ $loop->iteration }}</td>
                            <td class="w-20 py-3 border border-gray-300 text-center">{{ $siswa->nis }}</td>
                            <td class="w-60 py-3 border border-gray-300 text-center">{{ $siswa->nama }}</td>
                            @if ($tahun->id == $tahunAktif->id)
                                @php
                                    $progres = $progresRapor->firstWhere('siswa_id', $siswa->id);
                                @endphp
                                <td class="w-80 py-3 border border-gray-300 text-center">
                                    <div class="p-2 flex justify-between items-center">
                                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                                style="width:  {{ number_format($progres['persen_nilai'] ?? 0, 2) }}%">
                                                {{ $progres['persen_nilai'] }}%</div>
                                        </div>
                                        @if (($progres['persen_nilai'] ?? 0) != 100)
                                            <button data-popover-target="popover-progres-nilai-akhir-{{ $siswa->id }}"
                                                data-popover-placement="bottom-end" type="button"><svg
                                                    class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd"></path>
                                                </svg><span class="sr-only">Show information</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="w-80 py-3 border border-gray-300 text-center">
                                    <div class="p-2 flex justify-between items-center">
                                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                                style="width:  {{ number_format($progres['persen_rapor'] ?? 0, 2) }}%">
                                                {{ $progres['persen_rapor'] }}%
                                            </div>
                                        </div>
                                        @if (($progres['persen_rapor'] ?? 0) != 100)
                                            <button data-popover-target="popover-progres-rapor-{{ $siswa->id }}"
                                                data-popover-placement="bottom-end" type="button"><svg
                                                    class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd"></path>
                                                </svg><span class="sr-only">Show information</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                @include('guru.partials.siswa.popover-progres-nilai-akhir')
                                @include('guru.partials.siswa.popover-progres-rapor')
                                @if (($progres['persen_nilai'] ?? 0) == 100)
                                    <td class="w-60 py-3 border border-gray-300 text-center">
                                        <button>buat catatan</button>
                                    </td>
                                    @if ($tahun->semester == 'Genap')
                                        <td class="w-60 py-3 border border-gray-300 text-center">
                                        <button>status naik kelas</button>
                                    </td>
                                    @endif
                                @else
                                    <td class="w-60 py-3 border border-gray-300 text-center">
                                       -
                                    </td>
                                @endif
                                @if (($progres['persen_rapor'] ?? 0) == 100)
                                    <td class="w-80 py-3 border border-gray-300 text-center">
                                        <form method="GET"
                                            action="{{ route('guru.rapor-siswa', ['id' => $siswa->id]) }}">
                                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                            <button type="submit"
                                                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                                                </svg>
                                                Rapor Siswa
                                            </button>
                                        </form>
                                    </td>
                                @else
                                @endif
                            @else
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    <div class="flex justify-center">
                                        <form method="GET"
                                            action="{{ route('guru.rapor-siswa', ['id' => $siswa->id]) }}">
                                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                            <button type="submit"
                                                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                                                Rapor Siswa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
