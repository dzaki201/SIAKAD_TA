<div>
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @elseif (session('errors'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Error!</span> {{ session('errors') }}
        </div>
    @endif
</div>
