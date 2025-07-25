@extends('Admin.main-admin')

@section('title', 'Plotting Kelas Siswa')

@section('content')
    <div class="overflow-x-auto w-auto rounded-lg border p-4 bg-white dark:bg-gray-800 shadow">
        @include('admin.components.navbar-admin-siswa')
        <div class="flex justify-between">
            <div>
                <form action="{{ route('admin.edit.kelas.siswa') }}" method="GET" class="space-y-2">
                    <label for="filter_kelas" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Filter
                        Kelas:</label>
                    <select name="filter_kelas" id="filter_kelas"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelases as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($kelas) && $item->id == $kelas->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                        Search
                    </button>
                </form>
            </div>
            <div class="pr-2 text-right">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-300">
                    @if (empty($tahun?->semester) && empty($tahun?->tahun))
                        -
                    @else
                        Semester {{ $tahun->semester ?? '-' }} - Tahun Ajaran {{ $tahun->tahun ?? '-' }}
                    @endif
                </span>
            </div>
        </div>
        <form action="{{ route('admin.update.kelas.siswa') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex items-center">
                <label for="kelas_id" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Pindahkan ke:</label>
                <select name="kelas_id" id="kelas_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white mr-2">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelases as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                    <option value="lulus">Lulus</option>
                </select>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                    Pindahkan
                </button>
            </div>
            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun->id }}">
            <div class="overflow-x-auto rounded-lg">
                <table class="w-full min-w-[1000px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white text uppercase bg-blue-800 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                Pilih
                            </th>
                            <th scope="col" class="px-6 py-3">NIS</th>
                            <th scope="col" class="px-6 py-3">Nama Siswa</th>
                            <th scope="col" class="px-6 py-3">Kelas</th>
                            <th scope="col" class="px-6 py-3">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="px-6 py-4">{{ $siswa->nis }}</td>
                                <td class="px-6 py-4">{{ $siswa->nama }}</td>
                                <td class="px-6 py-4">{{ $siswa->kelasSiswa->nama ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $tahunAjaranId = $siswa->kelasSiswa->pivot->tahun_ajaran_id ?? null;
                                        $tahunAjaran = \App\Models\TahunAjaran::find($tahunAjaranId);
                                    @endphp
                                    Semester {{ $tahunAjaran->semester ?? '-' }} - {{ $tahunAjaran->tahun ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
