<div>
    @if (session('success'))
        <div id="successModal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center w-full h-full overflow-y-auto overflow-x-hidden bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <div
                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">{{ session('success') }}</p>
                    <button type="button" onclick="document.getElementById('successModal').classList.add('hidden')"
                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-900">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if (session('errors'))
        <div id="errorModal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center w-full h-full overflow-y-auto overflow-x-hidden bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <div
                        class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-red-500 dark:text-red-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2h-2v-2zm0-6h2v5h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Error</span>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">{{ session('errors') }}</p>
                    <button type="button" onclick="document.getElementById('errorModal').classList.add('hidden')"
                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-900">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
