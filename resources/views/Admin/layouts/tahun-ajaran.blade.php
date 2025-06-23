@extends('Admin.main-admin')

@section('title', 'Dashboard Admin')

@section('content')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
        <form action="{{ Route('admin.tahun-ajaran.store') }}" method="POST" class="mb-4">
            @csrf
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                type="submit">
                Buat Tahun Ajaran Baru
            </button>
        </form>
        <div class="overflow-x-auto rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tahun Ajaran</th>
                        <th scope="col" class="px-6 py-3">Semester</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahuns as $tahun)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $tahun->tahun }}</td>
                            <td class="px-6 py-4">{{ $tahun->semester }}</td>
                            <td class="px-6 py-4">
                                {{ $tahun->status ? 'Aktif' : 'Tidak Aktif' }}
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-x-2">
                                    @if ($tahun->status)
                                        <form action="{{ Route('admin.tahun-ajaran.nonaktifkan', ['id' => $tahun->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button
                                                class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600"
                                                type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Nonaktifkan
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ Route('admin.tahun-ajaran.aktifkan', ['id' => $tahun->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button
                                                class="inline-flex items-center bg-green-500 text-white p-2 rounded-lg hover:bg-green-600"
                                                type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Aktifkan
                                            </button>
                                        </form>
                                    @endif

                                    <button data-modal-target="hapus-tahun-ajaran-modal-{{ $tahun->id }}"
                                        data-modal-toggle="hapus-tahun-ajaran-modal-{{ $tahun->id }}"
                                        class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                            @include('admin.partials.tahun-ajaran.modal-hapus-tahun-ajaran')
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
