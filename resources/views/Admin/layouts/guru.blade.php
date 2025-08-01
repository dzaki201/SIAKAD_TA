@extends('Admin.main-admin')

@section('title', 'Kelola Data Guru')

@section('content')

    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        @include('admin.components.navbar-admin-guru')
        <div class="mb-4">
            <button data-modal-target="tambah-guru-modal" data-modal-toggle="tambah-guru-modal"
                class="inline-flex items-center px-4 py-2 gap-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Guru
            </button>
        </div>
        <div class="mb-4 overflow-x-auto rounded-lg ">
            <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Nama Guru</th>
                        <th scope="col" class="px-6 py-3">Nip</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">No HP</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gurus as $guru)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-blue-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $guru->user->email }}</td>
                            <td class="px-6 py-4">{{ $guru->nama }}</td>
                            <td class="px-6 py-4">{{ $guru->nip }}</td>
                            <td class="px-6 py-4">{{ $guru->alamat }}</td>
                            <td class="px-6 py-4">{{ $guru->no_hp }}</td>
                            <td class="px-6 py-4">
                                <div class="flex">
                                    <button data-modal-target="edit-guru-modal-{{ $guru->id }}"
                                        data-modal-toggle="edit-guru-modal-{{ $guru->id }}"
                                        class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button data-modal-target="hapus-guru-modal-{{ $guru->id }}"
                                        data-modal-toggle="hapus-guru-modal-{{ $guru->id }}"
                                        class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 ml-2 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('Admin.partials.guru.modal-edit-guru')
                        @include('Admin.partials.guru.modal-hapus-guru')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.partials.guru.modal-tambah-guru')
@endsection
