<div id="tambah-capaian-pembelajaran-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative w-full max-w-md max-h-full m-auto mt-20">
        <div class="relative bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Tambah Capaian Pembelajaran</h3>
                <button type="button" data-modal-hide="tambah-capaian-pembelajaran-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    ✕
                </button>
            </div>
            <form action="{{ route('guru.cp.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Capaian</label>
                    <input type="text" name="nama"
                        class="w-full p-2 border rounded mt-1 focus:ring focus:ring-blue-200" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                    <input type="text" class="w-full p-2 border rounded mt-1"
                        value="{{ $mapel->nama }}" readonly>
                    <input type="hidden" name="mata_pelajaran_id" value="{{ $mapel->id }}">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
