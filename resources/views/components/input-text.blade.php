
@props(['name', 'label' => null])

<div>
    @if($label)
        <label for="{{ $name }}" class="block mt-2 mb-2  font-medium text-start">{{ $label }}</label>
    @endif

    <input type="text" name="{{ $name }}" wire:model="{{ $name }}"  {{ $attributes->merge(['class' => 'block w-full p-2.5 text-gray-500 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 ']) }}>

    <div>
        @error($name) <span class=" text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
</div>

