<div>
   
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Формацијско место
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
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
            
                @if($directions)
               
                @foreach ($directions as $fm=>$direction)
                <tr class="bg-white border-b {{$selectedFm==$fm?'bg-red-500 text-white':''}}" wire:click="fmSelected('{{$fm}}')">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$fm}}
                    </th>
                    <td class="px-6 py-4">
                        @if ($direction['jobs'])
                        @foreach ($direction['jobs'] as $jobId)
                        {{ App\Models\Job::find($jobId)->name }}
                        
                        <a href="#" class=" text-red-700" wire:click="$dispatch('saveJobs', [{{$jobId}}])">x</a>

                        @endforeach
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" wire:click="delFm('{{$fm}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline">X</a>
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