<div id="plotting-guru-mapel-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-black/40">
    <div class="relative w-full max-w-2xl md:h-auto mx-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Plotting Guru Mata Pelajaran</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="plotting-guru-mapel-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.293 4.707a1 1 0 0 1 0 1.414L7.414 9l3.879 3.879a1 1 0 1 1-1.414 1.414L6 10.414 2.121 14.293a1 1 0 0 1-1.414-1.414L4.586 9 .707 5.121a1 1 0 1 1 1.414-1.414L6 7.586l3.879-3.879a1 1 0 0 1 1.414 1.414z" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('admin.plotting.guru-mapel') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="guru_id" class="block text-sm font-medium text-gray-700 dark:text-white">Pilih
                            Guru</label>
                        <select id="guru_id" name="guru_id" required
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="" disabled selected>-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="mata_pelajaran_id"
                            class="block text-sm font-medium text-gray-700 dark:text-white">Pilih Mata
                            Pelajaran</label>
                        <select id="mata_pelajaran_id" name="mata_pelajaran_id" required
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-right border-t border-gray-200 dark:border-gray-600 pt-4 space-x-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Simpan</button>
                        <button data-modal-hide="plotting-guru-mapel-modal" type="button"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
