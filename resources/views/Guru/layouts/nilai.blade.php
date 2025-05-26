@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    @include('guru.components.navbar-guru')
    <div class="mt-4">
        @include('components.alert')
        <button data-modal-target="tambah-capaian-pembelajaran-modal" data-modal-toggle="tambah-capaian-pembelajaran-modal"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
            type="button">
            Tambah Capaian Pembelajaran
        </button>
    </div>
    <div class="pt-5 flex space-x-4">
            <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-center text-white uppercase bg-blue-800 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left border border-gray-300">No</th>
                    <th class="px-4 py-3 border border-gray-300">Nama</th>
                    @foreach ($capaians as $cp)
                        <th class="px-4 py-3 border border-gray-300 text-center align-middle relative">
                            <span class="block">{{ $cp->nama }}</span>

                            <button id="dropdownMenuIconButton-{{ $cp->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $cp->id }}"
                                class="absolute top-1 right-1 p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>
                        </th>

                        @include('guru.partials.capaian-pembelajaran.dropdown-option-cp')
                    @endforeach

                    <th class="px-4 py-3 border border-gray-300">UTS</th>
                    <th class="px-4 py-3 border border-gray-300">UAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswas as $siswa)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $siswa->nama }}</td>
                        @foreach ($capaians as $cp)
                            <td class="px-4 py-3 border border-gray-300"></td>
                        @endforeach
                        <td class="px-4 py-3 border border-gray-300"></td>
                        <td class="px-4 py-3 border border-gray-300"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('guru.partials.capaian-pembelajaran.modal-tambah-capaian-pembelajaran')
@endsection
