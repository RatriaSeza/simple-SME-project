<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" /> --}}
    {{ $css ?? '' }}
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-100 flex">
        <div>
            @include('layouts.sidebar')
        </div>
        <div class="w-full">
            @include('layouts.header')
            <!-- Page Content -->
            <main class="pb-2">
                {{ $slot }}
            </main>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/3869e2171c.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dismissible.js"></script>
    {{ $js ?? '' }}
</body>

</html>
