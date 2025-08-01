@extends('OrangTua.main-orang-tua')

@section('title', 'Detail Nilai')

@section('content')
    <div class="mb-4">
        <form action="{{ route('orang-tua.nilai-akhir') }}" method="GET">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $nilais->first()->siswa_id }}">
            <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </button>
        </form>
    </div>
    <div class="mb-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Nilai</h5>
            @if ($kunciStatus)
                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded">Nilai Mata Pelajaran
                    {{ $mapel->nama }} Sudah Terkunci</span>
            @else
                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded">Nilai Mata Pelajaran
                    {{ $mapel->nama }} Belum dikunci</span>
            @endif
        </div>
        @if ($nilais->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                            <th class="w-px-4 py-3  border border-gray-300">Capaian Pembelajaran</th>
                            <th class="w-px-4 py-3  border border-gray-300">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilais as $key => $nilai)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-12 w-px-4 py-3 border border-gray-300 text-center">{{ $key + 1 }}</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ $nilai->capaianPembelajaran->nama }}
                                </td>
                                <td
                                    class="w-px-4 py-3 border border-gray-300 text-center font-semibold text-gray-900 dark:text-white">
                                    {{ $nilai->nilai }}
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
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
        <h2>Grafik Perkembangan Nilai Siswa</h2>
        <canvas id="grafik-perkembangan-nilai"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('grafik-perkembangan-nilai').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($nilaiPerCP->pluck('label')) !!},
                datasets: [{
                    label: 'Nilai Capaian pembelajaran {{ $mapel->nama }}',
                    data: {!! json_encode($nilaiPerCP->pluck('nilai')) !!},
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
