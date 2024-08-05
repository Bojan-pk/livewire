<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds=[];
   // public $jobs=[];

    protected $listeners = ['saveJobs'];


    public function mount()
    {
        // Učitaj stanje korpe iz sesije
        $this->jobsIds = session()->get('savedJobsIds', []);
    }

    public function saveJobs($id)
    {
        if (in_array($id, $this->jobsIds)) {
            $this->jobsIds = array_diff($this->jobsIds, [$id]);
            
        } else $this->jobsIds[]=$id;
        
        session()->put('savedJobsIds', $this->jobsIds);

         // Emituj događaj sa informacijama o selektovanoj stavci
        // $this->emit('saveJobs', $this->jobsIds[]);

        //$this->activeColapse='jobs';
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
