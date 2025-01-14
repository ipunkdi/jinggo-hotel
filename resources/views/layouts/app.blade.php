<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="antialiased bg-white dark:bg-gray-900">
            <x-header></x-header>

            <x-sidebar></x-sidebar>

            <!-- Page Content -->
            <main class="p-4 md:ml-64 h-auto pt-20">
                {{ $slot }}
            </main>
        </div>
        @yield('js')
    </body>
</html>
