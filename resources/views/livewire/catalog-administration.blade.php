
<div class="w-10/12  text-sm font-medium text-center justify-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <h1 class=" text-2xl text-red-700">Каталог формацијских места</h1>
    <ul class="flex flex-wrap -mb-px ">
        <li class="me-2">
            <a href="#" wire:click="switchTab('create')"  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 ">Унос</a>
        </li>
        <li class="me-2">
            <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Ажурирање</a>
        </li>
        <li class="me-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Упутство</a>
        </li>
    </ul>
    <div class="tab-content">
        @if($currentTab == 'create')
            @livewire('catalog-create')
        @elseif($currentTab == 'update')
            @livewire('catalog-update')
        @endif
    </div>
</div>

