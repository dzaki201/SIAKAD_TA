@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="flex items-center justify-between mt-4 mb-4">
        <div>
            @include('components.alert')
            <button data-modal-target="tambah-capaian-pembelajaran-modal"
                data-modal-toggle="tambah-capaian-pembelajaran-modal"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                type="button">
                Tambah Capaian Pembelajaran
            </button>
        </div>
        <div class="pr-2">
            <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                Semester {{ $tahun->semester }} - Tahun Ajaran {{ $tahun->tahun }}
            </span>
        </div>
    </div>
    <div class="overflow-x-auto rounded-lg">
        <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
            <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                <tr>
                    <th class="w-16 px-4 py-3 text-left border border-gray-300">No</th>
                    <th class="w-60 w-px-4 py-3 border border-gray-300 break-words">Nama</th>
                    @foreach ($capaians as $cp)
                        <th class="w-24 w-px-4 py-3 border border-gray-300 text-center break-words align-middle relative">
                            <div class="flex items-center justify-center space-x-2">
                                <span> {{ \Carbon\Carbon::parse($cp->tanggal)->translatedFormat('d F') }}</span>
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
                        @include('guru.partials.capaian-pembelajaran.modal-edit-capaian-pembelajaran')
                        @include('guru.partials.capaian-pembelajaran.modal-hapus-capaian-pembelajaran')
                    @endforeach
                    <th class="w-24 px-4 py-3 border border-gray-300">UTS</th>
                    <th class="w-24 px-4 py-3 border border-gray-300">UAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswas as $siswa)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-16 px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
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
                        <td class="w-24 px-4 py-3 border border-gray-300"></td>
                        <td class="w-24 px-4 py-3 border border-gray-300"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('guru.partials.capaian-pembelajaran.modal-tambah-capaian-pembelajaran')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const dropdown = this.closest('div[id^="dropdownDots-"]');
                if (dropdown) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    });
</script>
