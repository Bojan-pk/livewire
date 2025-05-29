<div>
    <form wire:submit="submitForm" class=" flex justify-center">

        <div class="w-7/12 rounded border p-2">

            <div>
                <x-flash-message />
            </div>
            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900">Формацијско
                место </label>
            <input wire:model="form.fm" type="text" id="helper-text" aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                placeholder="Унеси назив ФМ">
            <div>
                @error('form.fm')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <label for="helper-text" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Најчешће
                систематизовани називи формацијских места </label>
            @if ($form->usualy_fms)
            @foreach ($form->usualy_fms as $key => $value)
            <div class="flex items-center">
                <input wire:model="form.usualy_fms.{{ $key }}" type="text" id="helper-text"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                    placeholder="Унестите назив ФМ">
                <button wire:click="removeFm({{ $key }})" type="button"
                    class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center mx-1 my-1">x</button>
            </div>
            @error("form.usualy_fms.{$key}")
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            @endforeach

            <div class="flex items-start mb-2">
                <button wire:click="addFm()" type="button"
                    class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
            </div>
            @endif

            <label for="helper-text"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Образовање/усавршавање</label>
            @if ($form->educations)
            @foreach ($form->educations as $key => $value)
            <div class="flex items-center mb-0.5">
                <input wire:model="form.educations.{{ $key }}" type="text" id="helper-text"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 "
                    placeholder="Унестите образовање/усавршавање">
                <button wire:click="removeEducation({{ $key }})" type="button"
                    class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center mx-1 my-1">x</button>
            </div>
            @error("form.educations.{$key}")
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            @endforeach

            <div class="flex items-start mb-2">
                <button wire:click="addEducation()" type="button"
                    class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
            </div>
            @endif
            <div>
                @error('form.educations')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Посебни услови
                за
                обављање формацијских места (опционо)</label>
            @if ($form->conditions)
            @foreach ($form->conditions as $key => $value)
            <div class="flex items-center mb-0.5">
                <input wire:model="form.conditions.{{ $key }}" type="text" id="helper-text"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 "
                    placeholder="Унестите посебне услове">
                <button wire:click="removeCondition({{ $key }})" type="button"
                    class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center mx-1 my-1">x</button>
            </div>
            @endforeach
            <div class="flex items-start mb-2">
                <button wire:click="addCondition()" type="button"
                    class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
            </div>
            @endif
            <div>
                @error('form.conditions')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Радно искуство
                (опционо)</label>
            @if ($form->experiences)
            @foreach ($form->experiences as $key => $value)
            <div class="flex items-center mb-0.5">
                <input wire:model="form.experiences.{{ $key }}" type="text" id="helper-text"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 "
                    placeholder="Унеси потребно радно искуство">
                <button wire:click="removeExperience({{ $key }})" type="button"
                    class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center mx-1 my-1">x</button>
            </div>
            @endforeach
            <div class="flex items-start mb-2">
                <button wire:click="addExperience()" type="button"
                    class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
            </div>
            @endif
            <div>
                @error('form.experiences')
                <span class=" text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Типични
                послови</label>
            @if ($form->jobs)
            @foreach ($form->jobs as $key => $value)
            <div class="flex items-center mb-0.5">
                <input wire:model="form.jobs.{{ $key }}" type="text" id="helper-text"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                    placeholder="Унеси типичне послове">
                <button wire:click="removeJob({{ $key }})" type="button"
                    class="px-2 py-1   text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg  text-center mx-1 my-1">x</button>
            </div>
            @error("form.jobs.{$key}")
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            @endforeach
            <div class="flex items-start mb-2">
                <button wire:click="addJob()" type="button"
                    class="px-2 py-1 items-start  text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg  mx-1 my-1">+</button>
            </div>
            @endif
        </div>
        <div class="w-5/12 mx-2 rounded border p-2">

            @livewire('search-fm')
            <div class="flex items-center p-4 mb-4 mt-8 text-blue-800 rounded-lg bg-blue-50 " role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Обавештење!</span> Страна је намењена за измену каталога формацијских
                    места.
                    Пронађи формацијко место које желиш да измениш.
                </div>
            </div>

            <x-input-select name="form.regulation" label="Документ који је основ уноса" :options="$regulations"
                optionValue="id" :optionText="['short_name','svl']" />

            <div class="flex justify-between">
                <button wire:click.prevent="confirmDelete({{ $key }})"type="button" 
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    ФМ </button>
                <button wire:click="cleanCatalog()" type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-4">Обриши
                    форму</button>
                <button type="submit"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4">Унеси</button>
            </div>
    </form>
    <!-- Modal -->
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
                            желите да обришете ФМ из каталога?</h3>
                        <button wire:click.prevent="removeCatalog({{$form->catalogId}})"
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