<div>
    <form wire:submit="submitForm" class=" flex justify-center">
        <div class="w-7/12 rounded border p-2">

            <x-flash-message />

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                РБ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Назив података
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Снимљено
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Промењено
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($carts)
                            @foreach ($carts as $key => $value)
                                <tr wire:click="cartSelected({{ $value->id }})"
                                    class=" border-b cursor-pointer {{ $selectedId == $value->id ? 'bg-gray-300 hover:bg-gray-400' : 'bg-white ' }} ">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $key + 1 }}.
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $value->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $value->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $value->updated_at }}
                                    </td>

                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $carts->links('vendor.livewire.tailwind') }}
                </div>
            </div>

        </div>

        <div class="w-5/12 mx-2 rounded border p-2">
            {{--  <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="searchTerm"
                class="block w-full p-2.5 ps-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Корисника ...." />
        </div> --}}
            <div class="flex items-center p-4 mb-4 mt-8 text-blue-800 rounded-lg bg-blue-50 " role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Обавештење!</span> Страна је намењена снимање и учитавање изабраних
                    елемената формацијских места и описа послова.
                    За снимање упиши, или изабери назив под којим желиш да снимиш и кликни на Сними податке.
                    За учитавање изабери жељене снимљене податке и и притисни Учитај податке.
                    За брисање учитаних података притисни Обриши податке
                </div>
            </div>
            <div>
                <x-input-text name="name" label="Име фајла" />
                {{--  <x-input-text name="form.email" label="Е-маил"/>
            <x-input-text name="form.password" label="Лозинка"/> --}}

                {{-- <x-input-select name="form.role" label="Улога" :options="$roles"
                    optionValue="value" :optionText="['name']" /> --}}


                <div class="flex justify-between">
                    {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши корисника</button> --}}
                    <button wire:click="cleanTable()" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                        форму</button>
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        wire:click="validateLoadData"
                        
                        type="button"
                        class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Учитај податке</button>
                    {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">xxxxx
                        унос</button> --}}
                    <button type="submit"
                        class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4">Сними
                        податке</button>
                </div>

            </div>
    </form>
    @if ($showLoadModal)
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
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Већ учитани подаци биће обрисани.!!! Да ли сте сигурни да желите да учитате нове?</h3>
                    <button wire:click.prevent="loadData"
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
