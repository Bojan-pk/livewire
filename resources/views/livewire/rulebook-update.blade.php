<form wire:submit="submitForm" class=" flex justify-center">
   <div class="w-9/12 rounded border p-2">

      <div>
         @if (session()->has('success'))
         <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
               <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
               {{ session('success') }} <a href="#" class="font-semibold underline hover:no-underline"></a>
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-3" aria-label="Close">
               <span class="sr-only">Dismiss</span>
               <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
               </svg>
            </button>
         </div>
         @endif
         @if (session()->has('error'))
         <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
               <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
               {{ session('error') }}<a href="#" class="font-semibold underline hover:no-underline"></a>
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-2" aria-label="Close">
               <span class="sr-only">Dismiss</span>
               <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
               </svg>
            </button>
         </div>
         @endif
      </div>
      <div class="flex">
         <div class="w-2/12">
            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900">Табела бр.
            </label>
            <input wire:model="form.table_rb" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" placeholder="Унеси РБ">
            <div>
               @error('form.table_rb')
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="w-10/12 ml-3">
            <label for="table_name" class="block mb-2 text-sm font-medium text-gray-900">Назив табеле
      </label>
            <input wire:model="form.table_name" type="text" id="table_name" aria-describedby="table_name-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" placeholder="Унеси назив табеле">
            <div>
               @error('form.table_name')
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
      </div>
      <label for="helper-text" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Елементи табеле </label>
      <div class="flex items-start mb-2">
      <label for="helper-text" class="w-1/12 block mb-2 text-sm font-medium text-gray-900">РБ</label>
      <label for="helper-text" class="ml-2 w-4/12 block mb-2 text-sm font-medium text-gray-900">Назив РМ</label>
      <label for="helper-text" class="ml-2 w-2/12 block mb-2 text-sm font-medium text-gray-900">ФЧ/ССО</label>
      <label for="helper-text" class="ml-2 w-1/12 block mb-2 text-sm font-medium text-gray-900">ПГ/ББ</label>
      <label for="helper-text" class="ml-2 w-3/12 block mb-2 text-sm font-medium text-gray-900">НАПОМЕНА</label>
      <label for="helper-text" class=" w-1/12 block mb-2 text-sm font-medium text-gray-900"></label>
      </div>
      
      @if ($form->table_items)
      @foreach ($form->table_items as $key => $value)
      <div class="flex items-start mb-1">
      <div class="w-1/12">
            <input wire:model="form.table_items.{{$key}}.rb" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" placeholder="РБ">
            <div>
           
               @error("form.table_items.{$key}.rb")
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
              
            </div>
         </div>
         <div class="w-4/12 ml-2">
            <input wire:model="form.table_items.{{$key}}.fm" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" placeholder="Унеси назив РМ">
            <div>
               @error("form.table_items.{$key}.fm")
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="w-2/12 ml-2">
            <input wire:model="form.table_items.{{$key}}.fc_sso" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" placeholder="фч/ссо">
            <div>
               @error("form.table_items.{$key}.fc_sso")
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="w-1/12 ml-2">
            <input wire:model="form.table_items.{{$key}}.pg_bb" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" placeholder="пг/бб">
            <div>
               @error("form.table_items.{$key}.pg_bb")
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="w-3/12 ml-2">
            <input wire:model="form.table_items.{{$key}}.note" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5" placeholder="Напомена">
            <div>
               @error("form.table_items.{$key}.note")
               <span class=" text-red-500 text-xs">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="w-1/12">
         <button wire:click="removeTableRow({{ $key }})" type="button" class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center  my-1">x</button>
         </div>

         </div>
      @endforeach
      <div>
         @error('form.table_items')
         <span class=" text-red-500 text-xs">{{ $message }} </span>
         @enderror
      </div>
      <div class="flex items-start mb-2">
         <button wire:click="addTableRow()" type="button" class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
      </div>
      @endif
   </div>

   <div class="w-3/12 mx-2 rounded border p-2">
      <!-- <label for="regulations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пронађи
            формацијско место</label> -->
      @livewire('search-table')
      <div class="flex items-center p-4 mb-4 mt-8 text-blue-800 rounded-lg bg-blue-50 " role="alert">
         <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
         </svg>
         <span class="sr-only">Info</span>
         <div>
            <span class="font-medium">Обавештење!</span> Страна је намењена за измену каталога формацијских
            места.
            Пронађи формацијко место које желиш да измениш.
         </div>
      </div>

      <label for="regulations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Документ
         који је
         основ уноса</label>
      <select wire:model="form.regulation" id="regulations" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.0 ">
         <option>Изабери документ</option>
         @foreach ($regulations as $regulation)
         <option value="{{ $regulation }}">{{ $regulation }}</option>
         @endforeach
      </select>
      <div>
         @error('form.regulation')
         <span class=" text-red-500 text-xs">{{ $message }}</span>
         @enderror

         <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Или унеси
            нови</label>
         <input wire:model="form.new_regulation" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Унеси документ ако није на листи">
         <div>
            @error('form.new_regulation')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
         </div>
         <div class="flex justify-between">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши ФМ </button>
            <button wire:click="cleanTable()" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши унос</button>
            <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-4">Унеси</button>
         </div>

      </div>


</form>
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
   <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
         <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
         </button>
         <div class="p-4 md:p-5 text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Да ли сте сигурни да желите да обршите ФМ?</h3>
            <button data-modal-hide="popup-modal" type="button" wire:click="removeTable({{$form->table_id}})" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
               Да, јесам
            </button>
            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Не, откажи</button>
         </div>
      </div>
   </div>
</div>