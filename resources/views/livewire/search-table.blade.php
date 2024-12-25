<div class="relative">
    <div class="flex items-center w-full">
        <!-- Select (dropdown) unutar pretrage -->
        <select wire:model.live="selectedCategory" class="block w-1/3 px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-700 dark:focus:border-blue-700">
            <option value="">Све категорије</option>
            <option value="ПВЛ">ПВЛ</option>
            <option value="ЦЛ">ЦЛ</option>
            
        </select>

        <!-- Input za pretragu -->
        <input type="search" wire:model.live="searchTerm" id="search-dropdown" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border-l-0  border border-gray-300 rounded-r-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-700 dark:focus:border-blue-700" autocomplete="off" placeholder="Пронађи табелу ..." />

        <!-- Dugme za pretragu -->
        <button type="button" class="absolute right-0 top-0 p-3 text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>

    <!-- Prikazivanje rezultata pretrage -->
    <ul class="absolute z-50 w-full bg-white text-gray-900 mx-1 text-left list-inside dark:text-gray-400 mt-1 overflow-hidden">
        
        @if ($results && $results->count() > 0)
        @foreach ($results as $result)
        <li wire:click="$dispatch('tableSelected',[{{$result->id}}])" class="border rounded-sm cursor-pointer">Табела бр. {{ $result->rb }} {{ $result->name }}</li>
        @endforeach
        @elseif ((!empty($searchTerm)))
        <p class=" text-red-600">Нема резултата претраге </p>
        @endif
    </ul>
</div>
