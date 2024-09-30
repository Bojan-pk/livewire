<div class="w-10/12  justify-center">

    <h1 class="text-xl font-medium mb-2 text-start">Елементи формацијских места</h1>

    <div class="flex mt-4">

        <div class="w-8/12 rounded border p-2 ">
            <div class="flex justify-between">
                <h1 class=" text-l font-medium mb-2 text-blue-600">Табела:
                    @if ($activeTable)
                        <span class=" text-gray-500">
                            {{ @App\Models\RulebooksTable::find($activeTable)->rb }} -
                            {{ @App\Models\RulebooksTable::find($activeTable)->name }}
                        </span>
                    @else
                        <span class=" text-gray-500">
                            Све табеле
                        </span>
                    @endif

                </h1>
                <div class="relative mr-2 w-1/3">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input wire:model.live="searchFm"
                        class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Пронађи ФМ и елементе ФМ ...." />
                </div>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-2">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                РБ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Назив РМ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ФЧ/ССО
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ПГ/ББ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Напомена
                            </th>
                            <th>
                                СВЛ
                            </th>
                            <th>
                                Табела
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rulebooks)
                            @foreach ($rulebooks as $key => $value)
                                <tr :key="{{ $key }}" class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap ">


                                        {{ $value->rb }}

                                    </th>
                                    <td class="px-2 py-1">
                                        {!! $value->fm !!}
                                    </td>
                                    <td class="px-2 py-1">
                                        {!! $value->fc_sso !!}
                                    </td>
                                    <td class="px-2 py-1">
                                        {!! $value->pg_bb !!}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ $value->note }}
                                    </td>
                                    <td class="px-2 py-1 cursor-pointer text-blue-400">
                                        <a data-popover-target="popover-default{{ $value->id }}">Види ...</a>
                                        <div data-popover id="popover-default{{ $value->id }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 ">
                                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg ">
                                                <h3 class="font-semibold text-gray-900 ">СВЛ</h3>
                                            </div>
                                            <div class="px-3 py-2">
                                                <p> {{ @App\Models\Regulation::find($value['regulation_id'])->svl }}
                                                </p>
                                            </div>
                                            <div data-popper-arrow></div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ $value->rulebooksTable->rb }} - {{ $value->rulebooksTable->name }}
                                    </td>

                                    <td class="px-2 py-1">
                                        @if ($value->id == $rulebooksId)
                                            <a href="#"
                                                wire:click="$dispatch('saveRulebooks', [{{ $value->id }}])">
                                                <span
                                                    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                    Изабрано
                                                </span>
                                            </a>
                                        @else
                                            <a href="#"
                                                wire:click="$dispatch('saveRulebooks', [{{ $value->id }}])">
                                                <span
                                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                    Изабери
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pt-4">
                    {{ $rulebooks->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        </div>
        <div class="w-4/12 mx-2 rounded border p-2">
            <div class="flex justify-between">
                <h1 class=" text-xl font-medium mb-2">Табела</h1>
                <div class="relative mr-2 w-2/4">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input wire:model.live="searchTerm"
                        class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Пронађи табелу ...." />
                </div>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-2">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                РБ -  Назив табеле
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($resultsTable)
                            @foreach ($resultsTable as $result)
                                <tr :key="{{ $result->id }}" wire:click="tableSelected({{ $result->id }})"
                                    class="{{ $activeTable == $result->id ? 'bg-gray-300 hover:bg-gray-400' : 'bg-white hover:bg-gray-50' }}
                                      border-b  cursor-pointer">
                                    <td scope="row" class="px-2 py-1  text-gray-900 whitespace-nowrap  ">
                                       <b>{!! $result->rb !!}</b>  - {!! $result->name !!}
                                    </td>
                                    
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pt-4">
                    {{ $resultsTable->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        </div>
    </div>

</div>
