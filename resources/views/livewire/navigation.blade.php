<nav class="bg-white border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> --}}
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap">ДокОрг</span>
    </a>
    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="/" class="block py-2 px-3 md:p-0 {{ $activeTab == '' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}" aria-current="page" wire:navigate>Почетна страна</a>
        </li>
        <li>
          <a href="/ves" class="block py-2 px-3 md:p-0 {{ $activeTab == 'ves' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}" aria-current="page" wire:navigate>ВЕС/ЕС</a>
        </li>
      
        <li>
          <a href="/rulebook" class="block py-2 px-3 md:p-0 {{ $activeTab == 'rulebook' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}" aria-current="page" wire:navigate>Елементи ФМ</a>
        </li>
        
        <li>
          <a href="/catalog" class="block py-2 px-3 md:p-0 {{ $activeTab == 'catalog' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}" aria-current="page" wire:navigate>Каталог</a>
        </li>
        <li>
          <a href="/ves-conversion" class="block py-2 px-3 md:p-0 {{ $activeTab == 'ves-conversion' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}" aria-current="page" wire:navigate>Конверзија ВЕС/ЕС</a>
        </li>
        <li>
          <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto {{ $activeTab == 'catalog-administration' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}">Администрацијa <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg></button>
          <!-- Dropdown menu -->
          <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-70">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
              <li>
                <a href="/regulation-administration" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Унос Правне нормативе</a>
              </li>
              <li>
                <a href="/catalog-administration" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Унос каталога</a>
              </li>
              <li>
                <a href="/rulebook-administration" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Унос правилника о елементима</a>
              </li>
              <li>
                <a href="/ves-administration" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Унос ВЕС/ЕС</a>
              </li>
              <li>
                <a href="/user-administration" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Корисници</a>
              </li>
              
            </ul>
            
          </div>
        </li>
       {{--  <li>
          <a href="/search" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0" wire:navigate>Search</a>
        </li> --}}
        @if  (auth()->user())
        <li>
          <button id="administrationNavbarLink" data-dropdown-toggle="administration" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto "> {{ auth()->user()->name }}<svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg></button>
          <!-- Dropdown menu -->
          <div id="administration" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
              <li>
                <a href="{{route('profile')}}" class="block px-4 py-2 hover:bg-gray-100  " wire:navigate>Профил</a>
              </li>
            </ul>
            <div class="py-1">
              <a href="#" wire:click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Одјава</a>
            </div>
          </div>
        </li>
        @else 
        <li>
          <a href="/login" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0" wire:navigate>Prijava</a>
        </li>
        @endif
       
       
      </ul>
    </div>
  </div>
</nav>