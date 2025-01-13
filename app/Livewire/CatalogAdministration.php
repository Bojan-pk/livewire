<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Administracija kataloga')]
#[Layout('components.layouts.admin')]
class CatalogAdministration extends Component
{

    public $currentTab = 'create'; // 'create' or 'update'

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }

    public function render()
    {
        return view('livewire.catalog-administration');
    }
}
