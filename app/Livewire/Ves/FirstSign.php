<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\FirstSignForm;
use App\Models\Regulation;
use App\Models\VesFirstSign;
use Livewire\Component;
use Livewire\WithPagination;

class FirstSign extends Component
{
   use WithPagination;

   public FirstSignForm $form;
   public $searchTerm='';
   public $selectedId;
   public $regulations = [];
    
   public $showDeleteModal = false;

   public function mount()
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
            $firstSign = VesFirstSign::find($id);
            session()->flash('success', "Ознака за " . $firstSign->description . " је успешно обрисанa!!!");
            $firstSign->delete();
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
        $this->form->defaultOrder();
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
