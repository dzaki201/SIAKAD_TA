@extends('Admin.main-admin')

@section('title', 'Kelola Data KKM')

@section('content')

    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-between gap-4 mb-4">
            <div class="flex gap-4">
                @php
                    $tahunNow = $tahuns->where('status', 1)->first();
                @endphp
                <div>
                    <button data-modal-target="tambah-kkm-modal" data-modal-toggle="tambah-kkm-modal"
                        class="inline-flex items-center px-4 py-2 gap-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah KKM Mapel
                    </button>
                </div>
                <form action="{{ route('admin.kkm.updateSemua') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Update Semua KKM
                    </button>
                </form>
            </div>
            <form action="{{ route('admin.kkm') }}" method="GET" class="inline">
                <label for="mata_pelajaran_id" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Filter</label>
                <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua Mata Pelajaran</option>
                    @foreach ($mapels as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($mapel) && $item->id == $mapel->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                <select name="tahun_ajaran_id" id="tahun_ajaran_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua Tahun Ajaran</option>
                    @foreach ($tahuns as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
                            {{ $item->semester }} - {{ $item->tahun }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                    Search
                </button>
            </form>
        </div>
        <div class="overflow-x-auto rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mata Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun Ajaran
                        </th>
                        @php
                            $showAction = $kkm->contains('tahun_ajaran_id', $tahunNow->id);
                        @endphp
                        @if ($showAction)
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kkm as $nilai)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-blue-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nilai->mataPelajaran->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nilai->kelas->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nilai->nilai }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nilai->tahunAjaran->semester }} - {{ $nilai->tahunAjaran->tahun }}
                            </td>
                            @if ($nilai->tahun_ajaran_id == $tahunNow->id)
                                <td class="px-6 py-4 ">
                                    <button data-modal-target="edit-kkm-modal-{{ $nilai->id }}"
                                        data-modal-toggle="edit-kkm-modal-{{ $nilai->id }}"
                                        class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button data-modal-target="hapus-kkm-modal-{{ $nilai->id }}"
                                        data-modal-toggle="hapus-kkm-modal-{{ $nilai->id }}"
                                        class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </td>
                                @include('admin.partials.kkm.modal-edit-kkm')
                                @include('admin.partials.kkm.modal-hapus-kkm')
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.partials.kkm.modal-tambah-kkm')
@endsection
