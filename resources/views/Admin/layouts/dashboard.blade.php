@extends('Admin.main-admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-4 gap-4 mb-6 text-center">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total User</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Guru</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $guru }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Siswa</h5>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $siswa }}</p>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun Ajaran</h5>
            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $tahun->semester }} - {{ $tahun->tahun }}
            </p>
        </div>
    </div>
    <div class="flex gap-4">
        <div
            class="w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
            <div class="shrink-0">
                <img class="w-24 h-24 rounded-full object-cover"
                    src="{{ asset(auth()->user()->foto ? 'storage/foto-users/' . auth()->user()->foto : 'storage/foto-default/default-profile.jpg') }}"
                    alt="Foto Profil">
            </div>
            <div class="flex-1">
                <h5 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ Auth::user()->username }}</h5>
                <p class="text-gray-700 dark:text-gray-400 mb-3">{{ Auth::user()->email }}</p>
                <button data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                    type="button">
                    Edit Akun
                </button>
            </div>
        </div>
        <div
            class="w-full max-w-3xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 space-y-4">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Import Data Siswa dan Orang Tua</h2>
                <a href="{{ asset('storage/template/template-import-data.xlsx') }}" download
                    class="inline-block px-4 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Unduh Template Import
                </a>
            </div>
            <form action="{{ route('admin.import-data') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col md:flex-row items-center justify-between gap-4">
                @csrf
                <div class="flex-1">
                    <label for="file" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Pilih File
                        Excel/CSV</label>
                    <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required
                        class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Format file yang diperbolehkan: <strong>.xlsx, .xls</strong>
                    </p>
                </div>
                <div>
                    <button type="submit"
                        class="inline-block px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('partials.modal-edit-akun')
@endsection
