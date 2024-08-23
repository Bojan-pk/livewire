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
   public $selectedId;
    

   public function removeRow($id = null)
    {
        if ($id) {
            $firstSign = VesFirstSign::find($id);
            session()->flash('success', "Ознака за " . $firstSign->description . " је успешно обрисанa!!!");
            $firstSign->delete();
            $this->form->reset();
        } else $this->cleanTable();
    }

    public function cleanTable()
    {
        $this->form->reset();

        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function submitForm()
    {
        //$this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
    }
    public function rowSelected($id){
        
        if($this->selectedId!=$id) {
        $this->selectedId=$id;
        $firstSign=VesFirstSign::find($id);
        
        if($firstSign) {
           $this->form->id=$firstSign->id;
            $this->form->order=$firstSign->order;
            $this->form->sign=$firstSign->sign;
            $this->form->description=$firstSign->description;
            $this->form->note=$firstSign->note;
        }
    } else {
        $this->selectedId='';
        $this->form->reset();
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
