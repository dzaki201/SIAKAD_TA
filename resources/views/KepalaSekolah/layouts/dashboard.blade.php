@extends('KepalaSekolah.main-kepala-sekolah')

@section('title', 'Dashboard Kepala Sekolah')

@section('content')
    @include('components.alert')
    <div class="grid grid-cols-4 gap-4 mb-6 text-center">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Siswa</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $siswa }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Guru</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $guru }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Kelas</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $kelas }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Mata Pelajaran</h5>
            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $mapel }}
            </p>
        </div>
    </div>
    <div class="flex space-x-4">
        <div
            class="mb-4 w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
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
    </div>
    <div class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
         <div class="flex justify-between">
            <h2>Grafik Siswa diatas KKM</h2>
            <form action="{{ route('kepsek.dashboard') }}" method="GET" class="flex items-center gap-2">
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
    <script>
        const ctx = document.getElementById('grafik-perkembangan-nilai').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($hasilPerTahun->pluck('label')) !!},
                datasets: [{
                    label: 'Jumlah Siswa Diatas KKM Mapel {{ $namaMapel }}',
                    data: {!! json_encode($hasilPerTahun->pluck('jumlah_siswa')) !!},
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
    @include('partials.modal-edit-akun')
@endsection
