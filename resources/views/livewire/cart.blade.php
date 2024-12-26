<div>
    <div class="relative overflow-x-auto">
        <!-- Header sa dugmetom -->
    <div class="flex justify-between items-center px-4 py-1 bg-gray-200 border-t border-gray-300">
        <svg class="w-6 h-6 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
          </svg>
          

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
            <a wire:click.prevent="validateRemoveData" href="#" {{-- data-modal-target="popup-modal" data-modal-toggle="popup-modal" --}}
                class="font-medium text-red-600 dark:text-red-500 hover:underline">Обриши
                податке</a>
        </div>


        <button wire:click="toggleCart" class="px-2 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-700">
            {!! $isMinimized ? '&uarr;' : '&darr;' !!}
        </button>

       
    </div>
    @if (!$isMinimized)
        <div class="p-1 overflow-y-auto max-h-[calc(100vh-100px)]">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        <tr  id="fm-row-{{ $index }}"{{-- id="{{ $selectedFm == $index ? 'selected-row' : '' }}" --}} class="border-b {{ $selectedFm == $index ? ' text-white bg-green-500' : 'bg-white ' }}"
                            wire:click="fmSelected('{{ $index }}')" wire:key="fm-{{ $index }}" >
                            <td class="px-6 py-1">
                                @if ($rb = $value['rb'])
                                    {{ $rb }}
                                @endif
                            </td>
                            <td scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input type="text" wire:model.defer="cart.{{ $index }}.newJobName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" />
                            </td>
                            <td class="px-6 py-1">
                                @if ($ves = $value['ves'])
                                    {{ $ves }}
                                    <a href="#" class=" text-red-700"
                                        wire:click="$dispatch('saveVes', ['{{ $ves }}',{{ $index }}])">x</a>
                                @endif
                            </td>
                            <td class="px-6 py-1">
                                @if ($value['jobs'])
                                    @foreach ($value['jobs'] as $jobId)
                                        {{ @App\Models\Job::find($jobId)->name }}
                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveJobs', [{{ $jobId }},{{ $index }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-1">
                                @if (@$value['conditions'])
                                    @foreach ($value['conditions'] as $conditionId)
                                        {{ App\Models\Condition::find($conditionId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveConditions', [{{ $conditionId }},{{ $index }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-1">
                                @if ($value['educations'])
                                    @foreach ($value['educations'] as $educationId)
                                        {{ App\Models\Education::find($educationId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click.prevent="$dispatch('saveEducations', [{{ $educationId }},{{ $index }}])">x</a>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-6 py-1">

                                @if ($value['experiences'])
                                    @foreach ($value['experiences'] as $experienceId)
                                        {{ App\Models\Experience::find($experienceId)->name }}

                                        <a href="#" class=" text-red-700"
                                            wire:click="$dispatch('saveExperiences', [{{ $experienceId }},{{ $index }}])">x</a>
                                    @endforeach
                                @endif

                            </td>
                            <td class="px-6 py-1">
                                @if ($rulebooksId = $value['rulebooks'])
                                    {{ @App\Models\Rulebook::find($rulebooksId)->fc_sso }}
                                    {{ @App\Models\Rulebook::find($rulebooksId)->pg_bb }}

                                    <a href="#" class=" text-red-700"
                                        wire:click="$dispatch('saveRulebooks', [{{ $rulebooksId }},{{ $index }}])">x</a>
                                @endif
                            </td>

                            <td class="px-6 py-1 text-right">
                                <a href="#" wire:click="delFm('{{ $index }}')"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">X</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @endif
    </div>
    </div>

    @if ($showRemoveModal)
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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"> Да ли сте сигурни да желите да обришете податке?</h3>
                    <button wire:click.prevent="removeInput"
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
<script>
   
    Livewire.on('scrollToSelected', (index) => {
        // Dodajte kašnjenje pre nego što pokušate da skrolujete
        setTimeout(() => {
            const selectedRow = document.getElementById('fm-row-' + index); // Pronađite red pomoću indeksa
            if (selectedRow) {
                selectedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 100); // Dajte malo vremena da se stranica ažurira pre skrolovanja
    });

</script>
