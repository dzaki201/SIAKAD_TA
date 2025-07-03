@extends('GuruMapel.main-guru-mapel')

@section('title', 'Dashboard Guru Mapel')

@section('content')
    @include('components.alert')
    <div class="mb-4 pt-5 flex space-x-4">
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
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Mata Pelajaran : {{ $mapel->nama }}</h5>
            </div>
            <ul class="space-y-2">
                @foreach ($kelases as $kelas)
                    <li class="flex justify-between text-gray-700 dark:text-gray-300">
                        <span>{{ $loop->iteration }}. Kelas {{ $kelas->nama }}</span>
                        <span class="font-semibold">{{ $jumlahSiswa[$kelas->id] ?? 0 }} Siswa</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('partials.modal-edit-akun')

    {{-- <div class=" w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                        <path
                            d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                        <path
                            d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                    </svg>
                </div>
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">3.4k</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated per week</p>
                </div>
            </div>
            <div>
                <span
                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    42.5%
                </span>
            </div>
        </div>
        <div id="column-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
                <div></div>
                <!-- Button -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    Last 7 days
                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                7 days</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                30 days</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                90 days</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                colors: [
                    "rgba(0, 143, 251, 0.85)", // biru terang
                    "rgba(0, 227, 150, 0.85)", // hijau muda
                    "rgba(254, 176, 25, 0.85)", // orange
                    "rgba(255, 69, 96, 0.85)", // merah pink
                    "rgba(119, 93, 208, 0.85)", // ungu
                    "rgba(0, 210, 211, 0.85)", // cyan
                    "rgba(251, 191, 36, 0.85)", // kuning gold
                    "rgba(36, 216, 184, 0.85)" // hijau tosca
                ],
                series: [
                    @foreach ($rataNilai as $kelas)
                        {
                            name: "{{ $kelas['kelas'] }}",
                            data: [
                                @foreach ($kelas['data'] as $item)
                                    {
                                        x: "{{ $item['label'] }}",
                                        y: {{ round($item['rata_rata'], 2) }}
                                    }
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            ]
                        }
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                ],
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        var label = w.config.series[seriesIndex].data[dataPointIndex].x;
                        var nilai = series[seriesIndex][dataPointIndex];
                        var namaKelas = w.config.series[seriesIndex].name;
                        var warna = w.config.colors[seriesIndex]; // ambil warna sesuai series-nya
                        return `
                        <div class="p-2">
                            <strong>${label}</strong><br>
                            <span style="color:${warna}">● ${namaKelas}:</span> ${nilai.toFixed(2)}
                        </div>
                        `;
                    }
                },
                xaxis: {
                    type: 'category',
                    categories: @json($labels),
                    labels: {
                        style: {
                            colors: '#9CA3AF'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        style: {
                            colors: '#9CA3AF'
                        }
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -20
                    },
                    borderColor: '#E5E7EB'
                },
                legend: {
                    show: true,
                    position: "bottom",
                    labels: {
                        colors: '#9CA3AF'
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '20%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                fill: {
                    opacity: 1,
                }
            };

            var chart = new ApexCharts(document.querySelector("#column-chart"), options);
            chart.render();
        });
    </script> --}}
@endsection
