<div class="w-10/12  text-sm font-medium text-center justify-center text-gray-500 border-b border-gray-200">
    <h1 class=" text-2xl text-red-700">Преглед знакова за одређивање специјалности</h1>
    <ul class="flex flex-wrap -mb-px ">
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('firstSign')"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'firstSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Први знак
            </a>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('secondSign')"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'secondSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Други знак
            </a>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('thirdSign')"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'thirdSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Трећи знак
            </a>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('fourthSign')"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'fourthSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Четврти знак
            </a>
        </li>
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('fifthSign')"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'fifthSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Пети знак
            </a>
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
        @endif
    </div>
</div>
