<form>
    <label class="block">
        <span class="block text-sm font-medium text-slate-700">Username</span>
        <!-- Using form state modifiers, the classes can be identical for every input -->
        <input type="text"
            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
        focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
            wire:model.live="searchTerm" />
    </label>
    <ul class="max-w-3/12  text-gray-500 mx-1  list-inside dark:text-gray-400 mt-3">
        @if ($users && $users->count() > 0)
            @foreach ($users as $user)
                <li class="border rounded-sm"> {{ $user->name }}</li>
            @endforeach
        @else
            <p class=" text-red-600">Nema korisnika </p>

        @endif

    </ul>
    
</form>
