<form wire:submit="submitForm" class=" flex justify-center">
    <div class="w-7/12 rounded border p-2">

        <div>
            <x-flash-message />
            
        </div>
        <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Формацијско
            место</label>
        <input wire:model="form.fm" type="text" id="helper-text" aria-describedby="helper-text-explanation"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унеси назив формацијског места">
        <div>
            @error('form.fm')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Најчешће
            систематизовани називи формацијских места</label>
        <input wire:model="form.usualy_fms" type="text" id="helper-text" aria-describedby="helper-text-explanation"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унестите називе формацијких места и одвојити их са ;">
        <div>
            @error('form.usualy_fms')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <label for="message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Образовање/усавршавање</label>
        <textarea wire:model="form.educations" id="message" rows="1"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унестите образовање/усавршавање и одвојити их са;"></textarea>
        <div>
            @error('form.educations')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Посебни услови за
            обављање формацијских места (опционо)</label>
        <textarea wire:model="form.conditions" id="message" rows="2"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унестите посебне услове и одвојити их са ;"></textarea>
        <div>
            @error('form.conditions')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Радно искуство
            (опционо)</label>
        <input wire:model="form.experiences" type="text" id="helper-text" aria-describedby="helper-text-explanation"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унеси потребно радно искуство">
        <div>
            @error('form.experiences')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Типични
            послови</label>
        <textarea id="message" wire:model="form.jobs" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Унестите посебне услове и одвојити их са ;"></textarea>
        <div>
            @error('form.jobs')
            <span class=" text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="w-5/12 mx-2 rounded border p-2">
        <div class="flex items-center p-4 mb-4  text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Упозорење!</span> Страна је намењена за унос каталога формацијских места.
                Обавезно да у колонама где постоји унос више послова, формацијских места, образовања/усавршавања или
                посебних услова, целине одвојите са тачка зарезом.
            </div>
        </div>
       
        <x-input-select name="form.regulation" label="Документ који је основ уноса" :options="$regulations"
            optionValue="id" :optionText="['short_name','svl']" />
        
            <button type="submit"
            class=" float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4">Унеси</button>
    </div>
</form>