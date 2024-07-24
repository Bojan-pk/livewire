<?php

namespace App\Livewire\Buttons;

use Livewire\Component;

class CopyButton extends Component
{

    public $copied = false;
   

    public function copy()
    {
        $this->copied = !$this->copied;
        
    }

    public function render()
    {
        return view('livewire.buttons.copy-button');
    }
}
