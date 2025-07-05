@extends('OrangTua.main-orang-tua')

@section('title', 'Nilai Akhir')

@section('content')
    <div class="mb-4">
        <form action="{{ route('orang-tua.nilai-akhir') }}" method="GET">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $nilais->first()->siswa_id }}">
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
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Nilai Akhir Anak</h5>
        @if ($nilais->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                            <th class="w-px-4 py-3  border border-gray-300">Capaian Pembelajaran</th>
                            <th class="w-px-4 py-3  border border-gray-300">Nilai</th>
                            <th class="w-px-4 py-3  border border-gray-300">Status</th>
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
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    @if ($kunciStatus)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded">Terkunci</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded">Belum
                                            dikunci</span>
                                    @endif
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
