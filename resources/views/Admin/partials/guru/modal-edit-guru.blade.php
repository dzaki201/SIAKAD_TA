<div id="edit-guru-modal-{{ $guru->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black/40">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Guru</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-guru-modal-{{ $guru->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.293 4.707a1 1 0 0 1 0 1.414L7.414 9l3.879 3.879a1 1 0 1 1-1.414 1.414L6 10.414 2.121 14.293a1 1 0 0 1-1.414-1.414L4.586 9 .707 5.121a1 1 0 1 1 1.414-1.414L6 7.586l3.879-3.879a1 1 0 0 1 1.414 1.414z" />
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col md:flex-row gap-6 mb-2">
                        <div class="w-full md:w-1/2 space-y-4">
                            <h4 class="text-lg font-semibold text-gray-700 dark:text-white">Akun</h4>
                            <input type="hidden" name="role" value="kepsek">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Email</label>
                                <input type="email" name="email" value="{{ $guru->user->email }}"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Password
                                </label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                    placeholder="Kosongkan jika tidak ingin ganti">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 6 karakter.
                                </p>
                            </div>
                            <div>
                                <label for="foto"
                                    class="block text-sm font-medium text-gray-700 dark:text-white">Foto</label>
                                <input type="file" name="foto" id="foto"
                                    class="block w-full mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                    accept="image/*">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, JPEG, PNG. Maks
                                    2MB.
                                </p>
                            </div>
                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select name="role" id="role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    <option value="">pilih role</option>
                                    <option value="admin" {{ $guru->user->role == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="guru" {{ $guru->user->role == 'guru' ? 'selected' : '' }}>Guru
                                        kelas
                                    </option>
                                    <option value="guru_mapel"
                                        {{ $guru->user->role == 'guru_mapel' ? 'selected' : '' }}>Guru
                                        mapel
                                    </option>
                                    <option value="kepsek" {{ $guru->user->role == 'kepsek' ? 'selected' : '' }}>Kepala
                                        Sekolah
                                    </option>
                                    <option value="orang_tua" {{ $guru->user->role == 'orang_tua' ? 'selected' : '' }}>
                                        Orang
                                        Tua
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 space-y-4">
                            <h4 class="text-lg font-semibold text-gray-700 dark:text-white">Data Guru</h4>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nama</label>
                                <input type="text" name="nama" value="{{ $guru->nama }}"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">NIP</label>
                                <input type="text" name="nip" value="{{ $guru->nip }}"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nomor HP</label>
                                <input type="text" name="no_hp" value="{{ $guru->no_hp }}"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Alamat</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ $guru->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
                        <button type="button" data-modal-hide="edit-guru-modal-{{ $guru->id }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
