@extends('KepalaSekolah.main-kepala-sekolah')

@section('title', 'Buku Induk')

@section('content')
    @include('components.alert')
    <div class="flex justify-end mb-4">
        <form action="{{ route('kepsek.rekap-siswa') }}" method="GET" class="flex items-center gap-2">
            <div>
                <select name="tahun_id" id="tahun"
                    class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    <option value="">Pilih Tahun </option>
                    </option>
                    @foreach ($tahuns as $item)
                        <option value="{{ $item->id }}" {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
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
    <div class="mb-4 overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Rekap Siswa di Bawah KKM Tahun {{ $tahun->tahun }}</h2>

        <div class="overflow-y-auto" style="max-height: 320px;">
            <table class="mb-4 w-full border-collapse table-auto text-gray-800 dark:text-gray-200">
                <thead>
                    <tr>
                        <th class="w-10 p-2 border">No</th>
                        <th class="p-2 border">Mata Pelajaran</th>
                        <th class="p-2 border">Kelas</th>
                        <th class="p-2 border">Nilai KKM</th>
                        <th class="p-2 border">Jumlah Siswa di Bawah KKM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $item)
                        <tr class="text-center border-b">
                            <td class="p-2 border">{{ $loop->iteration }}</td>
                            <td class="p-2 border">{{ $item['mapel'] }}</td>
                            <td class="p-2 border">{{ $item['kelas'] }}</td>
                            <td class="p-2 border">{{ $item['kkm'] }}</td>
                            <td class="p-2 border">{{ $item['jumlah'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @php
        $rekapChart = collect($rekap)->filter(fn($item) => $item['jumlah'] > 0)->values();
    @endphp
    <div class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-start">
            <h2 class="text-gray-800 dark:text-gray-300">Grafik Perkembangan Nilai Siswa</h2>
        </div>
        <canvas id="grafik-siswadibawah-kkm"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('grafik-siswadibawah-kkm').getContext('2d');

        // ambil data hasil filter yang jumlahnya > 0
        const rekapData = {!! json_encode($rekapChart) !!};

        const labels = rekapData.map(item => `${item.mapel} (Kelas ${item.kelas})`);
        const dataJumlah = rekapData.map(item => item.jumlah);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Siswa Di Bawah KKM',
                    data: dataJumlah,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    barThickness: 50,
                    categoryPercentage: 0.7,
                    barPercentage: 0.9
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

@endsection
