<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

     <title>@yield('title')</title>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    @include('components.navbar')
    @include('components.sidebar')
    @include('components.alert')
    <div class="p-4 sm:ml-64 pt-20 ">
        @yield('content')
    </div>

    {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
</body>

</html>
