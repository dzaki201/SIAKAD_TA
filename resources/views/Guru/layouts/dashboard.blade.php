@extends('Guru.main-guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="mb-6 pt-5 flex space-x-4">
        <div
            class=" w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center space-x-6">
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
        <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Kelas : {{ $kelas->nama }}</h5>
            </div>
            <ul class="space-y-2">
                @foreach ($mapels as $mapel)
                    <li class="flex justify-between text-gray-700 dark:text-gray-300">
                        <span>{{ $loop->iteration }}. {{ $mapel->nama }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
@endsection
