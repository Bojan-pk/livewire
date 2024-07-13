<?php

namespace App\Livewire;

use App\Livewire\Forms\CatalogForm;
//use App\Models\Fm;
use Livewire\Component;

class Catalog extends Component

{
    public CatalogForm $form;

    public function submitForm() {
        
        $this->validate();
        
        if($this->form->fmValidate()) return;

        $this->form->store();

    
        session()->flash('success','Подаци су успешно унети');
        //$this->form->sendMail();
        $this->form->reset('fm','usualy_fm');
        //dd($this->form);

    }

    public function render()
    {
        return view('livewire.catalog');
    }
}
