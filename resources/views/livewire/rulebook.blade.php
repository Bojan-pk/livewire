<div class="w-10/12  justify-center">
    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center">Елементи формацијских места</h1>
        <div class="relative mr-2 w-1/4">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="searchTerm"
                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Пронађи табелу ...." />
        </div>
    </div>

    <div class="flex mt-4">
        <div class="w-7/12 rounded border p-2">
            <h1 class=" text-l font-medium mb-2 text-blue-600">Табела: <span class=" text-gray-500">
                    {{ @$rulebooksTable->rb }} - {{ @$rulebooksTable->name }}</span> </h1>

            <hr class="h-px my-8 bg-gray-200 border-2">

            <div class="relative overflow-x-auto">
                <table class="w-full text-l text-left rtl:text-right text-gray-500 ">
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
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($rulebooksTable)
                            @foreach ($rulebooks as $key => $value)
                                <tr :key="{{ $key }}" class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $value->rb }}
                                    </th>
                                    <td class="px-2 py-1">
                                        {{ $value->fm }}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ $value->fc_sso }}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ $value->pg_bb }}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ $value->note }}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ @App\Models\Regulation::find($value['regulation_id'])->svl }}
                                    </td>

                                    <td class="px-2 py-1">
                                        @if ($value->id == $rulebooksId)
                                            <a href="#"
                                                wire:click="$dispatch('saveRulebooks', [{{ $value->id }}])">
                                                <span
                                                    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                    Izabrano
                                                </span>
                                            </a>
                                        @else
                                            <a href="#"
                                                wire:click="$dispatch('saveRulebooks', [{{ $value->id }}])">
                                                <span
                                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                    Izaberi
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

        <div class="w-5/12 mx-2 rounded border p-2">
            <h1 class=" text-xl font-medium mb-2">Tabela</h1>

           {{--  @if ($results)
                @foreach ($results as $result)
                    <p wire:click="tableSelected({{ $result->id }})"
                        class="mb-1 p-1.0 text-gray-700 border font-medium border-gray-300 rounded bg-gray-50 cursor-pointer {{ $activeTable == $result->id ? ' bg-green-200' : '' }}">
                        Табела {{ $result->rb }} - {{ $result->name }}
                    </p>
                @endforeach
            @endif --}}

            <div class="relative overflow-x-auto">
                <table class="w-full text-l text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                РБ 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Назив табеле
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($results)
                            @foreach ($results as $result)
                                <tr :key="{{ $result->id }}" wire:click="tableSelected({{ $result->id }})" class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap  ">
                                        {{ $result->rb }}
                                    </th>
                                    <td class="px-2 py-1">
                                        {{ $result->name }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pt-4">
                  {{ $results->links('vendor.livewire.tailwind') }}
              </div>
            </div>





        </div>
    </div>

</div>
