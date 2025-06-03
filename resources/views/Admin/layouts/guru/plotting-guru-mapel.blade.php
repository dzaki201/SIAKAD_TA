@extends('Admin.main-admin')

@section('title', 'Dashboard Admin')

@section('content')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
        @include('admin.components.navbar-admin-guru')
        <div class="mb-4">
            @include('components.alert')
            <button data-modal-target="plotting-guru-mapel-modal" data-modal-toggle="plotting-guru-mapel-modal"
                class="inline-flex items-center gap-2 bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20"
                    aria-hidden="true">
                    <path
                        d="m6 10.5237-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm12 0 2.2707.6386c.4313.1213.7293.5147.7293.9627V20c0 .5523-.4477 1-1 1h-2V10.5237Z" />
                    <path fill-rule="evenodd"
                        d="M12.5547 3.16795c-.3359-.22393-.7735-.22393-1.1094 0l-6.00002 4c-.45952.30635-.5837.92722-.27735 1.38675.30636.45953.92723.5837 1.38675.27735L8 7.86853V21h8V7.86853l1.4453.96352c.0143.00957.0289.01873.0435.02746.1597.09514.3364.14076.5112.1406.3228-.0003.6395-.15664.832-.44541.3064-.45953.1822-1.0804-.2773-1.38675l-6-4ZM10 12c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z"
                        clip-rule="evenodd" />
                </svg>
                Plot Mapel
            </button>
        </div>

        <div class="overflow-x-auto rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nip</th>
                        <th scope="col" class="px-6 py-3">Nama Guru</th>
                        <th scope="col" class="px-6 py-3">Keterangan</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gurukelases as $guru)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-blue-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $guru->nip }}</td>
                            <td class="px-6 py-4">{{ $guru->nama }}</td>
                            <td class="px-6 py-4">
                                Guru Mapel {{ $guru->mataPelajaran ? $guru->mataPelajaran->nama : '' }}
                                @php
                                    $filteredKelas = $kelasmapels->filter(function ($kelasmapel) use ($guru) {
                                        return $kelasmapel->mata_pelajaran_id == $guru->mata_pelajaran_id;
                                    });
                                @endphp

                                @if ($filteredKelas)
                                    Kelas:
                                    @foreach ($filteredKelas as $kelasmapel)
                                        {{ $kelasmapel->kelas->nama }}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button data-modal-target="edit-plotting-guru-mapel-modal-{{ $guru->id }}"
                                    data-modal-toggle="edit-plotting-guru-mapel-modal-{{ $guru->id }}"
                                    class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Edit Plot Mapel
                                </button>
                                <button data-modal-target="kelas-guru-mapel-modal-{{ $guru->id }}"
                                    data-modal-toggle="kelas-guru-mapel-modal-{{ $guru->id }}"
                                    class="inline-flex items-center  bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                                    </svg>
                                    Penempatan Kelas
                                </button>
                            </td>
                        </tr>
                        @include('admin.partials.guru.modal-edit-plotting-guru-mapel')
                        @include('admin.partials.guru.modal-kelas-guru-mapel')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.partials.guru.modal-plotting-guru-mapel')
@endsection
