<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds = [];
    public $educationIds = [];
    public $fms = [];
    public $selectedFm;

    //uputstvo o UOIR
    public $directions = [];

    protected $listeners = ['saveJobs'];


    public function mount()
    {
        // Učitaj stanje korpe iz sesije
        //$this->jobsIds = session()->get('savedJobsIds', []);
        //$this->fms[]='Radno mesto 1';

        if ($this->directions = session()->get('directions', [])) {
        } else {
            $this->addFm();
        }

        /* $keys = array_keys($this->directions);

        $this->fmSelected(end($keys)); */
    }

    public function updated($property)
    {
        dd('sasa');
        if (!$this->selectedFm || !array_key_exists($this->selectedFm,$this->directions)) {
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        }
    }

    public function addFm()
    {

        $this->fms[] = 'Радно место ' . count($this->fms) + 1;

        $this->directions['Радно место ' . count($this->fms) + 1] = [
            'jobs' => [],
            'educations' => []
        ];

        // Čuvanje u sesiji
        session()->put('directions', $this->directions);
    }

    public function delFm($index)
    {
        //dd($id);
        // unset($this->fms[$id]);
        unset($this->directions[$index]); // briše posao u okviru FM
        // $this->directions = array_values(  $this->directions); // reindex array;
        //dodaje prazno polje
        if ($this->fms == null) $this->addFm();
    }

    /* public function saveJobs($id)//mozda da umesto save bude add
    {
        if (in_array($id, $this->jobsIds)) {
            $this->jobsIds = array_diff($this->jobsIds, [$id]);
            
        } else $this->jobsIds[]=$id;
        session()->put('savedJobsIds', $this->jobsIds);
    } */

    public function saveJobs($index) //mozda da umesto save bude add
    {

        if (in_array($index, $this->directions[$this->selectedFm]['jobs'])) //proverava da li posao već postoji
        {
            //dump($this->selectedFm);
            //$this->jobsIds = array_diff($this->jobsIds, [$id]);
            //unset($this->directions[$this->selectedFm]['jobs'][$index]);// briše posao u okviru FM
            $this->directions[$this->selectedFm]['jobs'] = array_diff($this->directions[$this->selectedFm]['jobs'], [$index]);
        } else $this->directions[$this->selectedFm]['jobs'][] = $index;

        //session()->put('savedJobsIds', $this->jobsIds);
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
        if (!$this->selectedFm || !array_key_exists($this->selectedFm,$this->directions)) {
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        }
        return view('livewire.cart');
    }
}
