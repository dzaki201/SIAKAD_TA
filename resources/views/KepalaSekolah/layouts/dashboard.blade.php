@extends('KepalaSekolah.main-kepala-sekolah')

@section('title', 'Dashboard Kepala Sekolah')

@section('content')
    <div class="flex space-x-4">
        <div
            class="max-w-2xl w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
            <div class="shrink-0">
                <img class="w-24 h-24 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/32.jpg"
                    alt="Profile Photo">
            </div>
            <div class="flex-1">
                <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ Auth::user()->username }}</h5>
                <p class="text-gray-700 dark:text-gray-400 mb-3">{{ Auth::user()->email }}</p>
                <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800" type="button">
                    Edit Akun
                  </button>
            </div>
        </div>
        {{-- <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Data Statistik</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Guru</span>
                        <span class="text-base font-semibold text-gray-900 dark:text-white">{{ $guru }}</span>
                    </li>
                    <li class="py-3 sm:py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Siswa</span>
                        <span class="text-base font-semibold text-gray-900 dark:text-white">{{ $siswa }}</span>
                    </li>
                    <li class="py-3 sm:py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Pengajuan Baru belum disetujui</span>
                        <span class="text-base font-semibold text-gray-900 dark:text-white">-</span>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
@endsection
