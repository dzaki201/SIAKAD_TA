<div class="border-b border-gray-200 dark:border-gray-600">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-300">
        @foreach ($mapels as $mapel)
            <li class="me-2">
                <a href="{{ route('guru.get-nilai', ['id' => $mapel->id]) }}"
                    class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition 
                    {{ request()->routeIs('guru.get-nilai') && request()->route('id') == $mapel->id 
                        ? 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400' 
                        : 'border-transparent hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 dark:hover:border-blue-400' }}">
                    {{ $mapel->nama }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
