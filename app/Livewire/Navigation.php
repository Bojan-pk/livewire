<?php

namespace App\Livewire;

use Illuminate\Routing\Route;
use Livewire\Component;

class Navigation extends Component
{
    public $activeTab = ''; // Početni tab može biti 'home'

     public function mount()
    {
       //dd(request()->route()->getName());
        $this->setActiveTab(request()->route()->getName());
    } 

    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
       
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
