<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $jobsIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    public $experienceIds = [];
    public  $selectedFm;
    public $newJobName = [];
    public $rulebooksId;
    public $vesId;

    //uputstvo o UOIR i elementi FM -- promeniti naziv u cart
    public $cart = [];
    
    protected $listeners = [
        'saveJobs',
        'saveEducations',
        'saveConditions',
        'saveExperiences',
        'saveRulebooks',
        'saveVes'
    ];

    public function mount()
    {
        
        if (session()->has('cart') && !empty(session('cart'))) {
            $this->cart = session()->get('cart');
        } else {
            $this->addFm();
        }
        if (session()->has('selectedFm') && !empty(session('selectedFm'))) {
            $this->selectedFm = session()->get('selectedFm');
        } else {
            $this->selectedFm = 0;
        }
       
    }

    public function updatedcart($value, $name)
    {
        [$index, $field] = explode('.', $name);
        $this->cart[$index][$field] = $value;
        session()->put('cart', $this->cart);
    }

    public function addFm()
    {
        $this->cart[] = [
            'newJobName' => 'Радно место ' . count($this->cart) + 1,
            'jobs' => [],
            'educations' => [],
            'conditions' => [],
            'experiences' => [],
            'rulebooks'=>'', 
            'ves'=>'', 
        ];
        // Čuvanje u sesiji
        session()->put('cart', $this->cart);
    }

    public function delFm($index)
    {
        unset($this->cart[$index]); // briše posao u okviru FM  
        session()->put('cart', $this->cart);
    }
   
    public function saveItem($index, $type)
    {
        if (in_array($index, $this->cart[$this->selectedFm][$type])) {
            $this->cart[$this->selectedFm][$type] = array_diff($this->cart[$this->selectedFm][$type], [$index]);
        } else {
            $this->cart[$this->selectedFm][$type][] = $index;
        }

        session()->put('cart', $this->cart);
    }

    public function saveRulebooks($index)
    
    {
        if ($this->cart[$this->selectedFm]['rulebooks']!=$index)
        $this->cart[$this->selectedFm]['rulebooks']=$index;
    else $this->cart[$this->selectedFm]['rulebooks']='';
        
        session()->put('cart', $this->cart);

    }

    public function saveVes($index) 
    {
        if ($this->cart[$this->selectedFm]['ves']!=$index)
        $this->cart[$this->selectedFm]['ves']=$index;
    else $this->cart[$this->selectedFm]['ves']='';
        
        session()->put('cart', $this->cart);

    }

    public function saveJobs($index)
    {
        $this->saveItem($index, 'jobs');
    }

    public function saveEducations($index)
    {
        $this->saveItem($index, 'educations');
    }

    public function saveConditions($index)
    {
        $this->saveItem($index, 'conditions');
    }

    public function saveExperiences($index)
    {
        $this->saveItem($index, 'experiences');
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
        return view('livewire.cart');
    }
}
