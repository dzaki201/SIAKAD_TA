@extends('Guru.main-guru')

@section('title', 'Dashboard Guru Kelas')

@section('content')
    @include('components.alert')
    <div class="grid grid-cols-4 gap-4 mb-6 text-center">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Kelas</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $kelas->nama }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Siswa</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $siswa }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Mata Pelajaran</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white"> {{ $mapel }} </p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun Ajaran</h5>
            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $tahun->semester }} - {{ $tahun->tahun }}
            </p>
        </div>
    </div>
    <div class="flex justify-center gap-4">
        <div
            class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
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
                <button data-modal-target="lihat-data-guru-modal" data-modal-toggle="lihat-data-guru-modal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                    type="button">
                    Lihat Data Guru
                </button>
            </div>
        </div>
        <div
            class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <p class="text-base text-gray-800 dark:text-gray-300 mb-4">
                Daftar siswa di bawah KKM semester {{ $tahun->semester }} tahun {{ $tahun->tahun }}
            </p>
            <div class="overflow-x-auto mb-4">
                <div class="max-h-48 overflow-y-auto">
                    <table
                        class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300 text-center">
                            <tr>
                                <th class="w-10 px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Siswa</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $siswaGrouped = $siswaKkm->groupBy('siswa_id');
                            @endphp
                            @foreach ($siswaGrouped as $siswaId => $items)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border">{{ $items->first()->siswa->nama }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="flex justify-center">
                                            <button
                                                class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500"
                                                data-modal-target="modal-{{ $siswaId }}"
                                                data-modal-toggle="modal-{{ $siswaId }}">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 3v4a1 1 0 0 1-1 1H5m8 7.5 2.5 2.5M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-5 9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                                Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('guru.partials.dashboard.lihat-detail-nilai')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="text-base text-gray-800 dark:text-gray-300 mb-4">
                Jumlah siswa = {{ $totalSiswaKkm }}
            </p>
        </div>
    </div>
    <div class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <h2 class="text-gray-800 dark:text-gray-300">Grafik Perkembangan Nilai Siswa</h2>
            <form action="{{ route('guru.dashboard') }}" method="GET" class="flex items-center gap-2">
                <div>
                    <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                        class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="">Pilih Mata Pelajaran</option>
                        </option>
                        @foreach ($mapels as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($mapelSelect) && $item->id == $mapelSelect->id ? 'selected' : '' }}>
                                {{ $item->nama }}
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
        <canvas id="grafik-perkembangan-nilai"></canvas>
    </div>
    @include('partials.modal-lihat-data-guru')
    @include('partials.modal-edit-akun')
    <script>
        const ctx = document.getElementById('grafik-perkembangan-nilai').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($rataRataPerCP->pluck('label')) !!},
                datasets: [{
                    label: 'Rata-rata Nilai CP',
                    data: {!! json_encode($rataRataPerCP->pluck('rata_rata')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    barThickness: 60,
                    categoryPercentage: 0.7,
                    barPercentage: 0.9
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
