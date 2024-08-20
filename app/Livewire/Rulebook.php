<?php

namespace App\Livewire;

use App\Models\RulebooksTable;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Elementi FM')]
class Rulebook extends Component
{
    public $searchTerm = '';
    public $rulebooksTable;

    public function mount()
    {
        $this->rulebooksTable = RulebooksTable::first();
    }

    public function render() 
    {
        return view('livewire.rulebook');
    }
}
