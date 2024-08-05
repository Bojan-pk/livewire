<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds=[];
    public $fms=[];
    public $selectedFm;

    protected $listeners = ['saveJobs'];


    public function mount()
    {
        // Učitaj stanje korpe iz sesije
        $this->jobsIds = session()->get('savedJobsIds', []);
        $this->fms[]='Radno mesto 1';
    }

    public function addFm(){

        $this->fms[]='Радно место '. count($this->fms)+1;
    }

    public function delFm($id){
        //dd($id);
        unset($this->fms[$id]);
        $this->fms = array_values(  $this->fms); // reindex array;
        //dodaje prazno polje
        if( $this->fms==null) $this->addFm();
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

    public function fmSelected($index) 
    {
       // dd($index);
        $this->selectedFm=$index;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
