<div id="lihat-data-siswa-modal-{{ $siswa->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-black/40 backdrop">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Detail Data Siswa
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="lihat-data-siswa-modal-{{ $siswa->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <dl class="grid grid-cols-4 gap-4">
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nama Lengkap</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->nama }}</dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Kelas</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->kelas->nama }}</dd>
                    </div>
                    <div>

                        <dt class="font-semibold text-gray-900 dark:text-white">NIS/NSN</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->nis }}/{{ $siswa->nisn }}</dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Jenis Kelamin</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->jenis_kelamin }}</dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Agama</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->agama }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Asal sekolah</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->sekolah_asal }}</dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Tempat Lahir</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->tempat_lahir }}</dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Tanggal Lahir</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Alamat</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">{{ $siswa->alamat }}</dd>
                    </div>
                </dl>
                <hr class="border-gray-300 dark:border-gray-600">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Data Orang Tua / Wali</h4>
                <dl class="grid grid-cols-3 gap-4">
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nama Ayah</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ayah')->first())->nama ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Pekerjaan Ayah</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ayah')->first())->pekerjaan ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Email</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ $siswa->orangTua->where('status', 'ayah')->first()->user?->email ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nomor Hp</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ayah')->first())->no_hp ?? '-' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nama Ibu</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ibu')->first())->nama ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Pekerjaan Ibu</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ibu')->first())->pekerjaan ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Email</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ $siswa->orangTua->where('status', 'ibu')->first()->user?->email ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nomor Hp</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'ibu')->first())->no_hp ?? '-' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nama Wali</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'wali')->first())->nama ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Pekerjaan Wali</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'wali')->first())->pekerjaan ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Email</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ $siswa->orangTua->where('status', 'wali')->first()->user?->email ?? '-' }}
                        </dd>
                        <dt class="font-semibold text-gray-900 dark:text-white">Nomor Hp</dt>
                        <dd class="mb-2 text-gray-700 dark:text-gray-300">
                            {{ optional($siswa->orangTua->where('status', 'wali')->first())->no_hp ?? '-' }}
                        </dd>
                    </div>
                </dl>
                <div class="pt-4 space-x-4 border-t border-gray-200 dark:border-gray-600 text-right">
                    <button type="button"
                        class="px-6 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                        data-modal-toggle="lihat-data-siswa-modal-{{ $siswa->id }}">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
