@extends('Guru.main-guru')

@section('title', 'Data Siswa')

@section('content')
    @include('components.alert')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-end mb-4">
            <div></div>
            <form action="{{ route('guru.siswa') }}" method="GET" class="flex items-center gap-2">
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
        <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
            <thead class="text-xs text-white text-center uppercase bg-blue-800 dark:bg-gray-700">
                <tr>
                    <th class="w-10 py-3  border border-gray-300">No</th>
                    <th class="py-3  border border-gray-300">NIS</th>
                    <th class="w-py-3 border border-gray-300">Nama</th>
                    <th class="py-3 border border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswas as $siswa)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-10 py-3 border border-gray-300 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 border border-gray-300 text-center">{{ $siswa->nis }}</td>
                        <td class="py-3 border border-gray-300 text-center">{{ $siswa->nama }}</td>
                        <td class="py-3 border items-center border-gray-300 ">
                            <div class="flex justify-center">
                                <button data-modal-target="lihat-data-siswa-modal-{{ $siswa->id }}"
                                    data-modal-toggle="lihat-data-siswa-modal-{{ $siswa->id }}"
                                    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 3v4a1 1 0 0 1-1 1H5m8 7.5 2.5 2.5M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-5 9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                    </svg>
                                    Detail Siswa
                                </button>
                            </div>
                        </td>
                    </tr>
                    @include('guru.partials.siswa.modal-lihat-data-siswa')
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
