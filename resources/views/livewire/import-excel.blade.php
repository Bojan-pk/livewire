<div>
   

    <form wire:submit.prevent="import">
        <input type="file" wire:model="excelFile">
        
        @error('excelFile') <span class="error">{{ $message }}</span> @enderror
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Učitaj</button>
    </form>
</div>

