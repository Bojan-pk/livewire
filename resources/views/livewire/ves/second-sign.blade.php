<div>
<form wire:submit="submitForm" class=" flex justify-center">
    <div class="w-8/12 rounded border p-2">

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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                        {{ session('error') }}<a href="#" class="font-semibold underline hover:no-underline"></a>
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-border-2" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            РБ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Знак
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Видови, родови и службе
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Напомена
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if ($secondSigns)
                        @foreach ($secondSigns as $key => $value)
                            <tr wire:click="rowSelected({{ $value->id }})"
                                class=" border-b  cursor-pointer {{$selectedId==$value->id? 'bg-gray-300 hover:bg-gray-400':'bg-white '}} hover:bg-gray-100">
                                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $value->order}}.
                                </th>
                                <td class="px-6 py-2">
                                    {{ $value->sign }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $value->description }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $value->note}}
                                </td>
                            </tr>
                        @endforeach
                        
                    @endif
                </tbody>
            </table>
            <div>
                {{ $secondSigns->links('vendor.livewire.tailwind') }}
            </div>
        </div>


    </div>

    <div class="w-4/12 mx-2 rounded border p-2">
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="searchTerm"
                class="block w-full p-2.5 ps-10  text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Пронађи знак ...." />
        </div>
        <div>
            <div>
                <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Редни број</label>
                <input wire:model="form.order" type="text" id=""
                    class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
            </div>
            <div>
                @error('form.order')
                    <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="" class="block mt-2 mb-2  font-medium text-start">Ознака</label>
                <input wire:model="form.sign" type="text" id=""
                    class="block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ">
            </div>
            <div>
                @error('form.sign')
                    <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
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

            {{-- <label for="countries" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери скраћени
                назив</label>
            <select id="countries" wire:model="form.short_name"
                class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option selected>Изабери ...</option>
                <option value="Каталог ФМ">Каталог ФМ</option>
                <option value="Елементи ФМ">Елементи ФМ</option>
                <option value="Правилник ВЕС">Правилник ВЕС</option>
            </select>
            @error('form.short_name')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <label for="countries" class="block mb-2 mt-2  text-sm font-medium text-left">Да ли је пропис
                активан?</label>
            <select id="countries" wire:model="form.valid"
                class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="1">Да</option>
                <option value="0">Не</option>
            </select>
            @error('form.valid')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror --}}
            <div class="flex justify-between">
                {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    ознаку </button> --}}
                    <button wire:click.prevent="confirmDelete" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        ознаку </button>
                <button wire:click="cleanTable()" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    унос</button>
                <button type="submit"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4">Унеси</button>
            </div>

        </div> 
</form>
{{-- <div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 ">Да ли сте сигурни да желите да
                    обршите ознаку?</h3>
              <button data-modal-hide="popup-modal" type="button"
                    wire:click="removeRow({{ $form->id }})"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Да, јесам
                </button> 
                <button data-modal-hide="popup-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Не,
                    откажи</button>
            </div>
        </div>
    </div>
    
</div> --}}
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
