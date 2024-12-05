<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Zapamćeno administracija')]
#[Layout('components.layouts.admin')]
class RememberdAdministration extends Component
{
    public $currentTab = 'update'; 

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }

    public function render()
    {
        return view('livewire.rememberd-administration');
    }
}
