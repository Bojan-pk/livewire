<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\ThirdSignForm;
use App\Models\VesSecondSign;
use App\Models\VesThirdSign;
use Livewire\Component;
use Livewire\WithPagination;

class ThirdSign extends Component
{
   use WithPagination;

   public ThirdSignForm $form;
   public $searchTerm='';
   public $selectedId;
  public $selectSecondSign;
   
   public $secondSigns;
   public $showDeleteModal = false;

   Public function mount()
   {
    $this->form->defaultOrder();
    $this->secondSigns=VesSecondSign::orderBy('order')->get();
   }

   public function updatedFormVesSecondSignId ($value) {
    $this->selectSecondSign=$value;
   // dump($value);
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
       // dd('stiglo');
        if ($id) {
            $thirdSign = VesThirdSign::find($id);
            session()->flash('success', "Ознака за " . $thirdSign->description . " је успешно обрисанa!!!");
            $thirdSign->delete();
            $this->form->reset();
        } else $this->cleanTable();
        $this->showDeleteModal = false; // Sakriva modal nakon brisanja
    }

    public function cleanTable()
    {
        $this->form->reset();
        $this->selectSecondSign='';

        session()->flash('success', 'Обрисана је форма за унос');
    }

   /*  public function selectedSecondSign(){
       
        $this->selectSecondSign=$this->form->ves_second_sign_id;
       // dd($this->selectSecondSign);
    } */

    public function submitForm()
    {
        $this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        //cuva $this->ves_second_sign_id
        $ves_second_sign_id=$this->form->ves_second_sign_id;
        $this->form->reset();
        //vraća je 
        $this->form->ves_second_sign_id=$ves_second_sign_id;

        $this->form->defaultOrder();
      
    }
    public function rowSelected($id){
        
        if($this->selectedId!=$id) {
        $this->selectedId=$id;
        $thirdSign=VesThirdSign::find($id);
        
        if($thirdSign) {
           $this->form->id=$thirdSign->id;
            $this->form->order=$thirdSign->order;
            $this->form->sign=$thirdSign->sign;
            $this->form->description=$thirdSign->description;
            $this->form->note=$thirdSign->note;
            $this->form->ves_second_sign_id=$thirdSign->ves_second_sign_id;
        }
    } else {
        $this->selectedId='';
        $this->form->reset();
        $this->form->defaultOrder();
    }

    }

    public function render()
    {
        if (empty($this->searchTerm)&&$this->selectSecondSign!='') {
           
            //$thirdSigns = VesThirdSign::orderBy('order')->paginate(10);
            $thirdSigns = VesThirdSign::where('ves_second_sign_id',$this->selectSecondSign)->orderBy('order')->paginate(10);
        } else {
            //dd('radi');
            $this->selectSecondSign='';
            $keywords = explode(' ', $this->searchTerm);
            $query = VesThirdSign::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('sign', 'LIKE', '%' . $keyword . '%')->
                orWhere('description', 'LIKE', '%' . $keyword . '%');
            }

            $thirdSigns = $query->orderBy('order')->paginate(10);  
        }

        return view('livewire.ves.third-sign', [
            'thirdSigns' => $thirdSigns
        ]);
    }
}
