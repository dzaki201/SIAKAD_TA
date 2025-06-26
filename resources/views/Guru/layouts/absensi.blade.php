@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-between items-center mt-4 mb-4">
            <div></div>
            <form action="{{ route('guru.absensi') }}" method="GET" class="flex items-center gap-2">
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
        @php
            $tahunAktif = $tahuns->firstWhere('status', 1);
        @endphp
        @if ($siswas->first()->absensi->isEmpty())
            @if ($tahun->id == $tahunAktif->id)
                <div class="flex justify-center items-center h-[500px]">
                    <a href="{{ route('guru.absensi.store', ['id' => $tahun->id]) }}">
                        <button class="bg-blue-600 text-white rounded-full p-6 hover:bg-blue-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </a>
                    <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Buat Absensi Semester
                        {{ $tahun->semester }} - {{ $tahun->tahun }}</span>
                </div>
            @else
                <div class="flex justify-center items-center h-[500px]">
                    <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Tidak ada data absensi di
                        semester
                        {{ $tahun->semester }} - {{ $tahun->tahun }} </span>
                </div>
            @endif
        @else
            <table
                class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                        <th class="w-px-4 py-3  border border-gray-300">NIS</th>
                        <th class="w-px-4 py-3 border border-gray-300">Nama</th>
                        <th class="w-px-4 py-3 border border-gray-300">Ijin</th>
                        <th class="w-px-4 py-3 border border-gray-300">Sakit</th>
                        <th class="w-px-4 py-3 border border-gray-300">Tanpa Keterangan (alpa)</th>
                        @if ($tahun->id == $tahunAktif->id)
                            <th class="w-px-4 py-3 border border-gray-300">Aksi</th>
                        @else
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
                            @foreach ($siswa->absensi as $absensi)
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ $absensi->ijin ?? '-' }}
                                </td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ $absensi->sakit ?? '-' }}
                                </td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    {{ $absensi->alpa ?? '-' }}
                                </td>
                                @if ($tahun->id == $tahunAktif->id)
                                    <td class="px-6 py-4 border border-gray-300">
                                        <button data-modal-target="edit-absensi-modal-{{ $absensi->id }}"
                                            data-modal-toggle="edit-absensi-modal-{{ $absensi->id }}"
                                            class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </button>
                                    </td>
                                @endif
                                @include('guru.partials.absensi.modal-edit-absensi')
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
