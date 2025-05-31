<div class="border-b border-gray-200 dark:border-gray-600">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-300">
        @foreach ($mapels as $mapel)
            <li class="me-2">
                <a href="{{ route('guru.get-nilai', ['id' => $mapel->id]) }}"
                    class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition 
                    {{ request()->routeIs('guru.get-nilai') && request()->route('id') == $mapel->id 
                        ? 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400' 
                        : 'border-transparent hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 dark:hover:border-blue-400' }}">
                    
                    <svg class="w-4 h-4 me-2 transition 
                        {{ request()->routeIs('guru.get-nilai') && request()->route('id') == $mapel->id 
                            ? 'text-blue-600 dark:text-blue-400' 
                            : 'text-gray-400 group-hover:text-blue-500 dark:text-gray-500 dark:group-hover:text-blue-400' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    {{ $mapel->nama }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
