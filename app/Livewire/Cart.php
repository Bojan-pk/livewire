<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    //public $fms = [];
    public  $selectedFm;
    public $newJobName = [];

    //uputstvo o UOIR
    public $directions = [];

    protected $listeners = ['saveJobs', 'saveEducations','saveConditions'];

    public function mount()
    {
        //session()->flush('directions');
        // Učitaj podatke iz sesije ako postoje
        $this->directions = session()->get('directions', [
            [
                'newJobName' => 'Радно место 1',
                'jobs' => [],
                'educations' => [],
                'conditions' => [],
            ]
        ]); 
        $this->selectedFm=0;
    }

    public function updatedDirections($value, $name)
    {
        
        [$index, $field] = explode('.', $name);
        $this->directions[$index][$field] = $value;
        session()->put('directions', $this->directions);
    }

    public function addFm()
    {

        $this->directions[] = [
            'newJobName'=>'Радно место '.count($this->directions)+1,
            'jobs' => [],
            'educations' => [],
            'conditions' => [],

        ];

        // Čuvanje u sesiji
        session()->put('directions', $this->directions);
    }

    public function delFm($index)
    {   
        unset($this->directions[$index]); // briše posao u okviru FM  
        session()->put('directions', $this->directions);
    }

   


    public function saveJobs($index) //mozda da umesto save bude add
    {

        if (in_array($index, $this->directions[$this->selectedFm]['jobs'])) //proverava da li posao već postoji
        {  
            $this->directions[$this->selectedFm]['jobs'] = array_diff($this->directions[$this->selectedFm]['jobs'], [$index]);
        }   else $this->directions[$this->selectedFm]['jobs'][] = $index;

        session()->put('directions', $this->directions);
    }

    public function saveEducations($index) 
    {

        if (in_array($index, $this->directions[$this->selectedFm]['educations'])) //proverava da li edukacija već postoji
        {            
            $this->directions[$this->selectedFm]['educations'] = array_diff($this->directions[$this->selectedFm]['educations'], [$index]);
        } else $this->directions[$this->selectedFm]['educations'][] = $index;

        session()->put('directions', $this->directions);
    }

    public function saveConditions($index) 
    {

        if (@in_array($index, $this->directions[$this->selectedFm]['conditions'])) //proverava da li edukacija već postoji
        {            
            $this->directions[$this->selectedFm]['conditions'] = array_diff($this->directions[$this->selectedFm]['conditions'], [$index]);
        } else $this->directions[$this->selectedFm]['conditions'][] = $index;

        session()->put('directions', $this->directions);
    }


    public function fmSelected($index)
    {
        //dump($index);
        $this->selectedFm = $index;
        $this->dispatch('fmCartSelected', $index);
    }

    public function render()
    {
        //obezbeđuje da u cart uvek bude selektovano poslednje fm, ukoliko pre toga nije selektovano neko drugo
       if ($this->selectedFm===null || !array_key_exists($this->selectedFm, $this->directions)) {
            //dump('uuu');
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        } 
        return view('livewire.cart');
    }
}
