<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    public $fms = [];
    public $selectedFm;

    //uputstvo o UOIR
    public $directions = [];

    protected $listeners = ['saveJobs', 'saveEducations','saveConditions'];

    public function mount()
    {
        //session()->flush('directions');
        // Učitaj stanje korpe iz sesije
        if ($this->directions = session()->get('directions', [])) {
        } else {
            $this->addFm();
        }
    }


    public function updateFmName($index, $newName)
    {
       // dd($index, $newName);
        
        $keys = array_keys($this->directions);

        
        $oldKey = $keys[$index];
        //dd($oldKey);
        $temporary=$this->directions[$oldKey];
        unset($this->directions[$oldKey]);
        $this->directions[$newName] = $temporary;
        //$this->directions[$newName]['name'] = $newName;
        //$this->directions[]= array_diff($this->directions, [$oldKey]);

        
        session()->put('directions', $this->directions);

    }


    public function updated($property)
    {
        dd('sasa');
        if (!$this->selectedFm || !array_key_exists($this->selectedFm, $this->directions)) {
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        }
    }

    public function addFm()
    {

        $this->fms[] = 'Радно место ' . count($this->fms) + 1;

        $this->directions['Радно место ' . count($this->fms) + 1] = [
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
        if ($this->fms == null) $this->addFm();
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
        //dd($index);
        $this->selectedFm = $index;
        $this->dispatch('fmCartSelected', $index);
    }

    public function render()
    {
        //obezbeđuje da u cart uvek bude selektovano poslednje fm, ukoliko pre toga nije selektovano neko drugo
        if (!$this->selectedFm || !array_key_exists($this->selectedFm, $this->directions)) {
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        }
        return view('livewire.cart');
    }
}
