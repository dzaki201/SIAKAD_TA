<div id="lihat-data-diri-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-black/40">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Data Orang Tua
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="lihat-data-diri-modal">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-gray-700 dark:text-gray-300">NIK</div>
                    <div class="text-gray-900 font-semibold dark:text-white">{{ $orangTua->nik ?? '-' }}</div>

                    <div class="text-gray-700 dark:text-gray-300">Nama</div>
                    <div class="text-gray-900 font-semibold dark:text-white">{{ $orangTua->nama ?? '-' }}</div>

                    <div class="text-gray-700 dark:text-gray-300">Pekerjaan</div>
                    <div class="text-gray-900 font-semibold dark:text-white">{{ $orangTua->pekerjaan ?? '-' }}</div>

                    <div class="text-gray-700 dark:text-gray-300">Alamat</div>
                    <div class="text-gray-900 font-semibold dark:text-white">{{ $orangTua->alamat ?? '-' }}</div>

                    <div class="text-gray-700 dark:text-gray-300">No. HP</div>
                    <div class="text-gray-900 font-semibold dark:text-white">{{ $orangTua->no_hp ?? '-' }}</div>
                </div>
            </div>
            <div class="p-6 pt-4 border-t border-gray-200 dark:border-gray-600 text-right">
                <button type="button"
                    class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                    data-modal-toggle="lihat-data-diri-modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
