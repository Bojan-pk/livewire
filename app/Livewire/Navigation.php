<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Routing\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public $activeTab = ''; // Početni tab može biti 'home'
    public $cartItems; 
    public $cart=[];

     public function mount()
    {
       //dd(request()->route()->getName());
        $this->setActiveTab(request()->route()->getName());
        //$this->cartItems=0;
        $this-> cartItems();
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

    private function isValidCartItem($item)
    {
        // Provera za svaki ključ osim generičkog "newJobName"
        return 
            (!empty($item['newJobName'])&& $item['newJobName']!="Радно место ".$item['rb']) ||
            !empty($item['jobs']) || 
            !empty($item['educations']) || 
            !empty($item['conditions']) || 
            !empty($item['experiences']) || 
            !empty($item['rulebooks']) || 
            !empty($item['ves']);
    }
    
    public function countValidCartItems()
    {
        return count(array_filter($this->cart, fn($item) => $this->isValidCartItem($item)));
    }


    #[On('cart-items')]
    public function cartItems()
    {
        if (session()->has('cart') && !empty(session('cart'))) {
            $this->cart = session()->get('cart');
        }
        
       $this->cartItems=$this->countValidCartItems();
       // $this->cartItems=$cartItems;
       // dd($this->$cartItems);
       
    }


    public function render()
    {
        return view('livewire.navigation');
    }
}
