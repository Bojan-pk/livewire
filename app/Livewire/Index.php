<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Početna strana')]
#[Layout('components.layouts.admin')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.index');
    }
}
