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
      class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Промени</button>
      <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
      class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши унос</button>
      <hr>
      <button wire:click="exportToWord" type="button"
      class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Пребаци у Word</button>
      
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
                <button data-modal-hide="popup-modal" type="button"
                     wire:click="removeInput" 
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