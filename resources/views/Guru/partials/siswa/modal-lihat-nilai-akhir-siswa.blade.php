<div id="lihat-nilai-akhir-siswa-modal-{{ $siswa->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-black/40 backdrop">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Nilai Akhir Siswa
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="lihat-nilai-akhir-siswa-modal-{{ $siswa->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    @forelse ($siswa->nilaiAkhir as $nilai)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg dark:bg-gray-600">
                            <span class="text-sm text-gray-900 dark:text-white">{{ $nilai->mataPelajaran->nama }}</span>
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-white">{{ $nilai->nilai_akhir }}</span>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Belum ada data nilai akhir.</p>
                    @endforelse
                </div>
            </div>
            <div class="p-6 space-y-6 pt-4 space-x-4 border-t border-gray-200 dark:border-gray-600 text-right">
                <button type="button"
                    class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                    data-modal-toggle="lihat-nilai-akhir-siswa-modal-{{ $siswa->id }}">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
