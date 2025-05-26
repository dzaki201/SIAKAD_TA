@extends('Admin.mainadmin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.siswa') }}"
                class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Kembali
            </a>
            <form action="{{ route('admin.edit.kelas.siswa') }}" method="GET" class="space-y-4">
                <label for="filter_kelas" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Filter Kelas:</label>
                <select name="filter_kelas" id="filter_kelas"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelases as $kelas)
                        <option value="{{ $kelas->id }}">
                            {{ $kelas->nama }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                    Search
                </button>
            </form>
        </div>
        <form action="{{ route('admin.update.kelas.siswa') }}" method="POST" class="space-y-4">
            @csrf
            <label for="kelas_id" class="text-sm font-medium text-gray-900 dark:text-white">Pindahkan ke:</label>
            <select name="kelas_id" id="kelas_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Pilih Kelas</option>
                @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                Pindahkan
            </button>
            <div class="overflow-x-auto rounded-lg">
                <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4">

                                Pilih
                            </th>
                            <th scope="col" class="px-6 py-3">NIS</th>
                            <th scope="col" class="px-6 py-3">NISN</th>
                            <th scope="col" class="px-6 py-3">Nama Siswa</th>
                            <th scope="col" class="px-6 py-3">Tempat Lahir</th>
                            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-3">Agama</th>
                            <th scope="col" class="px-6 py-3">Sekolah Asal</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600">
                                </td>
                                <td class="px-6 py-4">{{ $siswa->nis }}</td>
                                <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                                <td class="px-6 py-4">{{ $siswa->nama }}</td>
                                <td class="px-6 py-4">{{ $siswa->tempat_lahir }}</td>
                                <td class="px-6 py-4">{{ $siswa->tanggal_lahir }}</td>
                                <td class="px-6 py-4">{{ $siswa->jenis_kelamin }}</td>
                                <td class="px-6 py-4">{{ $siswa->agama }}</td>
                                <td class="px-6 py-4">{{ $siswa->sekolah_asal }}</td>
                                <td class="px-6 py-4">{{ $siswa->alamat }}</td>
                                <td class="px-6 py-4">{{ $siswa->kelas->nama ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
