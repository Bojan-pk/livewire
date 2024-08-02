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

<body class="flex-wrap justify-center">

    @livewire('navigation')

    <div class="my-10 flex justify-center">
        {{ $slot }} 
       
    </div>
    <div  class="my-10 flex justify-center">
       @livewire('cart')
       </div>
</body>

</html>