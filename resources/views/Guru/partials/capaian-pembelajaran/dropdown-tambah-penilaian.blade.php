<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
            <a data-modal-target="tambah-capaian-pembelajaran-modal" data-modal-toggle="tambah-capaian-pembelajaran-modal"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tambah Capaian
                Pembelajaran</a>
        </li>
        <li>
            <a data-modal-target="tambah-pts-pas-modal" data-modal-toggle="tambah-pts-pas-modal"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tambah PTS atau
                PAS</a>
        </li>
        <li>
            <a href="{{ route('guru.nilai-akhir.store', ['id' => $mapel->id]) }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hitung Nilai Akhir</a>
        </li>
    </ul>
</div>
