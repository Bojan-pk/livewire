<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Korisnici')]
#[Layout('components.layouts.admin')]

class ProfileAdministrator extends Component
{
    public function switchTab($tab)
    {
       // $this->currentTab = $tab;
    }
    
    public function render()
    {
        return view('livewire.profile-administrator');
    }
}
