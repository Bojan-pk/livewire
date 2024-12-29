{{-- flash-message.blade --}}
{{-- <div>
    @if (session()->has('success'))
        <div x-data="{ shown: true, timeout: null }" x-init="timeout = setTimeout(() => { shown = false }, 3000)" x-show.transition.out.opacity.duration.500ms="shown"
            style="display: none;" >
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('success') }}
              </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div id="alert-border-2" x-data="{ shown: true, timeout: null }" x-init="timeout = setTimeout(() => { shown = false }, 3000)" x-show.transition.out.opacity.duration.500ms="shown"
            style="display: none;"  >

            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session('error') }}
              </div>
        </div>
    @endif
</div> --}}


<div 
    x-data="{ shown: false, timeout: null, message: '', type: '' }" 
    x-init="
        $wire.on('flashMessage', (msg) => {
            console.log('Pre ažuriranja:', { shown, type, message });
            clearTimeout(timeout);
            type = msg[0];
            message = msg[1];
            shown = true;
            console.log('Posle ažuriranja:', { shown, type, message });
            timeout = setTimeout(() => { shown = false }, 3000);
        });
    " 
    x-show="shown" 
    x-transition:leave.opacity.duration.500ms 
    style="display: none;" 
    :class="{
        'fixed top-10 z-50 right-10 p-4 rounded shadow-lg': true,
        'bg-green-500 text-white': type === 'success',
        'bg-red-500 text-white': type === 'error'
    }"
>
    <span x-text="message"></span>
</div>




