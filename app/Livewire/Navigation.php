<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Routing\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public $activeTab = ''; // Početni tab može biti 'home'
    public $cartItems = 1; 

     public function mount()
    {
       //dd(request()->route()->getName());
        $this->setActiveTab(request()->route()->getName());
    } 

    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }
    
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    #[On('cart-items')]
    public function cartItems($cartItems)
    {
        
        $this->cartItems=$cartItems;
       // dd($this->$cartItems);
    }


    public function render()
    {
        return view('livewire.navigation');
    }
}
