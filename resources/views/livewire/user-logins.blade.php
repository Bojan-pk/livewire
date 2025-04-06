

<div  class=" flex justify-center">
    <div class="w-10/12 rounded border p-2">

        <x-flash-message/>

        <div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700  bg-gray-50 ">
                    <tr>
                        <th class="border  px-4 py-2">Корисник</th>
                        <th class="border  px-4 py-2">Е-маил</th>
                        <th class="border  px-4 py-2">Датум логовања</th>
                        <th class="border  px-4 py-2">IP адреса</th>
                        <th class="border  px-4 py-2">Прегледач</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logins as $login)
                        <tr>
                            <td class="border  px-4 py-2">{{ $login->name }}</td>
                            <td class="border  px-4 py-2">{{ $login->email }}</td>
                            <td class="border  px-4 py-2">{{ $login->login_at }}</td>
                            <td class="border  px-4 py-2">{{ $login->ip_address }}</td>
                            <td class="border  px-4 py-2"><span title="{{ $login->user_agent }}">Види ...</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
            <div class="mt-4">
                {{ $logins->links('vendor.livewire.tailwind') }}
            </div>
        </div>

    </div>

    <div class="w-2/12 mx-2 rounded border p-2">
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="searchTerm"
                class="block w-full p-2.5 ps-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Претражи ...." />
        </div>
        
</div

