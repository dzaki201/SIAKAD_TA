@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    @include('components.alert')
    <div class="flex justify-between items-center mt-4 mb-4">
        <div></div>
        <form action="{{ route('guru.ekskul') }}" method="GET" class="flex items-center gap-2">
            <div>
                <select name="tahun_id" id="tahun"
                    class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    <option value="">Pilih Tahun</option>
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
    @php
        $no = 1;
        $tahunAktif = $tahuns->firstWhere('status', 1);
    @endphp
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        @if ($siswas->every(fn($s) => $s->siswaekskul->isEmpty()))
            <div class="flex justify-center items-center h-[500px]">
                <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Tidak ada data absensi di
                    semester
                    {{ $tahun->semester }} - {{ $tahun->tahun }} </span>
            </div>
        @else
            <table
                class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th class="w-12 px-4 py-3 text-left border border-gray-300">No</th>
                        <th class="w-px-4 py-3  border border-gray-300">NIS</th>
                        <th class="w-px-4 py-3 border border-gray-300 ">Nama</th>
                        <th class="w-px-4 py-3 border border-gray-300 ">Ekskul</th>
                        <th class="w-px-4 py-3 border border-gray-300 ">Keterangan</th>
                        @if ($tahun->id == $tahunAktif->id)
                            <th class="w-px-4 py-3 border border-gray-300 " colspan="2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        @php $rowspan = $siswa->siswaekskul->count() ?: 1; @endphp
                        @foreach ($siswa->siswaekskul as $ekskulIndex => $ekskul)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                @if ($ekskulIndex == 0)
                                    <td class="w-px-4 py-3  border border-gray-300 text-center"
                                        rowspan="{{ $rowspan }}">
                                        {{ $no }}</td>
                                    <td class="w-px-4 py-3  border border-gray-300 text-center"
                                        rowspan="{{ $rowspan }}">
                                        {{ $siswa->nis }}</td>
                                    <td class="w-px-4 py-3  border border-gray-300 text-center"
                                        rowspan="{{ $rowspan }}">
                                        {{ $siswa->nama }}</td>
                                @endif
                                <td class="w-px-4 py-3  border border-gray-300 text-center">
                                    {{ $ekskul->ekskul->nama ?? '-' }}
                                </td>
                                <td class="w-px-4 py-3  border border-gray-300 text-center">
                                    {{ $ekskul->keterangan ?? '-' }}
                                </td>
                                @if ($tahun->id == $tahunAktif->id)
                                    <td class="w-px-4 py-3  border border-gray-300 text-center">
                                        <button data-modal-target="edit-ekskul-modal-{{ $ekskul->id }}"
                                            data-modal-toggle="edit-ekskul-modal-{{ $ekskul->id }}"
                                            class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
                                            Edit Nilai
                                        </button>
                                        <button data-modal-target="hapus-ekskul-modal-{{ $ekskul->id }}"
                                            data-modal-toggle="hapus-ekskul-modal-{{ $ekskul->id }}"
                                            class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600">
                                            Hapus Ekskul
                                        </button>
                                    </td>
                                @endif
                                @if ($ekskulIndex == 0 && $tahun->id == $tahunAktif->id)
                                    <td class="w-px-4 py-3  border border-gray-300 text-center"
                                        rowspan="{{ $rowspan }}">
                                        <button data-modal-target="tambah-ekskul-modal-{{ $siswa->id }}"
                                            data-modal-toggle="tambah-ekskul-modal-{{ $siswa->id }}"
                                            class="inline-flex items-center bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                                            Tambah Ekskul
                                        </button>
                                    </td>
                                @endif
                            </tr>
                            @include('guru.partials.eksktrakulikuler.modal-edit-ekskul')
                            @include('guru.partials.eksktrakulikuler.modal-hapus-ekskul')
                        @endforeach
                        @if ($siswa->siswaekskul->isEmpty())
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-px-4 py-3 border border-gray-300 text-center">{{ $no }}</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">{{ $siswa->nis }}</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">{{ $siswa->nama }}</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">-</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">-</td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center"></td>
                                <td class="w-px-4 py-3 border border-gray-300 text-center">
                                    <button data-modal-target="tambah-ekskul-modal-{{ $siswa->id }}"
                                        data-modal-toggle="tambah-ekskul-modal-{{ $siswa->id }}"
                                        class="inline-flex items-center bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">
                                        Tambah Ekskul
                                    </button>
                                </td>
                            </tr>
                        @endif
                        @php $no++; @endphp
                        @include('guru.partials.eksktrakulikuler.modal-tambah-ekskul')
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
