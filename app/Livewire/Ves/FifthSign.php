<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\FifthSignForm;
use App\Models\Regulation;
use App\Models\VesFifthSign;
use Livewire\Component;
use Livewire\WithPagination;

class FifthSign extends Component
{
   use WithPagination;

   public FifthSignForm $form;
   public $searchTerm='';
   public $selectedId;
   public $regulations = [];

   public $showDeleteModal = false;

   Public function mount()
   {
    $this->form->defaultOrder();
    $this->regulations = Regulation::where('short_name', 'Правилник ВЕС')->get();
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
            $fifthSign = VesFifthSign::find($id);
            session()->flash('success', "Ознака за " . $fifthSign->description . " је успешно обрисанa!!!");
            $fifthSign->delete();
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
        $regulation_id=$this->form->regulation_id;
        $this->form->reset();
        $this->form->regulation_id=$regulation_id;
        $this->form->defaultOrder();
    }
    public function rowSelected($id){
        
        if($this->selectedId!=$id) {
        $this->selectedId=$id;
        $fifthSign=VesFifthSign::find($id);
        
        if($fifthSign) {
           $this->form->id=$fifthSign->id;
            $this->form->order=$fifthSign->order;
            $this->form->sign=$fifthSign->sign;
            $this->form->description=$fifthSign->description;
            $this->form->note=$fifthSign->note;
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
           
            $fifthSigns = VesFifthSign::orderBy('order')->paginate(10);
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = VesFifthSign::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('sign', 'LIKE', '%' . $keyword . '%')->
                orWhere('description', 'LIKE', '%' . $keyword . '%');
            }

            $fifthSigns= $query->orderBy('order')->paginate(10);  
        }

        return view('livewire.ves.fifth-sign', [
            'fifthSigns' => $fifthSigns
        ]);
    }
}
