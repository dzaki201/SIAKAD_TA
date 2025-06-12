<div id="dropdownDots-{{ $cp->id }}"
    class="z-50 hidden w-44 bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600 dark:border-gray-600">
    <div
        class="px-4 py-2 text-sm font-semibold text-gray-800 border-b border-gray-200 dark:text-gray-100 dark:border-gray-600 break-words">
        {{ $cp->nama }}
        @if ($cp->status == 'PTS' || $cp->status == 'PAS')
            <br>{{ \Carbon\Carbon::parse($cp->tanggal)->translatedFormat('d F Y') }}
        @endif
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownMenuIconButton-{{ $cp->id }}">
        <li>
            @if ($cp->status == 'CP')
                <button type="button" data-modal-target="edit-capaian-pembelajaran-modal-{{ $cp->id }}"
                    data-modal-toggle="edit-capaian-pembelajaran-modal-{{ $cp->id }}"
                    class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Edit Capaian Pembelajaran
                </button>
            @elseif ($cp->status == 'PTS' || $cp->status == 'PAS')
                <button type="button" data-modal-target="edit-pas-pts-modal-{{ $cp->id }}"
                    data-modal-toggle="edit-pas-pts-modal-{{ $cp->id }}"
                    class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    @if ($cp->status == 'PTS')
                        Edit Penilaian Tengah Semester
                    @elseif ($cp->status == 'PAS')
                        Edit Penilaian Akhir Semester
                    @endif
                </button>
            @endif
        </li>
        @if (Auth::user() && Auth::user()->role === 'guru')
         <li>
            <a href="{{ route('guru.edit.nilai', ['id' => $mapel->id, 'cpId' => $cp->id]) }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                Edit Nilai
            </a>
        </li>
        @elseif (Auth::user() && Auth::user()->role === 'guru_mapel')
        <li>
            <a href="{{ route('guru-mapel.edit.nilai', ['id' => $kelas->id, 'cpId' => $cp->id]) }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Edit Nilai Mapel  {{ $kelas->nama }}
            </a>
        </li>
        @endif
        <li>
            <button type="button" data-modal-target="hapus-capaian-pembelajaran-modal-{{ $cp->id }}"
                data-modal-toggle="hapus-capaian-pembelajaran-modal-{{ $cp->id }}"
                class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                Hapus
            </button>
        </li>
    </ul>
</div>
