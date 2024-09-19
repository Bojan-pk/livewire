<div>
    <form wire:submit="submitForm" class=" flex justify-center">
        <div class="w-9/12 rounded border p-2">

            <div>
                @if (session()->has('success'))
                    <div id="alert-border-3"
                        class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }} <a href="#"
                                class="font-semibold underline hover:no-underline"></a>
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-border-3" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div id="alert-border-2"
                        class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 "
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}<a href="#"
                                class="font-semibold underline hover:no-underline"></a>
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-border-2" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-xs text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                РБ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ВЕС (ван снаге)
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Може се попуњавати
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Род (служба)
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Услови за одређивање
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ВЕС
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ишчитавање ВЕС/ЕС
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Услови за одређивање
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Може се попуњавати
                            </th>
                            <th scope="col" class="px-6 py-3">
                                СВЛ
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($vesConditions)
                            @foreach ($vesConditions as $key => $value)
                                <tr wire:click="rowSelected({{ $value->id }})"
                                    class=" border-b  cursor-pointer {{ $selectedId == $value->id ? 'bg-gray-300 hover:bg-gray-400' : 'bg-white ' }} hover:bg-gray-100">
                                    <td scope="row" class="px-6 py-2  ">
                                        {{ $value->rb }}
                                    </td>
                                    <td scope="row" class="px-6 py-2 text-sm ">
                                        {{ $value->old_ves }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->old_alternative }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->old_kind }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->old_condition }}
                                    </td>
                                    <td class="px-6 py-2 text-sm ">
                                        {{ $value->ves }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->reading }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->condition }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $value->alternative }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ @$value->regulation->svl }}
                                    </td>
                                    
                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $vesConditions->links('vendor.livewire.tailwind') }}
                </div>
            </div>


        </div>

        <div class="w-3/12 mx-2 rounded border p-2">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live="searchTerm"
                    class="block w-full p-2.5 ps-10  text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Пронађи ВЕС...." />
            </div>
            <div>
                {{-- <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">ВЕС (ван
                        снаге)</label>
                    <input wire:model="form.old_ves" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                
                <div>
                    @error('form.old_ves')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.old_ves" label="ВЕС (ван снаге)" maxlength="5" class="uppercase"/>
                {{-- <div>
                    <label for="" class="block mt-2 mb-2  font-medium text-start">Може се попуњавати</label>
                    <input wire:model="form.old_alternative" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.old_alternative')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.old_alternative" label="Може се попуњавати" />

                {{-- <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Род (служба)</label>
                    <input wire:model="form.old_kind" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.old_kind')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.old_kind" label="Род (служба)" />
                
                {{-- <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Услови за
                        одређивање</label>
                    <input wire:model="form.old_condition" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.old_condition')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.old_condition" label="Услови за одређивање" />
                
                {{-- <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">ВЕС</label>
                    <input wire:model="form.ves" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.ves')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.ves" label="ВЕС" maxlength="5" class="uppercase"/>

                <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Ишчитавање
                        ВЕС/ЕС</label>
                    <textarea wire:model="form.reading" rows="2"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="..."></textarea>

                </div>
                <div>
                    @error('form.reading')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Услови за
                        одређивање</label>
                    <input wire:model="form.condition" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.condition')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.condition" label="Услови за одређивање" />

                {{-- <div>
                    <label for="" class="block mt-2 mb-2  font-medium text-start">Може се попуњавати</label>
                    <input wire:model="form.alternative" type="text" id=""
                        class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div>
                    @error('form.alternative')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div> --}}
                <x-input-text name="form.alternative" label="Може се попуњавати" />
                <x-input-select name="form.regulation_id" label="Документ који је основ уноса"
                    :options="$regulations" optionValue="id" :optionText="['short_name','svl']" />

                
                <div>
                    <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Унеси фајл</label>
                    <input type="file" wire:model="form.excelFile" {{-- wire:click.prevent="import" --}}
                        class="block w-full   mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">

                    @error('form.excelFile')
                        <span class=" text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <button wire:click.prevent="confirmDelete" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    ознаку </button>
                <button wire:click="cleanTable()" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    ред</button>
                <button type="submit"  wire:loading.attr="disabled"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4"><svg wire:loading aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>Унеси
                    
                </button>
            </div>

        </div>
    </form>

    @if ($showDeleteModal)
        <!-- Modal Background Overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <!-- Modal Content -->
            <div class="relative w-full max-w-md mx-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" wire:click="closeModal"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 01-1.414-1.414L8.586 10 4.293 5.707a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Да ли сте сигурни да
                            желите да обришете овај ред?</h3>
                        <button wire:click.prevent=" removeRow({{ $form->id }})"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Да, сигуран сам
                        </button>
                        <button wire:click="closeModal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Не, откажи
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
