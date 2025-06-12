<div id="dropdownDots"
    class="z-50 hidden w-44 bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600 dark:border-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
        @if (Auth::user() && Auth::user()->role === 'guru')
            <li>
                <a href="{{ route('guru.edit.nilai-akhir', ['id' => $mapel->id, 'kelasId' => $kelas->id]) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Edit Keterangan
                </a>
            </li>
        @elseif (Auth::user() && Auth::user()->role === 'guru_mapel')
            <li>
                <a href="{{ route('guru-mapel.edit.nilai-akhir', ['id' => $mapel->id, 'kelasId' => $kelas->id]) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Edit Keterangan
                </a>
            </li>
        @endif
    </ul>
</div>
