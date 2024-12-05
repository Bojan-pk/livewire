<div class="w-10/12  text-sm font-medium text-center justify-center text-gray-500 border-b border-gray-200">
    <h1 class=" text-2xl text-red-700">Описи послова и елементи ФМ</h1>
    <ul class="flex flex-wrap -mb-px ">
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('firstSign')" data-tooltip-target="firstSign"
                class="inline-block p-4 border-b-2 {{ $currentTab == 'firstSign' ? 'text-blue-600 border-blue-600  ' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Ажурирање
            </a>
            <div id="firstSign" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Ажурирање фомацијских места
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </li>
        
    </ul>
    <div class="tab-content">
        @if ($currentTab == 'update')
            @livewire('remembers.update')
       {{--  @elseif($currentTab == 'secondSign')
            @livewire('ves.second-sign')
        @elseif($currentTab == 'thirdSign')
            @livewire('ves.third-sign')
        @elseif($currentTab == 'fourthSign')
            @livewire('ves.fourth-sign')
        @elseif($currentTab == 'fifthSign')
            @livewire('ves.fifth-sign')
        @elseif($currentTab == 'vesCondition')
            @livewire('ves.ves-condition') --}}
        @endif
    </div>
</div>

