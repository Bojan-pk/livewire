<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class RegulationAdministration extends Component
{
    
    public $currentTab = 'update'; // 'create' or 'update'

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }
    
    
    public function render()
    {
        
        return view('livewire.regulation-administration');
    }
}
