<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{

    public $jobsIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    public $experienceIds = [];
    //public $fms = [];
    public  $selectedFm;
    public $newJobName = [];
    public $rulebooksId;

    //uputstvo o UOIR i elementi FM -- promeniti naziv u cart
    public $directions = [];
    

    protected $listeners = [
        'saveJobs',
        'saveEducations',
        'saveConditions',
        'saveExperiences',
        'saveRulebooks',
    ];

    
    public function mount()
    {
        
        
        //session()->flush('directions');
        // Učitaj podatke iz sesije ako postoje
        
       // $this->directions = session()->get('directions', $this->addFm());

        if (session()->has('directions') && !empty(session('directions'))) {
            $this->directions = session()->get('directions');
        } else {
            $this->addFm();
        }
        //$this->rulebooks = session()->get('rulebooks', $this->addRulebooks());
       // dump($this->directions);
        $this->selectedFm = 0;
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
            'newJobName' => 'Радно место ' . count($this->directions) + 1,
            'jobs' => [],
            'educations' => [],
            'conditions' => [],
            'experiences' => [],
            'rulebooks'=>'',
            
        ];
        // Čuvanje u sesiji
        session()->put('directions', $this->directions);
    }

    public function delFm($index)
    {
        unset($this->directions[$index]); // briše posao u okviru FM  
        session()->put('directions', $this->directions);
    }
   

    public function saveItem($index, $type)
    {
        if (in_array($index, $this->directions[$this->selectedFm][$type])) {
            $this->directions[$this->selectedFm][$type] = array_diff($this->directions[$this->selectedFm][$type], [$index]);
        } else {
            $this->directions[$this->selectedFm][$type][] = $index;
        }

        session()->put('directions', $this->directions);
    }

    public function saveRulebooks($index)
    
    {
        if ($this->directions[$this->selectedFm]['rulebooks']!=$index)
        $this->directions[$this->selectedFm]['rulebooks']=$index;
    else $this->directions[$this->selectedFm]['rulebooks']='';
        
        session()->put('directions', $this->directions);

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
        //dump($index);
        $this->selectedFm = $index;
        $this->dispatch('fmCartSelected', $index);
    }

    public function render()
    {
        //obezbeđuje da u cart uvek bude selektovano poslednje fm, ukoliko pre toga nije selektovano neko drugo
        if ($this->selectedFm === null || !array_key_exists($this->selectedFm, $this->directions)) {
            //dump('uuu');
            $keys = array_keys($this->directions);

            $this->fmSelected(end($keys));
        }
        return view('livewire.cart');
    }
}
