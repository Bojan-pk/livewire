<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
</head>

<body class="flex flex-col h-screen">

    <!-- Navigacija -->
    @livewire('navigation')

    <!-- Glavni sadržaj -->
    <div class="flex-grow overflow-y-auto bg-gray-50 p-4" style="padding-bottom: 25vh;">
        <!-- Dodajemo padding-bottom kako bismo osigurali da slot nikada nije prekriven -->
        <div class="my-10 flex justify-center">
            {{ $slot }}
        </div>
    </div>

    <!-- Fiksirana korpa na dnu -->
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg border-t border-gray-300 overflow-y-auto"
         style="max-height: 25vh; min-height: 10vh;">
        @livewire('cart')
    </div>

</body>

</html>
