<div id="edit-orang-tua-modal-{{ $ortu->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Data Orang Tua
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-orang-tua-modal-{{ $ortu->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.293 4.707a1 1 0 0 1 0 1.414L7.414 9l3.879 3.879a1 1 0 1 1-1.414 1.414L6 10.414 2.121 14.293a1 1 0 0 1-1.414-1.414L4.586 9 .707 5.121a1 1 0 1 1 1.414-1.414L6 7.586l3.879-3.879a1 1 0 0 1 1.414 1.414z" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('admin.orang-tua.update', $ortu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex space-x-4">
                        <div class="w-full">
                            <label for="user_id"
                                class="block text-sm font-medium text-gray-700 dark:text-white">Siswa</label>
                            <select id="user_id" name="user_id"
                                class="w-full px-4 py-2 mt-2 text-sm border  border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">Pilih user</option>
                                @if ($ortu->user_id)
                                    <option value="{{ $ortu->user_id }}" selected>
                                        {{ $ortu->user->email }}
                                    </option>
                                @endif
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="nik"
                                class="block text-sm font-medium text-gray-700 dark:text-white">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ $ortu->nik }}" required
                                class="w-full px-4 py-2 mt-2 text-sm border  border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-full">
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-white">Nama
                                Lengkap</label>
                            <input type="text" id="nama" name="nama" value="{{ $ortu->nama }}" required
                                class="w-full px-4 py-2 mt-2 text-sm border  border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                        <div class="w-full">
                            <label for="pekerjaan"
                                class="block text-sm font-medium text-gray-700 dark:text-white">Pekerjaan</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" value="{{ $ortu->pekerjaan }}"
                                required
                                class="w-full px-4 py-2 mt-2 text-sm border  border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-1/2 pr-2">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 dark:text-white">Nomor
                                HP</label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ $ortu->no_hp }}"
                                class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>

                        <div class="w-1/2">
                            <label for="dropdown-siswa-edit-button"
                                class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Siswa</label>
                            <div class="relative inline-block w-full">
                                <button id="dropdown-siswa-edit-button"
                                    data-dropdown-toggle="dropdown-siswa-edit-menu-{{ $ortu->id }}" type="button"
                                    class="w-full flex items-center justify-between bg-white border border-gray-300 px-4 py-2 rounded-lg text-left focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    <span>Pilih Siswa</span>
                                    <svg class="w-4 h-4 ml-2 text-gray-500 dark:text-gray-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div id="dropdown-siswa-edit-menu-{{ $ortu->id }}"
                                    class="hidden absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow z-10 max-h-64 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                                    <div class="p-2 border-b dark:border-gray-600">
                                        <input type="text" onkeyup="filterSiswa(this)" placeholder="Cari siswa..."
                                            class="w-full border border-gray-300 px-2 py-1 rounded text-sm focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    </div>
                                    <div id="list-siswa">
                                        @foreach ($siswas as $siswa)
                                            <label
                                                class="flex items-center px-3 py-2 border-b border-gray-200 dark:border-gray-600 siswa-item">
                                                <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}"
                                                    class="mr-2" @if ($ortu->siswa->contains($siswa->id)) checked @endif>
                                                <span class="text-gray-700 dark:text-white">{{ $siswa->nama }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-1/2 pr-2">
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Status</label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">Pilih Status</option>
                                <option value="ayah"
                                    {{ $ortu->siswa->first() && $ortu->siswa->first()->pivot->status == 'ayah' ? 'selected' : '' }}>
                                    Ayah
                                </option>
                                <option value="ibu"
                                    {{ $ortu->siswa->first() && $ortu->siswa->first()->pivot->status == 'ibu' ? 'selected' : '' }}>
                                    Ibu
                                </option>
                                <option value="wali"
                                    {{ $ortu->siswa->first() && $ortu->siswa->first()->pivot->status == 'wali' ? 'selected' : '' }}>
                                    Wali
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat"
                            class="block text-sm font-medium text-gray-700 dark:text-white">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-4 py-2 mt-2 text-sm border  border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ $ortu->alamat }}</textarea>
                    </div>
                    <div class="md:col-span-2 p-6 space-x-4 border-t border-gray-200 dark:border-gray-600 text-right">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                            Simpan
                        </button>
                        <button data-modal-hide="edit-orang-tua-modal-{{ $ortu->id }}" type="button"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
