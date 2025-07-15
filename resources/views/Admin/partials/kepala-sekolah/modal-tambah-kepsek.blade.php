<div id="tambah-kepsek-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-black/40">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Kepala Sekolah
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="tambah-kepsek-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.293 4.707a1 1 0 0 1 0 1.414L7.414 9l3.879 3.879a1 1 0 1 1-1.414 1.414L6 10.414 2.121 14.293a1 1 0 0 1-1.414-1.414L4.586 9 .707 5.121a1 1 0 1 1 1.414-1.414L6 7.586l3.879-3.879a1 1 0 0 1 1.414 1.414z" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('admin.kepsek.store') }}" method="POST" enctype="multipart/form-data"
                    class="grid md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-white">Akun</h4>
                        <input type="hidden" name="role" value="kepsek">
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 6 karakter.
                            </p>
                        </div>
                        <div>
                            <label for="foto"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                            <input type="file" name="foto" id="foto"
                                class="block w-full mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                accept="image/*">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Format gambar: JPG, JPEG, PNG. Maksimal 2MB.
                            </p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-white">Data Kepala Sekolah</h4>

                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kepala Sekolah</label>
                            <input type="text" id="nama" name="nama"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="nip"
                                class="block text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                            <input type="text" id="nip" name="nip"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-900 dark:text-white">Nomor
                                HP</label>
                            <input type="text" id="no_hp" name="no_hp"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                        <div>
                            <label for="alamat"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="w-full p-2.5 rounded-lg border text-sm bg-gray-50 border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
                        </div>
                    </div>
                    <div
                        class="md:col-span-2 flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Tambah
                        </button>
                        <button type="button" data-modal-hide="tambah-kepsek-modal"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
