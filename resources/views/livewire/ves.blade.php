<div class="w-10/12  justify-center">
    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center"> Преглед услова 
        за одрређивање ВЕС и ЕС</h1>
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
        <div class="w-9/12 rounded border p-2">
           <!--  <h1 class=" text-l font-medium mb-2 text-blue-600">УСЛОВИ: <span class=" text-gray-500">
                    </span> </h1>

            <hr class="h-px my-8 bg-gray-200 border-2"> -->

             <div class="relative overflow-x-auto">
                  <table class="w-full text-l text-left rtl:text-right text-gray-500 ">
                     <thead class="text-xs text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                               РБ
                             </th>
                           <th scope="col" class="px-6 py-3">
                              ВЕС
                           </th>
                           <th scope="col" class="px-6 py-3">
                              ИШЧИТАВАЊЕ ВЕС
                           </th>
                           <th scope="col" class="px-6 py-3">
                              Услови за одређивање
                           </th>
                           <th scope="col" class="px-6 py-3">
                              Може се попуњавати
                           </th>
                           
                           <th></th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        @if ($ves_conditions)
                        @foreach ($ves_conditions as $key => $value)
                        <tr :key="{{ $key }}" class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $value->rb}}
                             </th>
                           <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap ">
                              {{ $value->ves }}
                           </th>
                           <td class="px-2 py-1 text-xs">
                              {{ $value->reading }}
                           </td>
                           <td class="px-2 py-1 text-xs">
                              {{ $value->condition }}
                           </td>
                           <td class="px-2 py-1 text-xs">
                              {{ $value->alternative }}
                           </td>
                           <td>
                           @if ($value->id== $vesId)
                        <a href="#" wire:click="$dispatch('saveVes', [{{ $value->id }}])">
                           <span
                              class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                              <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                              Izabrano
                           </span>
                        </a>
                        @else
                        <a href="#" wire:click="$dispatch('saveVes', [{{ $value->id }}])">
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
                    {{ $ves_conditions ->links('vendor.livewire.tailwind') }}
                </div>
               </div> 
        </div>

        <div class="w-3/12 mx-2 rounded border p-2">
            <!-- <h1 class=" text-xl font-medium mb-2">Tabela</h1> -->

            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.500ms="combinedVes"  maxlength="5"
                    class="block w-full p-2.5 ps-10  text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Пронађи знак ...." />
            </div>
            <div>
                
                <label for="" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери знак категорије
                    кадра
                </label>
                <select id="" wire:model="firstSign" wire:change="$refresh"
                    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected value="">Изабери ...</option>
                    @foreach ($ves_first_signs as $key => $value)
                        <option value="{{ $value->id}}">{{ $value->sign }} - {{ $value->description }}
                        </option>
                    @endforeach
                </select>
                <label for="" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери знак вида, рода или
                    службе
                </label>
                <select id="" wire:model="secondSign" wire:change="$refresh"
                    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected value="">Изабери ...</option>
                    @foreach ($ves_second_signs as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->sign }} - {{ $value->description }}
                        </option>
                    @endforeach
                </select>
                <label for="" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери знак врсте</label>
                <select id="" wire:model="thirdSign" wire:change="$refresh"
                    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected value="">Изабери ...</option>
                    @if ($ves_third_signs)
                    @foreach ($ves_third_signs as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->sign }} - {{ $value->description }}
                        </option>
                    @endforeach
                    @endif
                </select>
                <label for="" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери знак специјалности</label>
                <select id="" wire:model="fourthSign" wire:change="$refresh"
                    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected value="">Изабери ...</option>
                    @if ($ves_fourth_signs)
                    @foreach ($ves_fourth_signs as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->sign }} - {{ $value->description }}
                        </option>
                    @endforeach
                    @endif
                </select>
                <label for="" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери знак школовања, усавршавања, односно оспособљавања</label>
                <select id="" wire:model="fifthSign" wire:change="$refresh"
                    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected value="">Изабери ...</option>
                    @if ($ves_fifth_signs)
                    @foreach ($ves_fifth_signs as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->sign }} - {{ $value->description }}
                        </option>
                    @endforeach
                    @endif
                </select>


                <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Опис</label>
                    <input wire:model="form.description" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.description')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Напомена</label>
                    <input wire:model="form.note" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.note')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex justify-between">
                    {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        ознаку </button> --}}
                    <button wire:click.prevent="confirmDelete" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        ознаку </button>

                    <button wire:click.prevent="cleanTable()" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        унос</button>
                    <button type="submit"
                        class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4">Унеси</button>
                </div>

            </div>

        </div>
    </div>

</div>
