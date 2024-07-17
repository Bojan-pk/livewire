<?php

namespace App\Livewire;

use Illuminate\Routing\Route;
use Livewire\Component;

class Navigation extends Component
{
    public $activeTab = 'home'; // Početni tab može biti 'home'

    public function mount()
    {
        $this->setActiveTabFromUrl();
    }

    public function setActiveTabFromUrl()
    {
        $this->activeTab = request()->route()->getName();
       // dd($this->activeTab);
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
