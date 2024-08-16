<form wire:submit="submitForm" class=" flex justify-center">
    <div class="w-8/12 rounded border p-2">

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            РБ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Назив
                        </th>
                        <th scope="col" class="px-6 py-3">
                            СВЛ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Скраћени назив
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Активан
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($regulations)
                        @foreach ($regulations as $key => $value)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key + 1 }}.
                                </th>
                                <td class="px-6 py-4">
                                    {{ $value->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $value->svl }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $value->short_name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($value->valid)
                                        Да
                                    @else
                                        Не
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        <div>
                            @error('form.table_items')
                                <span class=" text-red-500 text-xs">{{ $message }} </span>
                            @enderror
                        </div>
                    @endif
                </tbody>
            </table>
        </div>


    </div>

    <div class="w-4/12 mx-2 rounded border p-2">
             <div class="relative">
             <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live="searchTerm"  class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Пронађи пропис ...."  />
        </div>
        <div>
            <div>
                <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Назив прописа</label>
                <input wire:model="form.name" type="text" id=""
                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
            </div>
            <div>
                @error('form.name')
                    <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="" class="block mt-2 mb-2 text-sm font-medium text-start">Службени војни
                    лист</label>
                <input wire:model="form.svl" type="text" id=""
                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
            </div>
            <div>
                @error('form.svl')
                    <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <label for="countries" class="block mb-2 mt-2  text-sm font-medium text-left">Изабери скраћени назив</label>
            <select id="countries" wire:model="form.short_name"
                class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option selected>Изабери ...</option>
                <option value="Katalog FM">Katalog FM</option>
                <option value="Elementi FM">Elementi FM</option>
                <option value="Pravilnik VES">Pravilnik VES</option>
            </select>
            @error('form.short_name')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <label for="countries" class="block mb-2 mt-2  text-sm font-medium text-left">Да ли је пропис активан?</label>
            <select id="countries" wire:model="form.valid"
                class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="1">Да</option>
                <option value="0">Не</option>
            </select>
            @error('form.valid')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <div class="flex justify-between">
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    ФМ </button>
                <button wire:click="cleanTable()" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    унос</button>
                <button type="submit"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4">Унеси</button>
            </div>

        </div>
</form>
<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Да ли сте сигурни да желите да
                    обршите ФМ?</h3>
                {{-- <button data-modal-hide="popup-modal" type="button" wire:click="removeTable({{ $form->table_id }})"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Да, јесам
                </button> --}}
                <button data-modal-hide="popup-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Не,
                    откажи</button>
            </div>
        </div>
    </div>
</div>
