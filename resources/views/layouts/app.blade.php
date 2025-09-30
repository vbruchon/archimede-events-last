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

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body class="font-sans antialiased bg-gray-100">


    <div class="flex">
        <aside class="h-screen w-sidebar z-50" aria-label="Sidebar">
            @include('layouts.navdashboard')
        </aside>

        <main class="flex-1">
            @if (isset($header))
            <header class="bg-white shadow sticky top-0 w-full z-10">
                <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif
            {{ $slot }}
        </main>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>