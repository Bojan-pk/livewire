<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Korisnici')]
#[Layout('components.layouts.admin')]
class UserAdministration extends Component

{
    public $currentTab = 'update'; // 'create' or 'update'
    public function render()
    {
        return view('livewire.user-administration');
    }
}
