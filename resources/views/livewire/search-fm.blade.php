<div class="relative">
    <label class="block">
        
        <input type="text"
            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
        focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500" placeholder="Унеси појмове за претрагу"
            wire:model.live="searchTerm" />
    </label>
    <ul class="absolute z-50 w-full bg-white text-gray-900 mx-1  text-left  list-inside dark:text-gray-400 mt-1 overflow-hidden">
        @if ($results && $results->count() > 0)
            @foreach ($results as $result)
                <li  wire:click="$dispatch('fmSelected',[{{$result->id}}])" class="border rounded-sm cursor-pointer"> {{ $result->name }}</li>
            @endforeach
        @elseif ((!empty($searchTerm)))
            <p class=" text-red-600">Нема резултата претраге </p>

        @endif

    </ul>
    
</div>

