@extends('GuruMapel.main-guru-mapel')

@section('title', 'Dashboard Guru Mapel')

@section('content')
    @include('components.alert')
    <div class="grid grid-cols-4 gap-4 mb-6 text-center">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Mata Pelajaran</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $mapel->nama }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Kelas</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $kelas }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Siswa</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $siswa }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun Ajaran</h5>
            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $tahun->semester }} - {{ $tahun->tahun }}
            </p>
        </div>
    </div>
    <div
        class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
        <div class="shrink-0">
            <img class="w-24 h-24 rounded-full object-cover"
                        src="{{ asset(auth()->user()->foto ? 'storage/foto-users/' . auth()->user()->foto : 'storage/foto-default/default-profile.jpg') }}"
                        alt="Foto Profil">
        </div>
        <div class="flex-1">
            <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ Auth::user()->username }}</h5>
            <p class="text-gray-700 dark:text-gray-400 mb-3">{{ Auth::user()->email }}</p>
            <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                type="button">
                Edit Akun
            </button>
            <button data-modal-target="lihat-data-guru-modal" data-modal-toggle="lihat-data-guru-modal"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                type="button">
                Lihat Data Guru
            </button>
        </div>
    </div>
    <div class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <p class="text-base text-gray-800 dark:text-gray-300 mb-4">
                Daftar siswa di bawah KKM semester {{ $tahun->semester }} tahun {{ $tahun->tahun }}
            </p>
            <p class="text-base text-gray-800 dark:text-gray-300 mb-4">
                jumlah siswa = {{ $totalSiswaKkm }}
            </p>
        </div>
        <div class="overflow-x-auto">
            <table
                class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300 text-center">
                    <tr>
                        <th class="w-10 px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Nilai Akhir</th>
                        <th class="px-4 py-2 border">KKM</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($siswaKkm as $kelasId => $nilaiPerKelas)
                        @php
                            $kelas = $kelases->firstWhere('id', $kelasId);
                            $kkm = $kkmList->get($kelasId)->nilai ?? '-';
                        @endphp
                        @foreach ($nilaiPerKelas as $item)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 border text-center">{{ $no++ }}</td>
                                <td class="px-4 py-2 border">{{ $item->siswa->nama }}</td>
                                <td class="px-4 py-2 border text-center">{{ $kelas->nama }}</td>
                                <td class="px-4 py-2 border text-center">{{ $item->nilai_akhir }}</td>
                                <td class="px-4 py-2 border text-center">{{ $kkm }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('partials.modal-edit-akun')
    @include('partials.modal-lihat-data-guru')
@endsection
