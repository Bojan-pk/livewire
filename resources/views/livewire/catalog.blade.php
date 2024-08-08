<div class="w-10/12  justify-center">

    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center">Katalog radnih mesta</h1>
        <div class="relative mr-2 w-1/4">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="searchTerm"
                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Пронађи формацијско место ...." />
        </div>
    </div>
    <div class="flex mt-4">
        <div class="w-7/12 rounded border p-2">
            <h1 class=" text-l font-medium mb-2 text-blue-600">Формацијско место: <span class=" text-gray-500">
                    {{ @$catalog->fm->name }}</span> </h1>

            <div id="accordion-collapse" data-accordion="collapse">
                <h2 id="tipicni_poslovi">
                    <button type="button"
                        class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-green-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200   hover:bg-green-50  gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                        aria-controls="accordion-collapse-body-1">
                        <span>Типични послови </span>

                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="{{ $activeColapse == 'jobs' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-1">
                    @if ($catalog)
                        @foreach ($catalog->jobs as $item)
                            <div class="p-1 border border-b-0 border-gray-200 flex  justify-between">
                                <p class="mb-1 text-gray-500">{{ $item->name }}</p>

                                @if (in_array($item->id, $jobsIds))
                                    <a href="#" wire:click="$dispatch('saveJobs', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            Izabrano
                                        </span>
                                    </a>
                                @else
                                    <a href="#" wire:click="$dispatch('saveJobs', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            Izaberi
                                        </span>
                                    </a>
                                @endif

                            </div>
                        @endforeach
                    @endif
                </div>

                <h2 id="accordion-collapse-heading-3">
                    <button type="button"
                        class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-green-500  border border-gray-200 focus:ring-4 focus:ring-gray-200   hover:bg-green-50 gap-3"
                        data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                        aria-controls="accordion-collapse-body-3">
                        <span>Образовање/усавршавање </span>

                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-3" class="{{ $activeColapse == 'education' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-3">
                    @if ($catalog)
                        @foreach ($catalog->educations as $item)
                            <div class="p-1 border border-b-0 border-gray-200 flex  justify-between">
                                <p class="mb-1 text-gray-500">{{ $item->name }}</p>
                                @if (in_array($item->id, $educationIds))
                                    <a href="#" wire:click="$dispatch('saveEducations', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            Izabrano
                                        </span>
                                    </a>
                                @else
                                    <a href="#" wire:click="$dispatch('saveEducations', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            Izaberi
                                        </span>
                                    </a>
                                @endif

                            </div>
                        @endforeach
                    @endif
                </div>
                <h2 id="accordion-collapse-heading-4">
                    <button type="button"
                        class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-green-500  border border-gray-200 focus:ring-4 focus:ring-gray-200   hover:bg-green-50 gap-3"
                        data-accordion-target="#accordion-collapse-body-4" aria-expanded="false"
                        aria-controls="accordion-collapse-body-4">
                        <span>Посебни услови за обављање формацијских места</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-4" class="{{ $activeColapse == 'condition' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-4">
                    @if ($catalog)
                        @foreach ($catalog->conditions as $item)
                            <div class="p-1 border border-b-0 border-gray-200 flex  justify-between">
                                <p class="mb-1 text-gray-500">{{ $item->name }}</p>
                                @if (in_array($item->id, $conditionIds))
                                    <a href="#" wire:click="$dispatch('saveConditions', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            Izabrano
                                        </span>
                                    </a>
                                @else
                                    <a href="#"
                                        wire:click="$dispatch('saveConditions', [{{ $item->id }}])">
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            Izaberi
                                        </span>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
                <h2 id="accordion-collapse-heading-5">
                    <button type="button"
                        class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-green-500  border border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-green-50 gap-3"
                        data-accordion-target="#accordion-collapse-body-5" aria-expanded="false"
                        aria-controls="accordion-collapse-body-5">
                        <span>Радно искуство </span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-5" class="{{ $activeColapse == 'experience' ? 'block' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-5">
                    @if ($catalog)
                        @foreach ($catalog->experiences as $item)
                        <div class="p-1 border border-b-0 border-gray-200 flex  justify-between">
                            <p class="mb-1 text-gray-500">{{ $item->name }} </p>
                            @if (in_array($item->id,$experienceIds))
                                <a href="#" wire:click="$dispatch('saveExperiences', [{{ $item->id }}])">
                                    <span
                                        class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                        Izabrano
                                    </span>
                                </a>
                            @else
                                <a href="#"
                                    wire:click="$dispatch('saveExperiences', [{{ $item->id }}])">
                                    <span
                                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                        Izaberi
                                    </span>
                                </a>
                            @endif
                        </div>
                        @endforeach
                    @endif
                </div>

                <h2 id="accordion-collapse-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-green-500  border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200   hover:bg-green-50 gap-3"
                        data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                        aria-controls="accordion-collapse-body-2">
                        <span>Најчешће систематизовани називи формацијских места </span>

                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-2" class="{{ $activeColapse == 'usualyFms' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-2">
                    @if ($catalog)
                        @foreach ($catalog->fms as $item)
                            <div class="p-1 border border-b-0 border-gray-200 flex  justify-between">
                                <p class="mb-1 text-gray-500">{{ $item->name }}</p>

                            </div>
                        @endforeach
                    @endif
                </div>



            </div>
        </div>
        <div class="w-5/12 mx-2 rounded border p-2">
            <h1 class=" text-xl font-medium mb-2">Formacijska mesta</h1>

            @if ($results)
                @foreach ($results as $result)
                    <p wire:click="fmSelected({{ $result->id }})"
                        class="mb-1 p-1.0 text-gray-700 border font-medium border-gray-300 rounded bg-gray-50 cursor-pointer {{ $activeFm == $result->id ? ' bg-green-200' : '' }}">
                        {{ $result->name }}
                    </p>
                @endforeach
            @endif

        </div>
    </div>

</div>
