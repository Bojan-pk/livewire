<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\FirstSignForm;
use App\Models\VesFirstSign;
use Livewire\Component;
use Livewire\WithPagination;

class FirstSign extends Component
{
   use WithPagination;

   public FirstSignForm $form;
   public $searchTerm='';
   //public $firstSigns=[];
    

    public function submitForm()
    {
        //$this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
    }
    public function rowSelected($id){
        
        $firstSign=VesFirstSign::find($id);
        
        if($firstSign) {
           // $this->form->id=$regulation->id;
            $this->form->order=$firstSign->order;
            $this->form->sign=$firstSign->sign;
            $this->form->description=$firstSign->description;
            $this->form->note=$firstSign->note;
        }

    }

    public function render()
    {
        if (empty($this->searchTerm)) {
           
            $firstSigns = VesFirstSign::orderBy('order')->paginate(10);
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = VesFirstSign::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('sign', 'LIKE', '%' . $keyword . '%')->
                orWhere('description', 'LIKE', '%' . $keyword . '%');
            }

            $firstSigns = $query->orderBy('order')->paginate(10);  
        }

        return view('livewire.ves.first-sign', [
            'firstSigns' => $firstSigns
        ]);
    }
}
