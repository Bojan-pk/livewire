<div class="w-10/12  justify-center">
    <div class="flex justify-between">
        <h1 class="text-xl font-medium mb-2 text-center"> Конверзија раније утврђених ВЕС/ЕС са новим</h1>


    </div>

    <div class="flex mt-4">
        <div class="w-6/12 rounded border p-2">
            <h1 class=" text-l font-semibold mb-2 text-blue-600">Раније утврђени ВЕС/ЕС<span class=" text-gray-500">
                </span> </h1>

            <div class="max-w-sm ">
                <p id="helper-text-explanation" class="my-2 text-sm font-semibold text-gray-500 dark:text-gray-400">
                    Унесите стари
                    ВЕС/ЕС.</p>
                <div class="flex mb-2 space-x-2 rtl:space-x-reverse">

                    <div>
                        <label for="code-1" class="sr-only">First code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-next="code-2"
                            autocomplete="off" wire:model="code1" id="code-1"
                            class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-2" class="sr-only">Second code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-1"
                            autocomplete="off" wire:model="code2" data-focus-input-next="code-3" id="code-2"
                            class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-3" class="sr-only">Third code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-2"
                            autocomplete="off" data-focus-input-next="code-4" id="code-3" wire:model="code3"
                            class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-4" class="sr-only">Fourth code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-3"
                            autocomplete="off" data-focus-input-next="code-5" id="code-4" wire:model="code4"
                            class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <div>
                        <label for="code-5" class="sr-only">Fifth code</label>
                        <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-4"
                            autocomplete="off" wire:keyup="$refresh" data-focus-input-next="code-6" id="code-5"
                            wire:model="code5"
                            class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                            required />
                    </div>
                    <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2" wire:click="cleanCode">X</button>

                </div>
                @if (session()->has('error'))
                    <p class=" text-red-500 text-xs">{{ session('error') }}</p>
                @endif
                @if ($ves_conditions)
                    @foreach (@$ves_conditions as $value)
                        <p><b>{{ $value->old_kind ? 'Род (служба) или област:' : '' }} </b></p>
                        <p class=" text-gray-500">{{ $value->old_kind }}</p>
                        <p><b>{{ $value->old_condition ? 'Услови за одређивање:' : '' }} </b></p>
                        <p class=" text-gray-500">{{ $value->old_condition }}</p>
                        <p><b>{{ $value->old_alternative ? 'Може се попуњавати:' : '' }} </b></p>
                        <p class=" text-gray-500">{{ $value->old_alternative }}</p>
                    @endforeach
                @endif
            </div>



        </div>

        <div class="w-6/12 mx-2 rounded border p-2">
            <h1 class=" text-l font-medium mb-2 text-blue-600">Нови ВЕС/ЕС<span class=" text-gray-500">
                </span> </h1>
            @if ($ves_conditions)
                @foreach (@$ves_conditions as $value)
                    <p class=" text-lg"><b>{{ $value->ves }}</b></p>
                    <p class=" text-gray-500">{{ $value->reading }}</p>
                    <p><b>Услови за одређивање:</b></p>
                    <p class=" text-gray-500">{{ $value->condition }}</p>
                    <p><b>{{ $value->alternative ? 'Може се попуњавати:' : '' }} </b></p>
                    <p class=" text-gray-500">{{ $value->alternative }}</p>
                @endforeach
            @endif
            {{-- <hr class="h-px my-8 bg-gray-200 border-2"> --}}
        </div>
    </div>
   
    <script>
        // use this simple function to automatically focus on the next input
        function focusNextInput(el, prevId, nextId) {
            if (el.value.length === 0) {
                if (prevId) {
                    document.getElementById(prevId).focus();
                }
            } else {
                if (nextId) {
                    document.getElementById(nextId).focus();
                }
            }
        }

        document.querySelectorAll('[data-focus-input-init]').forEach(function(element) {
            element.addEventListener('keyup', function() {
                const prevId = this.getAttribute('data-focus-input-prev');
                const nextId = this.getAttribute('data-focus-input-next');
                focusNextInput(this, prevId, nextId);
            });
        });
        
        document.addEventListener('livewire:init', () => {
       Livewire.on('setFocus', (event) => {
        // Hvatamo emitovani događaj 'setFocus'
        document.getElementById('code-1').focus();
       });
    });

       /*  document.addEventListener('livewire:load', function () {
            alert('dispach');
            
            Livewire.on('setFocus', () => {
                document.getElementById('code-1').focus();
            });
        }); */
    
    </script>
    
</div>
