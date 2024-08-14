<div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input wire:model.live="searchTerm"  class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Пронађи табелу ...."  />
       
   
    
    <ul class="absolute z-50 w-full bg-white text-gray-900 mx-1  text-left  list-inside dark:text-gray-400 mt-1 overflow-hidden">
        @if ($results && $results->count() > 0)
        @foreach ($results as $result)
        <li wire:click="$dispatch('tableSelected',[{{$result->id}}])" class="border rounded-sm cursor-pointer">Tabela br. {{ $result->rb }} {{ $result->name }}</li>
        @endforeach
        @elseif ((!empty($searchTerm)))
        <p class=" text-red-600">Нема резултата претраге </p>

        @endif

    </ul>

</div>
