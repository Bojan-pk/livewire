

@props(['name', 'label' => null, 'options' => [], 'optionValue' => 'id' /* 'optionText' => 'name' */, 'optionText' => []])

<div>
    @if($label)
        <label for="{{ $name }}" class="block mt-2 mb-2 text-sm font-medium text-start">{{ $label }}</label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" wire:model="{{ $name }}" {{ $attributes }} wire:change="$refresh"
    class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.0 ">
        <option selected value="">-- Изабери --</option>
        @foreach($options as $option)
            <option value="{{ $option[$optionValue] }}">
                @if(count($optionText) > 0)
                    {{ implode(' - ', array_map(fn($field) => $option[$field] ?? '', $optionText)) }}
                @endif 
            </option>
        @endforeach
    </select>

    <div>
        
            @error($name) <span class=" text-red-500 text-xs">{{ $message }}</span> @enderror
       
    </div>
</div>

