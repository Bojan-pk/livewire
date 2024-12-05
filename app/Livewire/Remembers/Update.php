<?php

namespace App\Livewire\Remembers;

use App\Livewire\Cart;
use Livewire\Component;

class Update extends  Cart
{
   //public $cart = [];
    public $selectedFm;
    public $rb;
    public $newJobName;

   /*  public function mount()
    {
        
      //
       
    }  */

    protected $listeners = [
        'fmCartSelected' => 'fmCartSelected'
    ];


    public function fmCartSelected($index)
    {
        $this->selectedFm = $index;
       
       $this->rb=$this->cart[$index]['rb'];
       $this->newJobName=$this->cart[$index]['newJobName'];
    }

    public function editItem (){

        $this->cart[$this->selectedFm]['rb']=$this->rb;
       $this->cart[$this->selectedFm]['newJobName']=$this->newJobName;
       
      // Чување старог елемента
       $movedItem = $this->cart[$this->selectedFm];
       // Уклањање елемента из старе позиције
    
       unset($this->cart[$this->selectedFm]);

       array_splice($this->cart, $this->rb - 1, 0, [$movedItem]); // убацује елемент на нову позицију

    // Ажурирање `rb` за сваки елемент
    foreach ($this->cart as $key => $item) {
        $this->cart[$key]['rb'] = $key + 1;
    }

    // Чување у сесији
    session()->put('cart', $this->cart);

    }

    public function render()
    {
        return view('livewire.remembers.update');
    }
}
