<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

 @livewireStyles
</head>
<body class=" flex ">
    <div class="w-10/12 my-2 flex">
        <div class="w-5/12 rounded border p-2">
             @livewire('tickets')
        </div>
        <div class="w-7/12 mx-2 rounded border p-2">
        @livewire('comments')
        </div>

    </div>    

        
       
        
    
    
    @livewireScripts
    
</body>
</html>