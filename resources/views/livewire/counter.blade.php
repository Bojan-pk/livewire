<div style="text-align:center">
<button wire:click="increment">+</button>
<p class='text-yellow-400'>{{ $count }}</p>
<button wire:click="decrement">-</button>
<input type="text" wire:model="count">

</div>
