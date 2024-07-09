<?php

namespace App\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;
use PHPUnit\Framework\Attributes\Ticket;

class Tickets extends Component
{

    public $active;

    protected $listeners=[
        'ticketSelected'=>'ticketSelected'
    ];

    public function ticketSelected($ticketId) 
    {
        $this->active=$ticketId;
    }
   
    public function render()
    {
        return view('livewire.tickets', [
            'tickets'=>SupportTicket::all()
        ]);
    }
}
