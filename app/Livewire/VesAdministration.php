<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class VesAdministration extends Component
{
    public $currentTab = 'firstSign'; // 'create' or 'update'

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }

    public function render()
    {
        return view('livewire.ves-administration');
    }
}
