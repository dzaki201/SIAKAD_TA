<div class="mb-4 border-b border-gray-200 dark:border-gray-600">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-300">
        <li class="me-2">
            <a href="{{ route('admin.siswa') }}"
                class="inline-block p-4 border-b-2 rounded-t-lg 
                {{ request()->routeIs('admin.siswa') 
                    ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' 
                    : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                Data Siswa
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('admin.edit.kelas.siswa') }}"
                class="inline-block p-4 border-b-2 rounded-t-lg 
                {{ request()->routeIs('admin.edit.kelas.siswa') 
                    ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' 
                    : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                Plotting Kelas Siswa
            </a>
        </li>
    </ul>
</div>
