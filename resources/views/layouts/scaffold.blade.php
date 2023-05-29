<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simplify Booking: AppointEase</title>
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}">

    @vite('resources/css/app.css')
    @vite('resources/js/alpinejs@3.12.1.js')

    @stack('head')

    @livewireStyles
</head>

<body class="h-full">
    @yield('content')

    @livewireScripts
</body>

</html>
