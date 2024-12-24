<div class="w-10/12  justify-center">
    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center">Каталог радних места</h1>

        <div class="relative flex items-center w-1/3">
            <!-- Select (dropdown) unutar pretrage -->
            <select wire:model.live="selectedCategory"
                class="block w-2/5 px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-400 rounded-l-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Све категорије</option>
                <option value="ПВЛ">ПВЛ</option>
                <option value="ЦЛ">ЦЛ</option>

            </select>

            <!-- Input za pretragu -->
            <input type="search" wire:model.live="searchTerm" autocomplete="off" id="search-dropdown"
                class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border-l-0  border border-gray-400 rounded-r-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Претрага формацијског места ..." />

            <!-- Dugme za pretragu -->
            <button type="button"
                class="absolute right-0 top-0 p-3 text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>



    </div>
    <div class="flex mt-4">
        <div class="w-8/12 rounded border p-2">
            <div class="flex  justify-between">
                <h1 class=" text-l font-medium mb-2 text-blue-600">Формацијско место: <span class=" text-gray-500">
                        {{ @$catalog->fm->name }}</span> </h1>

                @if (@$catalog->fm->name == $usualyFm)
                <a href="#" wire:click="$dispatch('saveUsualyFm', ['{{ $catalog->fm->name }}'])">
                    <span
                        class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                        Изабрано
                    </span>
                </a>
                @else
                <a href="#" wire:click="$dispatch('saveUsualyFm', ['{{ $catalog->fm->name }}'])">
                    <span
                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                        Изабери
                    </span>
                </a>
                @endif
            </div>




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
                    <div class="p-1 border border-b-0 text-sm border-gray-200 flex  justify-between">
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
                    <div class="p-1 border border-b-0 text-xs border-gray-200 flex  justify-between">
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
                    <div class="p-1 border border-b-0 text-xs border-gray-200 flex  justify-between">
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
                        <a href="#" wire:click="$dispatch('saveConditions', [{{ $item->id }}])">
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-5" class="{{ $activeColapse == 'experience' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-5">
                    @if ($catalog)
                    @foreach ($catalog->experiences as $item)
                    <div class="p-1 border border-b-0 text-xs border-gray-200 flex  justify-between">
                        <p class="mb-1 text-gray-500">{{ $item->name }} </p>
                        @if (in_array($item->id, $experienceIds))
                        <a href="#" wire:click="$dispatch('saveExperiences', [{{ $item->id }}])">
                            <span
                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                Изабрано
                            </span>
                        </a>
                        @else
                        <a href="#" wire:click="$dispatch('saveExperiences', [{{ $item->id }}])">
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                Изабери
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-2" class="{{ $activeColapse == 'usualyFms' ? 'block' : 'hidden' }}"
                    aria-labelledby="accordion-collapse-heading-2">
                    @if ($catalog)
                    @foreach ($catalog->fms as $item)
                    <div class="p-1 border border-b-0 text-xs border-gray-200 flex  justify-between">
                        <p class="mb-1 text-gray-500">{{ $item->name }}</p>

                        @if ($item->name== $usualyFm)
                        <a href="#" wire:click="$dispatch('saveUsualyFm', ['{{ $item->name }}'])">
                            <span
                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                Изабрано
                            </span>
                        </a>
                        @else
                        <a href="#" wire:click="$dispatch('saveUsualyFm', ['{{ $item->name }}'])">
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                Изабери
                            </span>
                        </a>
                        @endif
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="w-4/12 mx-2 rounded border p-2">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-sm text-gray-700  bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Формацијска места
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($fms)
                        @foreach ($fms as $result)
                        <tr :key="{{ $result->id }}" wire:click="fmSelected({{ $result->id }})"
                            class="  {{ $activeFm == $result->id ? 'bg-gray-300 hover:bg-gray-400' : 'bg-white hover:bg-gray-50' }} border-b  cursor-pointer">
                            <td scope="row" class="px-2 py-1  text-gray-900 whitespace-nowrap  ">
                                {!! $result->name !!}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pt-4">
                    {{ $fms->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>