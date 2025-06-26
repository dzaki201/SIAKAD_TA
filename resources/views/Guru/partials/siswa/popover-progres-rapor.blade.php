<div data-popover id="popover-progres-rapor-{{ $siswa->id }}" role="tooltip"
    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
    <div class="p-3 space-y-2">
        <h3 class="font-semibold text-gray-900 dark:text-white">Data Rapor belum diisi</h3>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
            @foreach ($progres['belum_isi'] as $rapor)
                <li>{{ $rapor }}</li>
            @endforeach
        </ul>
    </div>
    <div data-popper-arrow></div>
</div>
