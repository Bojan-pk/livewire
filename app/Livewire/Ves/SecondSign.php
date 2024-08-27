<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\SecondSignForm;
use App\Models\VesSecondSign;
use Livewire\Component;
use Livewire\WithPagination;

class SecondSign extends Component
{
   use WithPagination;

   public SecondSignForm $form;
   public $searchTerm='';
   public $selectedId;
   public $showDeleteModal = false;

   Public function mount()
   {
    $this->form->defaultOrder();
   }
   public function confirmDelete()
   {
        
     if ($this->form->id) $this->showDeleteModal = true;
     else session()->flash('error', "Нисте селектовали ред!!!"); // Prikazuje modal
   }
   public function closeModal()
   {
       $this->showDeleteModal = false; // Sakriva modal bez brisanja
   } 
   public function removeRow($id = null)
    {
        if ($id) {
            $secondSign = VesSecondSign::find($id);
            session()->flash('success', "Ознака за " . $secondSign->description . " је успешно обрисанa!!!");
            $secondSign->delete();
            $this->form->reset();
        } else $this->cleanTable();
        $this->showDeleteModal = false; // Sakriva modal nakon brisanja
    }

    public function cleanTable()
    {
        $this->form->reset();

        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function submitForm()
    {
        $this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
        $this->form->defaultOrder();
      
    }
    public function rowSelected($id){
        
        if($this->selectedId!=$id) {
        $this->selectedId=$id;
        $secondSign=VesSecondSign::find($id);
        
        if($secondSign) {
           $this->form->id=$secondSign->id;
            $this->form->order=$secondSign->order;
            $this->form->sign=$secondSign->sign;
            $this->form->description=$secondSign->description;
            $this->form->note=$secondSign->note;
        }
    } else {
        $this->selectedId='';
        $this->form->reset();
        $this->form->defaultOrder();
    }

    }

    public function render()
    {
        if (empty($this->searchTerm)) {
           
            $secondSigns = VesSecondSign::orderBy('order')->paginate(10);
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = VesSecondSign::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('sign', 'LIKE', '%' . $keyword . '%')->
                orWhere('description', 'LIKE', '%' . $keyword . '%');
            }

            $secondSigns = $query->orderBy('order')->paginate(10);  
        }

        return view('livewire.ves.second-sign', [
            'secondSigns' => $secondSigns
        ]);
    }
}
