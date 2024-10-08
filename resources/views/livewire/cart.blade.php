<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                <tr class="border-b {{$selectedFm==$index?' text-white bg-green-500':'bg-white '}}" wire:click="fmSelected('{{$index}}')" >
                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white" >
                         <input type="text"  wire:model="cart.{{ $index }}.newJobName"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"  />
                    </th>
                    <td class="px-6 py-4">
                        @if ($ves=$value['ves']) 
                            {{$ves}}
                        <a href="#" class=" text-red-700" wire:click="$dispatch('saveVes', [{{$ves}}])">x</a>
                       
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
                        <a href="#" wire:click="delFm('{{$index}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline">X</a>
                    </td>
                </tr>
                @endforeach
                @endif
                <tr>
                    <td class="px-6 py-4 text-right">
                        <a href="#" wire:click="addFm" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Додај ФМ</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</div>