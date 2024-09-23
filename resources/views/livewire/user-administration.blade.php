<div class="w-10/12  text-sm font-medium text-center justify-center text-gray-500 border-b border-gray-200">
    <h1 class=" text-2xl text-red-700">Корисници</h1>
    <ul class="flex flex-wrap -mb-px ">
        
        <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('update')" class="inline-block p-4 border-b-2 {{ $currentTab == 'update' ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Ажурирање
            </a>
        </li>
        {{-- <li class="me-2">
            <a href="#" wire:click.prevent="switchTab('guide')" class="inline-block p-4 border-b-2 {{ $currentTab == 'guide' ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 ' }}">
                Упутство
            </a>
        </li> --}}
    </ul>
    <div class="tab-content">
        @if($currentTab == 'update')
        @livewire('user-update')
        {{-- @elseif($currentTab == 'manual')
        @livewire('rulebook-update') --}}
        @endif
    </div>
   
</div>
