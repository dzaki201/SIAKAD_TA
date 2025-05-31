<div>
    <aside id="logo-sidebar"
        class="fixed left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 pt-20 pb-4 overflow-y-auto bg-blue-600 dark:bg-blue-800">
            <ul class="space-y-2 font-medium">
                @if (Auth::user() && Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                            <svg class="w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.guru') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.guru') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.siswa') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.siswa') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orang-tua') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.orang-tua') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Orang Tua</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mata-pelajaran') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.mata-pelajaran') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path fill-rule="evenodd"
                                    d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kelas') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.kelas') ? 'bg-blue-700' : '' }}">

                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 20">
                                <path
                                    d="m6 10.5237-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm12 0 2.2707.6386c.4313.1213.7293.5147.7293.9627V20c0 .5523-.4477 1-1 1h-2V10.5237Z" />
                                <path fill-rule="evenodd"
                                    d="M12.5547 3.16795c-.3359-.22393-.7735-.22393-1.1094 0l-6.00002 4c-.45952.30635-.5837.92722-.27735 1.38675.30636.45953.92723.5837 1.38675.27735L8 7.86853V21h8V7.86853l1.4453.96352c.0143.00957.0289.01873.0435.02746.1597.09514.3364.14076.5112.1406.3228-.0003.6395-.15664.832-.44541.3064-.45953.1822-1.0804-.2773-1.38675l-6-4ZM10 12c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tahun-ajaran') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.tahun-ajaran') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 20">
                                <path fill-rule="evenodd"
                                    d="M5.005 10.19a1 1 0 0 1 1 1v.233l5.998 3.464L18 11.423v-.232a1 1 0 1 1 2 0V12a1 1 0 0 1-.5.866l-6.997 4.042a1 1 0 0 1-1 0l-6.998-4.042a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1ZM5 15.15a1 1 0 0 1 1 1v.232l5.997 3.464 5.998-3.464v-.232a1 1 0 1 1 2 0v.81a1 1 0 0 1-.5.865l-6.998 4.042a1 1 0 0 1-1 0L4.5 17.824a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M12.503 2.134a1 1 0 0 0-1 0L4.501 6.17A1 1 0 0 0 4.5 7.902l7.002 4.047a1 1 0 0 0 1 0l6.998-4.04a1 1 0 0 0 0-1.732l-6.997-4.042Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Tahun Ajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ekskul') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('admin.ekskul') ? 'bg-blue-700' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" fill="currentColor"
                                class="size-5 text-gray-200 transition duration-75 group-hover:text-white">
                                <path fill-rule="evenodd"
                                    d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Ekstrakulikuler</span>
                        </a>
                    </li>
                @elseif (Auth::user() && Auth::user()->role === 'guru')
                    <li>
                        <a href="{{ route('guru.dashboard') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('guru.dashboard') ? 'bg-blue-700' : '' }}">
                            <svg class="w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guru.nilai') }}"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('guru.nilai') ? 'bg-blue-700' : '' }}">
                            <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path fill-rule="evenodd"
                                    d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Nilai</span>
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="mt-4 space-y-2 border-t border-gray-200 pt-4 font-medium dark:border-gray-700">
                <li>
                    <a href="{{ route('logout') }}"
                        class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-800 group {{ request()->routeIs('logout') ? 'bg-blue-700' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
