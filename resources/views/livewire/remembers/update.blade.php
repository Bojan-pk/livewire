<div>

  <form wire:submit.prevent="submitForm" class=" flex justify-center">
    <div class="w-10/12 rounded border p-2">
      <x-flash-message />
      <div class="relative overflow-x-auto">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-xs text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
              @if($cart)
              @foreach ($cart as $index=>$value)
              <tr class="border-b {{$selectedFm==$index?'bg-gray-300 hover:bg-gray-400' : 'bg-white '}}"
                wire:click="fmSelected('{{$index}}')">
                <td class="px-6 py-4">
                  @if ($rb=$value['rb'])
                  {{$rb}}
                  @endif
                </td>
                <td scope="row" class="px-6 py-2 ">
                  
                  @if ($newJobName=$value['newJobName'])
                  {{$newJobName}}
                  @endif
                  
                </td>
                <td class="px-6 py-4">
                  @if ($ves=$value['ves'])
                  {{$ves}}
                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveVes', ['{{$ves}}'])">x</a>

                  @endif
                </td>
                <td class="px-6 py-4">
                  @if ($value['jobs'])
                  @foreach ($value['jobs'] as $jobId)
                  {{ @App\Models\Job::find($jobId)->name }}
                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveJobs', [{{$jobId}}])">x</a>
                  @endforeach
                  @endif
                </td>
                <td class="px-6 py-4">
                  @if (@$value['conditions'])
                  @foreach ($value['conditions'] as $conditionId)
                  {{ App\Models\Condition::find($conditionId)->name }}

                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveConditions', [{{$conditionId}}])">x</a>

                  @endforeach
                  @endif
                </td>
                <td class="px-6 py-4">
                  @if ($value['educations'])
                  @foreach ($value['educations'] as $educationId)
                  {{ App\Models\Education::find($educationId)->name }}

                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveEducations', [{{$educationId}}])">x</a>

                  @endforeach
                  @endif
                </td>
                <td class="px-6 py-4">

                  @if ($value['experiences'])
                  @foreach ($value['experiences'] as $experienceId)
                  {{ App\Models\Experience::find($experienceId)->name }}

                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveExperiences', [{{$experienceId}}])">x</a>
                  @endforeach
                  @endif

                </td>
                <td class="px-6 py-4">
                  @if ($rulebooksId=$value['rulebooks'])

                  {{@App\Models\Rulebook::find($rulebooksId)->fc_sso }}
                  {{ @App\Models\Rulebook::find($rulebooksId)->pg_bb }}

                  <a href="#" class=" text-red-700" wire:click="$dispatch('saveRulebooks', [{{$rulebooksId}}])">x</a>

                  @endif
                </td>

                <td class="px-6 py-4 text-right">
                  <a href="#" wire:click="delFm('{{$index}}')"
                    class="font-medium text-red-600 dark:text-red-500 hover:underline">X</a>
                </td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td class="px-6 py-4 text-right">
                  <a href="#" wire:click="addFm"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Додај ФМ</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div>
          {{-- {{ $firstSigns->links('vendor.livewire.tailwind') }} --}}
        </div>
      </div>
    </div>
    <div class="w-2/12 mx-2 rounded border p-2">
      
      <x-input-text name="rb" label="Редни број" />
      <x-input-text name="newJobName" label="формацијско место" />
      <button wire:click.prevent="editItem" type="button"
      class="inline-flex items-center justify-center w-40 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Промени</button>
      <button wire:click.prevent="validateRemoveData"  type="button"
      class="inline-flex items-center justify-center w-40 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши податке</button>
      <hr>
      <label for="medium-range" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Преузимања</label>
      <button wire:click="exportToWord" type="button"
      class="inline-flex items-center justify-center w-40 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">
    Упутство 
    <svg class="w-6 h-6 ms-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1.02 4.804a1 1 0 1 0-1.96.392l1 5a1 1 0 0 0 1.838.319L12 15.61l1.143 1.905a1 1 0 0 0 1.838-.319l1-5a1 1 0 0 0-1.962-.392l-.492 2.463-.67-1.115a1 1 0 0 0-1.714 0l-.67 1.116-.492-2.464Z" clip-rule="evenodd"/>
    </svg>
</button>

<button wire:click="exportToExcel" type="button"
      class="inline-flex items-center justify-center w-40 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">
    Формација 
    <svg class="w-6 h-6 ms-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M3 3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3Zm16 0H5v18h14V3ZM7.5 7a.75.75 0 0 1 1.28-.53L10 7.94l1.22-1.47a.75.75 0 1 1 1.16.96L11.25 9l1.13 1.41a.75.75 0 1 1-1.16.96L10 10.06l-1.22 1.47a.75.75 0 1 1-1.16-.96L8.75 9 7.62 7.59A.75.75 0 0 1 7.5 7Z" clip-rule="evenodd" />
    </svg>
</button>   
</div>
@if ($showRemoveModal)
<!-- Modal Background Overlay -->
<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <!-- Modal Content -->
    <div class="relative w-full max-w-md mx-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" wire:click.prevent="closeModal"
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
                <button wire:click.prevent="closeModal"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Не, откажи
                </button>
            </div>
        </div>
    </div>
</div>
@endif
