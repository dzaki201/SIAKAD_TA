@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    @include('components.alert')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-between items-center mt-4 mb-4">
            <div class="flex items-center mt-4 mb-4">
                @if ($kunci != null)
                    @if (!$kunci->is_locked && $status == null)
                        @if ($kunci->tahun_ajaran_id != $tahunAktif->id)
                            <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                                Nilai belum dikunci pada Semester {{ $tahun->semester }} - {{ $tahun->tahun }}
                            </span>
                        @else
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                                type="button">Tambah Penilaian <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <button data-modal-target="kunci-nilai-modal-{{ $kunci->id }}"
                                data-modal-toggle="kunci-nilai-modal-{{ $kunci->id }}"
                                class="ml-4 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                <svg class="w-5 h-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Kunci Nilai
                            </button>
                            @include('guru.partials.kunci-nilai.modal-kunci-nilai')
                        @endif
                    @else
                        @if ($kunci->is_locked)
                            <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                                Nilai telah dikunci pada {{ \Carbon\Carbon::parse($kunci->locked_at)->format('d M Y H:i') }}
                            </span>
                        @else
                            <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                                Nilai belum dikunci
                            </span>
                        @endif
                    @endif
                @endif
            </div>
            <div>
                <form action="{{ route('guru.nilai', ['id' => $mapel->id]) }}" method="GET"
                    class="flex items-center gap-2">
                    <select name="tahun_id" id="tahun"
                        class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="">Pilih Tahun</option>
                        @foreach ($tahuns as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
                                Semester {{ $item->semester }} - {{ $item->tahun }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </form>
            </div>
        </div>
        @if ($kunci == null && $status == null)
            @if ($tahun->id == $tahunAktif->id)
                <div class="flex justify-center items-center h-[500px]">
                    <a href="{{ route('guru.kunci-nilai.store', ['id' => $mapel->id, 'kelasId' => $kelas->id]) }}">
                        <button class="bg-blue-600 text-white rounded-full p-6 hover:bg-blue-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </a>
                    <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Buat Penilaian</span>
                </div>
            @else
                <div class="flex justify-center items-center h-[500px]">
                    <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Tidak ada data penilaian di
                        semester
                        {{ $tahun->semester }} - {{ $tahun->tahun }} </span>
                </div>
            @endif
        @elseif ($status == 'ada')
            <div class="flex justify-center items-center h-[500px]">
                <span class="ml-4 text-lg font-semibold text-gray-700 dark:text-white">Tidak ada data penilaian di
                    semester
                    {{ $tahun->semester }} - {{ $tahun->tahun }} </span>
            </div>
        @else
            <table
                class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th class="w-10 px-4 py-3 text-left border border-gray-300">No</th>
                        <th class="w-20 w-px-4 py-3  border border-gray-300">NIS</th>
                        <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nama</th>
                        @foreach ($capaians as $cp)
                            <th
                                class="w-24 w-px-4 py-3 border border-gray-300 text-center break-words align-middle relative">
                                <div class="flex items-center justify-center space-x-2">
                                    @if ($cp->status == 'PTS')
                                        PTS
                                    @elseif ($cp->status == 'PAS')
                                        PAS
                                    @elseif ($cp->status == 'CP')
                                        <span>
                                            Cp - {{ $loop->iteration }}</span>
                                    @endif
                                    <button id="dropdownMenuIconButton-{{ $cp->id }}"
                                        data-dropdown-toggle="dropdownDots-{{ $cp->id }}"
                                        class="p-1 text-white rounded-full focus:ring-2 focus:ring-blue-300 dark:text-gray-300 dark:focus:ring-blue-800"
                                        type="button">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 4 15">
                                            <path
                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            @include('guru.partials.capaian-pembelajaran.dropdown-option-cp')
                            @include('guru.partials.nilai-akhir.dropdown-option-nilai-akhir')
                            @include('guru.partials.capaian-pembelajaran.modal-edit-capaian-pembelajaran')
                            @include('guru.partials.capaian-pembelajaran.modal-edit-pts-pas')
                            @include('guru.partials.capaian-pembelajaran.modal-hapus-capaian-pembelajaran')
                        @endforeach
                        @if ($nilaiakhirs && $nilaiakhirs->where('mata_pelajaran_id', $mapel->id)->isNotEmpty())
                            <th class="w-32 w-px-4 py-3 border border-gray-300 text-center">
                                Nilai Akhir
                                @if (!$kunci->is_locked && $kunci->tahun_ajaran_id == $tahunAktif->id && $status == null)
                                    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
                                        class="p-1 text-white rounded-full focus:ring-2 focus:ring-blue-300 dark:text-gray-300 dark:focus:ring-blue-800"
                                        type="button">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 4 15">
                                            <path
                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                    </button>
                                @endif
                            </th>
                            <th class="w-[450px] px-4 py-3 border border-gray-300 text-center break-words ">
                                Keterangan
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-10 px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                            <td class="w-20 px-4 py-3 border border-gray-300">{{ $siswa->nis }}</td>
                            <td class="w-60 px-4 py-3 border border-gray-300">{{ $siswa->nama }}</td>
                            @foreach ($capaians as $cp)
                                @php
                                    $nilai = $nilais
                                        ->where('siswa_id', $siswa->id)
                                        ->where('capaian_pembelajaran_id', $cp->id)
                                        ->first();
                                @endphp
                                <td class="w-24 px-4 py-3 border border-gray-300 text-center">
                                    {{ $nilai ? $nilai->nilai : '-' }}
                                </td>
                            @endforeach
                            @if ($nilaiakhirs && $nilaiakhirs->where('mata_pelajaran_id', $mapel->id)->isNotEmpty())
                                @php
                                    $nilaiAkhirSiswa = $nilaiakhirs->where('siswa_id', $siswa->id)->first();
                                @endphp
                                <td class="w-32 px-4 py-3 border border-gray-300 text-center">
                                    {{ $nilaiAkhirSiswa ? $nilaiAkhirSiswa->nilai_akhir : '-' }}
                                </td>
                                <td class="px-4 py-3 border border-gray-300 break-words whitespace-normal">
                                    {{ $nilaiAkhirSiswa ? $nilaiAkhirSiswa->keterangan : '-' }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @include('guru.partials.capaian-pembelajaran.dropdown-tambah-penilaian')
            @include('guru.partials.capaian-pembelajaran.modal-tambah-capaian-pembelajaran')
            @include('guru.partials.capaian-pembelajaran.modal-tambah-pts-pas')
        @endif
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const dropdown = this.closest('div[id^="dropdownDots-"]');
                if (dropdown) {
                    dropdown.classList.add('hidden');
                }
                const dropdownElement = document.getElementById('dropdown');
                if (dropdownElement) {
                    dropdownElement.classList.add('hidden');
                }
            });
        });
    });
</script>
