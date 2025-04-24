<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin</title>
</head>

<body>
    @include('components.navbar-admin')
    @include('components.sidebar-admin')
    Ini Halaman Admin
    <a href="{{ route('logout') }}">Logout</a>
</body>

</html>
