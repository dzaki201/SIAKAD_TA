@extends('Admin.main-admin')

@section('title', 'Kelola Orang Tua')

@section('content')

    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-between">
            <div class="mb-4">
                <button data-modal-target="tambah-orang-tua-modal" data-modal-toggle="tambah-orang-tua-modal"
                    class="inline-flex items-center px-4 py-2 gap-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Data Orang Tua
                </button>
            </div>
            <form action="{{ route('admin.orang-tua') }}" method="GET" class="space-y-2">
                <select name="status" id="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua Orang Tua</option>
                    <option value="ayah" {{ $status == 'ayah' ? 'selected' : '' }}>Ayah</option>
                    <option value="ibu" {{ $status == 'ibu' ? 'selected' : '' }}>Ibu</option>
                    <option value="wali" {{ $status == 'wali' ? 'selected' : '' }}>Wali</option>
                </select>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                    Search
                </button>
            </form>
        </div>
        <div class="mb-4 overflow-x-auto rounded-lg ">
            <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Siswa</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">NIK</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Pekerjaan</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">No HP</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orangTuas as $ortu)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ ($orangTuas->currentPage() - 1) * $orangTuas->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">{{ $ortu->user->email ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @foreach ($ortu->siswa as $siswa)
                                    {{ $siswa->nama }},
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @if ($ortu->siswa->first())
                                    {{ $ortu->siswa->first()->pivot->status }}
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $ortu->nik }}</td>
                            <td class="px-6 py-4">{{ $ortu->nama }}</td>
                            <td class="px-6 py-4">{{ $ortu->pekerjaan }}</td>
                            <td class="px-6 py-4">{{ $ortu->alamat }}</td>
                            <td class="px-6 py-4">{{ $ortu->no_hp }}</td>
                            <td class="px-6 py-4 ">
                                <div class="flex space-x-2">
                                    <button data-modal-target="edit-orang-tua-modal-{{ $ortu->id }}"
                                        data-modal-toggle="edit-orang-tua-modal-{{ $ortu->id }}"
                                        class="inline-flex items-center bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button data-modal-target="hapus-orang-tua-modal-{{ $ortu->id }}"
                                        data-modal-toggle="hapus-orang-tua-modal-{{ $ortu->id }}"
                                        class="inline-flex items-center bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 ml-2">
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
                        @include('admin.partials.orang-tua.modal-edit-orang-tua')
                        @include('admin.partials.orang-tua.modal-hapus-orang-tua')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center">
            <nav class="items-center" aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-sm">
                    <li>
                        <a href="{{ $orangTuas->previousPageUrl() ?? '#' }}"
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            Previous
                        </a>
                    </li>
                    @for ($i = 1; $i <= $orangTuas->lastPage(); $i++)
                        <li>
                            <a href="{{ $orangTuas->url($i) }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 
                            {{ $i == $orangTuas->currentPage() ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
                    <li>
                        <a href="{{ $orangTuas->nextPageUrl() ?? '#' }}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    @include('admin.partials.orang-tua.modal-tambah-orang-tua')

@endsection
<script>
    function filterSiswa(input) {
        const filter = input.value.toLowerCase();
        const items = document.querySelectorAll('#list-siswa .siswa-item');

        items.forEach(function(item) {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    }
</script>
