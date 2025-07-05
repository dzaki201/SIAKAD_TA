@extends('OrangTua.main-orang-tua')

@section('title', 'Dashboard Orang Tua')

@section('content')
    @include('components.alert')
    <div class="flex flex-col space-y-6">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    <img class="w-24 h-24 rounded-full object-cover"
                        src="{{ asset(auth()->user()->foto ? 'storage/foto-users/' . auth()->user()->foto : 'storage/foto-default/default-profile.jpg') }}"
                        alt="Foto Profil">
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                        Selamat Datang, {{ Auth::user()->username }}
                    </h2>
                    <p class="text-gray-700 dark:text-gray-400 mb-3">{{ Auth::user()->email }}</p>
                    <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Edit Akun
                    </button>
                    <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Lihat Data Diri
                    </button>
                </div>
            </div>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Daftar Anak</h3>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Semester {{ $tahun->semester }}
                    {{ $tahun->tahun }}</h3>
            </div>
            @if ($anak->count() > 0)
                <div class="space-y-3">
                    @foreach ($anak as $siswa)
                        <div
                            class="p-3 border border-gray-300 rounded-lg flex justify-between items-center dark:border-gray-600">
                            <div>
                                <p class="text-lg font-semibold dark:text-white">{{ $siswa->nama }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">NIS: {{ $siswa->nis }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kelas:
                                    {{ $siswa->kelasSiswa->first()->nama }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <form action="{{ route('orang-tua.nilai-akhir') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                    <button type="submit"
                                        class="px-3 py-1 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        Lihat Detail Nilai
                                    </button>
                                </form>
                                <form action="{{ route('orang-tua.rapor') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                    <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun->id }}">
                                    <button type="submit"
                                    class="px-3 py-1 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Lihat Rapor
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data anak terdaftar.</p>
            @endif
        </div>
    </div>
    @include('partials.modal-edit-akun')
@endsection
