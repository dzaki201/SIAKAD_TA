@extends('KepalaSekolah.main-kepala-sekolah')

@section('title', 'Lihat Buku Induk Siswa')

@section('content')
    <div class="mb-4">
        <a href="{{ route('kepsek.siswa', ['id' => $kelas->id]) }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>
    <div class="mb-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-start">
            <h2 class="text-gray-800 dark:text-gray-300">Grafik Nilai Siswa</h2>
        </div>
        <canvas id="grafik-nilai"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('grafik-nilai').getContext('2d');

        const rekapData = {!! json_encode($rekapChart) !!};

        const labels = rekapData.map(item => `${item.mapel} - ${item.tahun_ajaran}`);
        const dataNilai = rekapData.map(item => item.nilai);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Akhir Siswa',
                    data: dataNilai,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
                        suggestedMax: 100,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
    </script>

@endsection
