<?php

namespace App\Livewire;

use Livewire\Component;

class CatalogAdministration extends Component
{

    public $currentTab = 'update'; // 'create' or 'update'

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }

    public function render()
    {
        return view('livewire.catalog-administration');
    }
}
