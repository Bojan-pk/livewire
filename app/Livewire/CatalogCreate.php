<?php

namespace App\Livewire;

use Livewire\Component;

use App\Livewire\Forms\CatalogCreateForm;
use App\Models\Regulation;
//use App\Models\Fm;



class CatalogCreate extends Component
{
    public CatalogCreateForm $form;
    public $regulations=[];

    public function mount()
    {
        $this->regulations = Regulation::pluck('name')->toArray(); 
    }

    public function submitForm() {
        
        $this->validate();
        
        if($this->form->fmValidate()) return;

        $this->form->store();
        session()->flash('success','Подаци су успешно унети');
        $this->form->reset('fm','usualy_fm');
        
    }

    public function render()
    {
        return view('livewire.catalog-create');
    }
}
