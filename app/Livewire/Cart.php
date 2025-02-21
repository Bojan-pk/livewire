<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $jobsIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    public $experienceIds = [];
    public $selectedFm;
    public $newJobName = [];
    public $rulebooksId;
    public $ves;
    //public $rb;
    public $usualyFm;
    public $isMinimized = false;
    public $showRemoveModal = false;

    //uputstvo o UOIR i elementi FM -- promeniti naziv u cart
    public $cart = [];

    protected $listeners = [
        'saveJobs',
        'saveEducations',
        'saveConditions',
        'saveExperiences',
        'saveRulebooks',
        'saveVes',
        'saveUsualyFm'
    ];

    public function mount()
    {

        if (session()->has('cart') && !empty(session('cart'))) {
            $this->cart = session()->get('cart');
        } else {
            $this->addFm();
            //$this->cart = []; // Prazan niz na početku
        }
        if (session()->has('selectedFm') && !empty(session('selectedFm'))) {
            $this->selectedFm = session()->get('selectedFm');
        } else {
            $this->selectedFm = 0;
        }

       // $this->dispatch('scrollToSelected');
        $this->dispatch('scrollToSelected',$this->selectedFm);
    }

    public function closeModal()
    {
        $this->showRemoveModal = false; // Sakriva modal bez brisanja
    }

    public function toggleCart()
    {
        $this->isMinimized = !$this->isMinimized;
    }


    public function updatedcart($value, $name)
    {
        // dd('stiglo');
        [$index, $field] = explode('.', $name);
        $this->cart[$index][$field] = $value;
        session()->put('cart', $this->cart);
    }

    public function removeInput(){
      
        
        $this->cart=[];
        session()->flash('success', 'Подаци су успешно обрисани');
        $this->addFm();
        $this->showRemoveModal = false; // Sakriva modal bez brisanja
    }

    public function validateRemoveData()
    {

        $this->showRemoveModal = true; 
    }

    public function addFm()
    {
        $nextNumber = count($this->cart) + 1;
        $this->cart[] = [
            'newJobName' => 'Радно место ' .  $nextNumber,
            'jobs' => [],
            'educations' => [],
            'conditions' => [],
            'experiences' => [],
            'rulebooks' => '',
            'ves' => '',
            'rb' => $nextNumber
        ];
        // Čuvanje u sesiji
        session()->put('cart', $this->cart);
        //$this->selectedFm=$nextNumber-1;
        $this->fmSelected($nextNumber-1);

        $this->dispatch('scrollToSelected',$nextNumber-1);  
    }

    public function delFm($index)
    {
        unset($this->cart[$index]); // briše posao u okviru FM 

        if(count($this->cart)==0){
            $this->addFm();
        }   
        $this->cart = array_values($this->cart); // Поново индексирајте низ 

        // Ажурирање `rb` вредности за сваки преостали елемент
        foreach ($this->cart as $key => $item) {
            $this->cart[$key]['rb'] = $key + 1;
            // $this->cart[$key]['newJobName'] = 'Радно место ' . ($key + 1);
        }

        session()->put('cart', $this->cart);
        //$cartItems = count($this->cart);
        // $this->dispatch('cart-items', $cartItems);
    }

    public function saveItem($index, $type,$indexFm=null)
    {
        if (!$indexFm) {
            $indexFm=$this->selectedFm;
        }
        if (in_array($index, $this->cart[$indexFm][$type])) {
            $this->cart[$indexFm][$type] = array_diff($this->cart[$indexFm][$type], [$index]);
        } else {
            $this->cart[$indexFm][$type][] = $index;
        }

        session()->put('cart', $this->cart);
    }

    public function saveRulebooks($index,$indexFm=null)

    {
        if (!$indexFm) {
            $indexFm=$this->selectedFm;
        }
        if ($this->cart[$indexFm]['rulebooks'] != $index)
            $this->cart[$indexFm]['rulebooks'] = $index;
        else $this->cart[$indexFm]['rulebooks'] = '';

        session()->put('cart', $this->cart);
    }

    

    public function saveVes($index,$indexFm=null)
    {
        if (!$indexFm) {
            $indexFm=$this->selectedFm;
        }
        if ($this->cart[$indexFm]['ves'] != strip_tags($index))
            $this->cart[$indexFm]['ves'] = strip_tags($index);
        else $this->cart[$indexFm]['ves'] = '';

        session()->put('cart', $this->cart);
    }

    public function saveUsualyFm($index)
    {
        if ($this->cart[$this->selectedFm]['newJobName'] != $index)
            $this->cart[$this->selectedFm]['newJobName'] = $index;
        else $this->cart[$this->selectedFm]['newJobName'] = '';

        session()->put('cart', $this->cart);
    }


    public function saveJobs($index,$indexFm=null)
    {
        $this->saveItem($index, 'jobs',$indexFm);
    }

    public function saveEducations($index,$indexFm=null)
    {
        //dd();
        $this->saveItem($index, 'educations',$indexFm);
    }

    public function saveConditions($index,$indexFm=null)
    {
       //dd($fm);
        $this->saveItem($index, 'conditions',$indexFm);
    }

    public function saveExperiences($index,$indexFm=null)
    {
        $this->saveItem($index, 'experiences',$indexFm);
    }

    public function fmSelected($index)
    {
        $this->selectedFm = $index;
        session()->put('selectedFm', $this->selectedFm);
        $this->dispatch('fmCartSelected', $index);
    }

  

    public function render()
    {
        //obezbeđuje da u cart uvek bude selektovano poslednje fm, ukoliko pre toga nije selektovano neko drugo
        if ($this->selectedFm === null || !array_key_exists($this->selectedFm, $this->cart)) {
            $keys = array_keys($this->cart);
            $this->fmSelected(end($keys));
        }

        // Emitovanje broja validnih stavki
        //$cartItems = $this->countValidCartItems();
        //$this->dispatch('cart-items', $cartItems);
        $this->dispatch('cart-items');

        return view('livewire.cart');
    }
}
