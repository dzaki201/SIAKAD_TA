<div id="edit-status-naik-kelas-modal-{{ $siswa->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black/40 backdrop">
    <div class="relative w-full h-full max-w-2xl mx-auto md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Status Naik Kelas</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5"
                    data-modal-toggle="edit-status-naik-kelas-modal-{{ $siswa->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                @if ($siswa->naikKelas)
                    <form action="{{ route('guru.naik-kelas.update', ['id' => $siswa->naikKelas->id]) }}"
                        method="POST">
                        @csrf
                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Status Kenaikan
                                Kelas</label>
                            <select name="status" id="status"
                                class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg dark:bg-gray-600 dark:text-white dark:border-gray-500">
                                <option value="naik" {{ $siswa->naikKelas->status == 'naik' ? 'selected' : '' }}>
                                    Naik kelas</option>
                                <option value="tinggal" {{ $siswa->naikKelas->status == 'tinggal' ? 'selected' : '' }}>
                                    Tinggal Kelas</option>
                                <option value="lulus" {{ $siswa->naikKelas->status == 'lulus' ? 'selected' : '' }}>
                                    Lulus</option>
                            </select>
                        </div>
                        <div class="pt-2 space-x-4 border-t border-gray-200 dark:border-gray-600 text-right">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Simpan</button>
                            <button type="button"
                                class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                data-modal-toggle="edit-status-naik-kelas-modal-{{ $siswa->id }}">
                                Tutup
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
