@extends('OrangTua.main-orang-tua')

@section('title', 'Rapor')

@section('content')
    <div class="flex justify-between mb-4">
        <a href="{{ route('orang-tua.dashboard') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <form action="{{ route('orang-tua.rapor') }}" method="GET" class="flex items-center gap-2">
            <div>
                <select name="tahun_ajaran_id" id="tahun"
                    class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    <option value="">Pilih Tahun</option>
                    </option>
                    @php
                        $tahunIdsArray = $tahunIds->toArray();
                        $tahunAktif = $tahuns->where('status', 1)->first();
                    @endphp
                    @foreach ($tahuns->whereIn('id', $tahunIdsArray) as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($tahun) && $item->id == $tahun->id ? 'selected' : '' }}>
                            Semester {{ $item->semester }} - {{ $item->tahun }}
                        </option>
                    @endforeach
                    @if ($tahunAktif && !in_array($tahunAktif->id, $tahunIdsArray))
                        <option value="{{ $tahunAktif->id }}"
                            {{ isset($tahun) && $tahunAktif->id == $tahun->id ? 'selected' : '' }}>
                            Semester {{ $tahunAktif->semester }} - {{ $tahunAktif->tahun }}
                        </option>
                    @endif
                </select>
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            </div>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                Search
            </button>
        </form>
    </div>
    @if ($rapor)
        <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">RAPOR DAN PROFIL PESERTA DIDIK</h2>
            </div>
            <div class="mb-6">
                <table class="w-full border-collapse table-auto text-gray-800 dark:text-gray-200">
                    <tbody>
                        <tr>
                            <td class="p-2 font-medium w-52">Nama Peserta Didik</td>
                            <td class="p-2 break-words">: {{ $siswa->nama }}</td>
                            <td class="p-2 font-medium w-36">Kelas</td>
                            <td class="p-2 w-[120px]">: {{ $siswa->kelasSiswa->first()->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">NIS/NISN</td>
                            <td class="p-2 break-words">: {{ $siswa->nis }}/{{ $siswa->nisn }}</td>
                            <td class="p-2 font-medium">Fase</td>
                            <td class="p-2">: {{ $fase }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Nama Sekolah</td>
                            <td class="p-2 break-words">: SD Negeri 2 Karangrewas Lor</td>
                            <td class="p-2 font-medium">Semester</td>
                            <td class="p-2">: {{ $semester }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Alamat</td>
                            <td class="p-2 break-words">: Jl. Laksda Yos Sudarso No.18 Purwokerto</td>
                            <td class="p-2 font-medium">Tahun Pelajaran</td>
                            <td class="p-2">: {{ $tahun->tahun }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-8">
                <table
                    class="table-auto w-full border border-gray-400 dark:border-gray-600 text-gray-800 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="w-12 p-2 border dark:border-gray-600">No</th>
                            <th class="w-72 p-2 border dark:border-gray-600">Mata Pelajaran</th>
                            <th class="w-20 p-2 border dark:border-gray-600">Nilai Akhir</th>
                            <th class="p-2 border dark:border-gray-600">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapels as $mapel)
                            <tr>
                                <td class="p-2 border text-center dark:border-gray-600">{{ $loop->iteration }}</td>
                                <td class="p-2 border dark:border-gray-600">{{ $mapel->nama }}</td>
                                <td class="p-2 border text-center dark:border-gray-600">
                                    {{ $nilaiakhirs->where('siswa_id', $siswa->id)->where('mata_pelajaran_id', $mapel->id)->first()?->nilai_akhir ?? '-' }}
                                </td>
                                <td class="p-2 border dark:border-gray-600">
                                    {{ $nilaiakhirs->where('siswa_id', $siswa->id)->where('mata_pelajaran_id', $mapel->id)->first()?->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-8">
                <h4 class="font-semibold mb-2 text-gray-900 dark:text-white">Ekstrakurikuler</h4>
                <table
                    class="table-auto w-full border border-gray-400 dark:border-gray-600 text-gray-800 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="w-12 p-2 border dark:border-gray-600">No</th>
                            <th class="w-72 p-2 border dark:border-gray-600">Ekstrakurikuler</th>
                            <th class="p-2 border dark:border-gray-600">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ekskuls->where('siswa_id', $siswa->id) as $item)
                            <tr>
                                <td class="p-2 border text-center dark:border-gray-600">{{ $loop->iteration }}</td>
                                <td class="p-2 border dark:border-gray-600">{{ $item->ekskul->nama }}</td>
                                <td class="p-2 border dark:border-gray-600">{{ $item->keterangan ?? 'Baik' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-8">
                <h4 class="font-semibold mb-2 text-gray-900 dark:text-white">Catatan Guru</h4>
                <p class="p-2 border border-gray-400 dark:border-gray-600 dark:text-gray-200">{{ $catatan->catatan }}</p>
            </div>
            <div class="mb-8 grid grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold mb-2 text-gray-900 dark:text-white">Kehadiran</h4>
                    <table
                        class="table-auto border border-gray-400 dark:border-gray-600 w-full text-gray-800 dark:text-gray-200">
                        <tbody>
                            @php $absen = $absensi->where('siswa_id', $siswa->id)->first(); @endphp
                            <tr>
                                <td class="w-40 p-2 border dark:border-gray-600">Sakit</td>
                                <td class="w-40 p-2 border dark:border-gray-600">{{ $absen?->sakit ?? '0' }} Hari</td>
                            </tr>
                            <tr>
                                <td class="w-40 p-2 border dark:border-gray-600">Izin</td>
                                <td class="w-40 p-2 border dark:border-gray-600">{{ $absen?->ijin ?? '0' }} Hari</td>
                            </tr>
                            <tr>
                                <td class="w-40 p-2 border dark:border-gray-600">Tanpa Keterangan</td>
                                <td class="w-40 p-2 border dark:border-gray-600">{{ $absen?->alpa ?? '0' }} Hari</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($keputusan)
                    <div>
                        <h4 class="font-semibold mb-2 text-gray-900 dark:text-white">Keputusan</h4>
                        <div
                            class="border border-gray-400 dark:border-gray-600 p-4 leading-relaxed text-gray-800 dark:text-gray-200">
                            Berdasarkan pencapaian seluruh kompetensi peserta didik, dinyatakan:
                            <br><br>
                            <strong class="uppercase">
                                @if ($keputusan->status == 'naik')
                                    Naik Kelas {{ $nextKelas }} ({{ $teksKelas }})
                                @elseif ($keputusan->status == 'tinggal')
                                    Tinggal Kelas {{ $nextKelas }} ({{ $teksKelas }})
                                @elseif ($keputusan->status == 'lulua')
                                    Lulus
                                @endif
                            </strong>
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex justify-between mb-4 text-gray-800 dark:text-gray-200">
                <p class="ml-24 text-left">Mengetahui,</p>
                <p class="mr-12 text-right">Purwokerto, .........................................</p>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center text-gray-800 dark:text-gray-200">
                <div>
                    <p class="font-medium">Orang Tua/Wali</p>
                    <div class="h-24"></div>
                    <p>..................................</p>
                </div>
                <div>
                    <p class="font-medium">Guru Kelas</p>
                    <div class="h-24"></div>
                    <p>{{ $guru->nama }}<br>NIP. {{ $guru->nip }}</p>
                </div>
                <div>
                    <p class="font-medium">Kepala Sekolah</p>
                    <div class="h-24"></div>
                    <p>{{ $kepsek->nama }}<br>NIP. {{ $kepsek->nip }}</p>
                </div>
            </div>
        </div>
    @else
        <div
            class="p-8 text-center bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Data Rapor Belum Lengkap</h2>
            <p class="text-gray-800 dark:text-gray-300">
                Mohon maaf, data rapor untuk tahun pelajaran
                <strong class="dark:text-white">{{ $tahun->tahun }}</strong>
                semester
                <strong class="dark:text-white">{{ $semester == 1 ? 'Ganjil' : 'Genap' }}</strong>
                belum lengkap.
            </p>
        </div>
    @endif
@endsection
