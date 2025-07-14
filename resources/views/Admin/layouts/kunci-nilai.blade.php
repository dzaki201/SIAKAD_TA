@extends('Admin.main-admin')

@section('title', 'Kelola Data KKM')

@section('content')

    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        <div class="flex justify-end gap-4 mb-4">
            <form action="{{ route('admin.kunci-nilai') }}" method="GET" class="inline">
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
                <select name="kelas_id" id="kelas_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white ml-2">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelases as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($kelas) && $item->id == $kelas->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="ml-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mata Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Kunci
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunci as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-blue-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->guru->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->mataPelajaran->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->kelas->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->locked_at ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if (!$item->is_locked)
                                    <span
                                        class="px-2 py-1 rounded bg-green-100 text-green-800 text-xs font-semibold">Terbuka</span>
                                @elseif ($item->is_locked)
                                    <form action="{{ Route('admin.buka-kunci', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        <button
                                            class="inline-flex items-center bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700"
                                            type="submit">
                                            <svg class="w-5 h-5 text-white mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Buka Kunci
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
