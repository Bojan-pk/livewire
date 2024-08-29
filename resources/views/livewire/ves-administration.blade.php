<div class="w-10/12  text-sm font-medium text-center justify-center text-gray-500 border-b border-gray-200">
    <h1 class=" text-2xl text-red-700">Преглед знакова за одређивање специјалности</h1>
    <ul class="flex flex-wrap -mb-px ">
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('firstSign')" data-tooltip-target="firstSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'firstSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Први знак
            </a>
            <div id="firstSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Категорија кадра
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('secondSign')" data-tooltip-target="secondSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'secondSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Други знак
            </a>
            <div id="secondSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Вид, род, служба или врсте и специјалности које се не разврставају у оквиру рода-службе
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('thirdSign')" data-tooltip-target="thirdSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'thirdSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Трећи знак
            </a>
            <div id="thirdSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Врста
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('fourthSign')" data-tooltip-target="fourthSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'fourthSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Четврти знак
            </a>
            <div id="fourthSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Специјалност
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('fifthSign')" data-tooltip-target="fifthSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'fifthSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Пети знак
            </a>
            <div id="fifthSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Школовање, усавршавање, односно оспособљавање
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('vesCondition')" data-tooltip-target="vesCondition"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'vesCondition' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Услови ВЕС
            </a>
            <div id="vesCondition" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Услови за одређивање ВЕС
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
    </ul>
    <div class="tab-content">
        @if ($currentTab == 'firstSign')
            @livewire('ves.first-sign')
        @elseif($currentTab == 'secondSign')
            @livewire('ves.second-sign')
        @elseif($currentTab == 'thirdSign')
            @livewire('ves.third-sign')
        @elseif($currentTab == 'fourthSign')
            @livewire('ves.fourth-sign')
        @elseif($currentTab == 'fifthSign')
            @livewire('ves.fifth-sign')
        @elseif($currentTab == 'vesCondition')
            @livewire('ves.ves-condition')
        @endif
    </div>
</div>
