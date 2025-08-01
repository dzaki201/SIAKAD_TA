<div id="modal-{{ $siswaId }}" tabindex="-1"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black/40 backdrop">
    <div class="relative w-full h-full max-w-2xl mx-auto md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Mata Pelajaran di Bawah KKM {{ $items->first()->siswa->nama }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5"
                    data-modal-toggle="modal-{{ $siswaId }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($items as $item)
                        <div class="flex flex-col items-center p-5 bg-gray-100 rounded-xl shadow-sm dark:bg-gray-600">
                            <span class="text-base font-semibold text-gray-900 dark:text-white text-center mb-1">
                                {{ $item->mataPelajaran->nama }}
                            </span>
                            <span class="text-xl font-bold text-gray-800 dark:text-white mb-1">
                                {{ $item->nilai_akhir }}
                            </span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                KKM: {{ $kkmList->get($item->mata_pelajaran_id)->nilai ?? '-' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end p-4 border-t border-gray-200 dark:border-gray-600">
                <button type="button"
                    class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                    data-modal-toggle="modal-{{ $siswaId }}">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
