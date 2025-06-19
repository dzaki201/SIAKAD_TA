@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="mb-6 pt-5 flex space-x-4">
        <div
            class=" w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
            <div class="shrink-0">
                <img class="w-24 h-24 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/32.jpg"
                    alt="Profile Photo">
            </div>
            <div class="flex-1">
                <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ Auth::user()->username }}</h5>
                <p class="text-gray-700 dark:text-gray-400 mb-3">{{ Auth::user()->email }}</p>
                <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                    type="button">
                    Edit Akun
                </button>
            </div>
        </div>
        <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Kelas : {{ $kelas->nama }}</h5>
            </div>
            <ul class="space-y-2">
                @foreach ($mapels as $mapel)
                    <li class="flex justify-between text-gray-700 dark:text-gray-300">
                        <span>{{ $loop->iteration }}. {{ $mapel->nama }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('components.alert')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">

        <div class="flex justify-between items-center mt-4 mb-4">
            <div>
                @if ($nilaiPerSiswa->isEmpty())
                @else
                    @php
                        $progres = collect($progresNilai)->keyBy('siswa_id');
                        $complited = collect($progres)->every(function ($item) {
                            return $item['persen'] == 100;
                        });
                        $tahunAktif = $tahuns->firstWhere('status', 1);
                    @endphp
                    @if ($tahun->id == $tahunAktif->id)
                        @if ($complited)
                            <form method="GET" action="{{ route('guru.rapor') }}">
                                <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                    Rapor Semua Siswa
                                </button>
                            </form>
                        @endif
                    @else
                        <form method="GET" action="{{ route('guru.rapor') }}">
                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                Rapor Semua Siswa
                            </button>
                        </form>
                    @endif
                @endif
            </div>
            <form action="{{ route('guru.dashboard') }}" method="GET" class="flex items-center gap-2">
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
                        <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                        <th class="w-px-4 py-3  border border-gray-300">NIS</th>
                        <th class="w-px-4 py-3 border border-gray-300">Nama</th>
                        @if ($tahun->id == $tahunAktif->id)
                            <th class="w-px-4 py-3 border border-gray-300">Progres</th>
                            @if ($complited)
                                <th class="w-px-4 py-3 border border-gray-300">Aksi</th>
                            @endif
                        @else
                            <th class="w-px-4 py-3 border border-gray-300">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-12 w-px-4 py-3 border border-gray-300 text-center">{{ $loop->iteration }}</td>
                            <td class="w-px-4 py-3 border border-gray-300 text-center">{{ $siswa->nis }}</td>
                            <td class="w-px-4 py-3 border border-gray-300 text-center">{{ $siswa->nama }}</td>
                            @if ($tahun->id == $tahunAktif->id)
                                @php
                                    $progres = $progresNilai->firstWhere('siswa_id', $siswa->id);
                                @endphp
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ number_format($progres['persen'] ?? 0, 2) }}%
                                </td>
                                @if (($progres['persen'] ?? 0) == 100)
                                    <td class="w-px-4 py-3 border border-gray-300 text-center">
                                        <form method="GET"
                                            action="{{ route('guru.rapor-siswa', ['id' => $siswa->id]) }}">
                                            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                            <button type="submit"
                                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                                Rapor Siswa
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            @else
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    <form method="GET" action="{{ route('guru.rapor-siswa', ['id' => $siswa->id]) }}">
                                        <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                            Rapor Siswa
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
