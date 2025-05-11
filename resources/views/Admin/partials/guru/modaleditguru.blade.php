<div id="edit-guru-modal-{{ $guru->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Guru
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-guru-modal-{{ $guru->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.293 4.707a1 1 0 0 1 0 1.414L7.414 9l3.879 3.879a1 1 0 1 1-1.414 1.414L6 10.414 2.121 14.293a1 1 0 0 1-1.414-1.414L4.586 9 .707 5.121a1 1 0 1 1 1.414-1.414L6 7.586l3.879-3.879a1 1 0 0 1 1.414 1.414z" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('admin.guru.update', ['id' => $guru->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="user_id"
                            class="block text-sm font-medium text-gray-700 dark:text-white">User</label>
                        <select id="user_id" name="user_id"
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">Pilih User</option>
                            <option value="{{ $guru->user_id }}" selected>
                                {{ $guru->user->username }}
                            </option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-white">Nama
                            Guru</label>
                        <input type="text" id="nama" name="nama"
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $guru->nama }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="nip"
                            class="block text-sm font-medium text-gray-700 dark:text-white">NIP</label>
                        <input type="text" id="nip" name="nip"
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $guru->nip }}" placeholder="Opsional" maxlength="50" required>
                    </div>

                    <div class="mb-4">
                        <label for="kelas_id"
                            class="block text-sm font-medium text-gray-700 dark:text-white">Kelas</label>
                        <select id="kelas_id" name="kelas_id"
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">-</option>
                            @if ($guru->kelas_id)
                                <option value="{{ $guru->kelas_id }}" selected>
                                    {{ $guru->kelas->nama_kelas }}
                                </option>
                            @endif
                            @foreach ($kelases as $kelas)
                                <option value="{{ $kelas->id }}">
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="mata_pelajaran_id"
                            class="block text-sm font-medium text-gray-700 dark:text-white">Mata Pelajaran</label>
                        <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                            class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">Pilih Mata Pelajaran Jika Guru Mata Pelajaran</option>
                            <option value="">-</option>
                            @if ($guru->mata_pelajaran_id)
                            <option value="{{ $guru->mata_pelajaran_id }}" selected>
                                {{ $guru->mataPelajaran->nama_mata_pelajaran }}
                            </option>
                            @endif
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama_mata_pelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-6 space-x-4 border-t border-gray-200 dark:border-gray-600 text-right">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Perbaharui</button>
                        <button data-modal-hide="edit-guru-modal-{{ $guru->id }}" type="button"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
