<div>
    <h1 class=" text-3xl">Tickets</h1>
    
    @foreach ($tickets as $ticket)
    <div class=" rounded border shadow p-3 my-2 {{$active==$ticket->id?' bg-green-200':''}}" wire:click="$dispatch('ticketSelected',[{{$ticket->id}}])">
        
        <p class=" text-gray-500">{{ $ticket->question }}</p>
       
    </div>
    @endforeach
</div>