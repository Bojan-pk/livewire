<?php

namespace App\Livewire\Remembers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class SaveCart extends Component

{
    public $selectedId;
    public $user_id;
    #[Validate('required|string|max:255')]
    public $name='';
    public $cart = [];
    public $cartItems;

    public function mount()
    {

        if (session()->has('cart') && !empty(session('cart'))) {
            $this->cart = session()->get('cart');
        } 
        //$this->carts=Cart::orderBy('name')->paginate(15);
        //$this->carts=Cart::paginate(15);
        //$this->carts=Cart::all();
    }
    public function cartSelected($id)
    {

        if ($this->selectedId != $id) {
            $this->selectedId = $id;
            $cart = Cart::find($id);
            if ($cart) {
                $this->name = $cart->name;  
            }
        } else {
            $this->selectedId = '';
            $this->reset();
        }
    }

    public function loadData() {
        
        if($this->selectedId){
            $cart=Cart::find($this->selectedId)->content;
            session()->forget('cart');
            session()->put('cart',$cart);
            session()->flash('success', 'Подаци су успешно учитани');
            $this->reset();
            $this->dispatch('cart-items');

        } else {
            session()->flash('error', 'Нисте избрали податке');
        }
       
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


    public function submitForm()
    {
        $validated = $this->validate();
        
        
        Cart::updateOrCreate(
            [
                'name' => $this->name,
            ],
            [
                'user_id' => Auth::id(), // ID trenutno prijavljenog korisnika
                'content' => $this->cart, // Čuvanje sadržaja korpe

            ]
        );
        $this->reset();
        session()->flash('success', 'Успешно је снимљено у базу.');
    }

    public function cleanTable()
    {
        $this->reset();
        session()->flash('success', 'Обрисана је форма за унос');
    }


    public function render()
    {
        $this->cartItems=$this->countValidCartItems();

        return view('livewire.remembers.save-cart',[
            'carts' => Cart::where('user_id', auth()->id())->paginate(10)
        ]);
    }
}
