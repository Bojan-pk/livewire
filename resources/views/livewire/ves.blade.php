<div class="w-10/12  justify-center">
    <x-flash-message/>
    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center"> Преглед услова
            за одређивање ВЕС и ЕС</h1>
        <div class="relative mr-2 w-1/4">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live.debounce.500ms="searchTerm"
                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Пронађи ...." />
        </div>
    </div>
    <div class="flex mt-4">
        <div class="w-9/12 rounded border p-2">
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
                                        {{ $value->rb }}
                                    </th>
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap ">
                                        {!! $value->ves !!}
                                    </th>
                                    <td class="px-2 py-1 text-xs">
                                        {!! $value->reading !!}
                                    </td>
                                    <td class="px-2 py-1 text-xs">
                                        {!! $value->condition !!}
                                    </td>
                                    <td class="px-2 py-1 text-xs">
                                        {{ $value->alternative }}
                                    </td>
                                    <td>
                                        @if ($value->id == $vesId)
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
                    {{ @$ves_conditions->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        </div>

        <div class="w-3/12 mx-2 rounded border p-2">
            <!-- <h1 class=" text-xl font-medium mb-2">Tabela</h1> -->

           {{--  <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.500ms="combinedVes" maxlength="5"
                    class="block w-full p-2.5 ps-10  text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Пронађи знак ...." />
            </div> --}}
            <div>
                <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">ВЕС/ЕС</label>
                <div class="flex mb-2 space-x-2 rtl:space-x-reverse">
                    <div>
                        <label for="code-1" class="sr-only">First code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-next="code-2" 
                            autocomplete="off" wire:model="firstSign" id="code-1" wire:change="$refresh"
                            class="uppercase block w-9 h-9 py-3 text-xs font-extrabold text-center
                             {{($firstSign && !$ves_first_signs->where('sign',$firstSign)->count())?'text-red-900  border-red-400':'text-gray-900 border-gray-400' }}
                              bg-white border  rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-2" class="sr-only">Second code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-1" 
                            wire:change="$refresh" autocomplete="off" wire:model="secondSign"
                            data-focus-input-next="code-3" id="code-2"
                            class="uppercase block w-9 h-9 py-3 text-xs font-extrabold text-center
                             {{($secondSign && !$ves_second_signs->where('sign',$secondSign)->count())?'text-red-900  border-red-400':'text-gray-900 border-gray-400' }}
                              bg-white border  rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-3" class="sr-only">Third code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-2" 
                            wire:change="$refresh" autocomplete="off" data-focus-input-next="code-4" id="code-3"
                            wire:model="thirdSign"
                            class="uppercase block w-9 h-9 py-3 text-xs font-extrabold text-center
                             {{($thirdSign && !$ves_third_signs->where('sign',$thirdSign)->count())?'text-red-900  border-red-400':'text-gray-900 border-gray-400' }}
                              bg-white border  rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-4" class="sr-only">Fourth code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-3" 
                            wire:change="$refresh" autocomplete="off" data-focus-input-next="code-5" id="code-4"
                            wire:model="fourthSign"
                            class="uppercase block w-9 h-9 py-3 text-xs font-extrabold text-center
                             {{($fourthSign && !$ves_fourth_signs->where('sign',$fourthSign)->count())?'text-red-900  border-red-400':'text-gray-900 border-gray-400' }}
                              bg-white border  rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-5" class="sr-only">Fifth code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-4" 
                            autocomplete="off" wire:keyup="$refresh" data-focus-input-next="code-6" id="code-5"
                            wire:model="fifthSign"
                            class="uppercase block w-9 h-9 py-3 text-xs font-extrabold text-center
                             {{($fifthSign && !$ves_fifth_signs->where('sign',$fifthSign)->count())?'text-red-900  border-red-400':'text-gray-900 border-gray-400' }}
                              bg-white border  rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                </div>
                <x-input-select name="firstSign" label="Изабери знак категорије кадра" :options="$ves_first_signs"
                    optionValue="sign" :optionText="['sign', 'description']" />

                <x-input-select name="secondSign" label="Изабери знак вида, рода или службе" :options="$ves_second_signs"
                    optionValue="sign" :optionText="['sign', 'description']" {{-- wire:change="$refresh" --}} />

                <x-input-select name="thirdSign" label="Изабери знак врсте" :options="$ves_third_signs" optionValue="sign"
                    :optionText="['sign', 'description']" {{-- wire:change="$refresh" --}} />

                <x-input-select name="fourthSign" label="Изабери знак специјалности" :options="$ves_fourth_signs"
                    optionValue="sign" :optionText="['sign', 'description']" {{-- wire:change="$refresh" --}} />

                <x-input-select name="fifthSign" label="Изабери знак школовања, усавршавања, односно оспособљавања"
                    :options="$ves_fifth_signs" optionValue="sign" :optionText="['sign', 'description']" {{-- wire:change="$refresh" --}} />

                <div class="flex justify-between">
                    <button wire:click.prevent="cleanForm()" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        унос</button>

                </div>
            </div>
        </div>
    </div>
    <script>
        // use this simple function to automatically focus on the next input
        function focusNextInput(el, prevId, nextId) {
            if (el.value.length === 0) {
                if (prevId) {
                    document.getElementById(prevId).focus();
                }
            } else {
                if (nextId) {
                    document.getElementById(nextId).focus();
                }
            }
        }

        document.querySelectorAll('[data-focus-input-init]').forEach(function(element) {
            element.addEventListener('keyup', function() {
                const prevId = this.getAttribute('data-focus-input-prev');
                const nextId = this.getAttribute('data-focus-input-next');
                focusNextInput(this, prevId, nextId);
            });
        });
    </script>
</div>
