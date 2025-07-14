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
    <div
        class="w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
        <div class="shrink-0">
            <img class="w-24 h-24 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/32.jpg"
                alt="Profile Photo">
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
    @include('partials.modal-edit-akun')
@endsection
