<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        РБ
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Формацијско место
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ВЕС/ЕС
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Послови
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Посебни Услови
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Потребно уасвршавање
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Радно искуство
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Елементи ФМ
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Бриши</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($cart)
                    @foreach ($cart as $index => $value)
                        <tr class="border-b {{ $selectedFm == $index ? ' text-white bg-green-500' : 'bg-white ' }}"
                            wire:click="fmSelected('{{ $index }}')">
                            <td class="px-6 py-4">
                                @if ($rb = $value['rb'])
                                    {{ $rb }}
                                @endif
                            </td>
                            <td scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input type="text" wire:model="cart.{{ $index }}.newJobName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" />
                            </td>
                            <td class="px-6 py-4">
                                @if ($ves = $value['ves'])
                                    {{ $ves }}
                                    <a href="#" class=" text-red-700"
                                        wire:click="$dispatch('saveVes', ['{{ $ves }}'])">x</a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($value['jobs'])
                                    @foreach ($value['jobs'] as $jobId)
                                        {{ @App\Models\Job::find($jobId)->name }}
                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveJobs', [{{ $jobId }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if (@$value['conditions'])
                                    @foreach ($value['conditions'] as $conditionId)
                                        {{ App\Models\Condition::find($conditionId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveConditions', [{{ $conditionId }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($value['educations'])
                                    @foreach ($value['educations'] as $educationId)
                                        {{ App\Models\Education::find($educationId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveEducations', [{{ $educationId }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-4">

                                @if ($value['experiences'])
                                    @foreach ($value['experiences'] as $experienceId)
                                        {{ App\Models\Experience::find($experienceId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveExperiences', [{{ $experienceId }}])">x</a>
                                    @endforeach
                                @endif

                            </td>
                            <td class="px-6 py-4">
                                @if ($rulebooksId = $value['rulebooks'])
                                    {{ @App\Models\Rulebook::find($rulebooksId)->fc_sso }}
                                    {{ @App\Models\Rulebook::find($rulebooksId)->pg_bb }}

                                    <a href="#" class=" text-red-700"
                                        wire:click="$dispatch('saveRulebooks', [{{ $rulebooksId }}])">x</a>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="#" wire:click="delFm('{{ $index }}')"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">X</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="8" class="px-6 py-4">
                        <div class=" flex justify-between">
                            <!-- Елемент крајње лево -->
                            <div class="text-left">
                                <a href="#" wire:click="addFm"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Додај ФМ</a>
                            </div>
                            <div class="text-left">
                                <a href="{{ route('rememberd-administration',['tab'=>'save-cart']) }}" wire:navigate
                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Сними</a>
                            </div>

                            <!-- Елемент крајње десно -->
                            <div class="text-right">
                                <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Обриши
                                    податке</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="popup-modal" tabindex="-1"
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
                        обришите унос?</h3>
                    <button data-modal-hide="popup-modal" type="button" wire:click="removeInput"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Да, јесам
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Не,
                        откажи</button>
                </div>
            </div>
        </div>
    </div>
</div>
