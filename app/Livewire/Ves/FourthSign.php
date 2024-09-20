<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\FourthSignForm;
use App\Models\Regulation;
use App\Models\VesThirdSign;
use App\Models\VesFourthSign;
use App\Models\VesSecondSign;

use Livewire\Component;
use Livewire\WithPagination;


class FourthSign extends Component
{
    use WithPagination;

    public FourthSignForm $form;
    public $searchTerm = '';
    public $selectedId;
    public $selectThirdSign;
    public $regulations = [];
    public $thirdSigns=[];
    public $secondSigns;

    public $showDeleteModal = false;

    public function mount()
    {
        $this->form->defaultOrder();
       $this->secondSigns = VesSecondSign::orderBy('order')->get();
       $this->regulations = Regulation::where('short_name', 'Правилник ВЕС')->get();
    }

    public function updatedFormSelectSecondSign($value)
    {
        $this->thirdSigns = VesThirdSign::where('ves_second_sign_id',$value)->orderBy('order')->get();
        $this->form->ves_third_sign_id="";
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
            $fourthSign = VesFourthSign::find($id);
            session()->flash('success', "Ознака за " . $fourthSign->description . " је успешно обрисанa!!!");
            $fourthSign->delete();
            $this->form->reset();
        } else $this->cleanTable();

        $this->showDeleteModal = false; // Sakriva modal nakon brisanja
    }

    public function cleanTable()
    {
        $this->form->reset();
        $this->selectThirdSign = '';
    
        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function selectedThirdSign()
    {
        //dd('stiglo');
        $this->selectThirdSign = $this->form->ves_third_sign_id;
    }

    public function submitForm()
    {
        //dump('submit');
        $this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        //cuva $this->ves_second_sign_id
        $ves_third_sign_id = $this->form->ves_third_sign_id;
        $selectSecondSign = $this->form->selectSecondSign;
        $regulation_id=$this->form->regulation_id;
        $this->form->reset();
        //vraća je 
        $this->form->ves_third_sign_id = $ves_third_sign_id;
        $this->form->selectSecondSign = $selectSecondSign;
        $this->form->regulation_id=$regulation_id;
        $this->form->defaultOrder();
    }

    public function rowSelected($id)
    {
        if ($this->selectedId != $id) {
            $this->selectedId = $id;
            $fourthSign = VesFourthSign::find($id);

            if ($fourthSign) {
                $this->form->id = $fourthSign->id;
                $this->form->order = $fourthSign->order;
                $this->form->sign = $fourthSign->sign;
                $this->form->description = $fourthSign->description;
                $this->form->regulation_id = $fourthSign->regulation_id;

                $this->form->note = $fourthSign->note;
                
                $this->form->selectSecondSign=VesThirdSign::find($fourthSign->ves_third_sign_id)->ves_second_sign_id;

                $this->thirdSigns = VesThirdSign::where('ves_second_sign_id',$this->form->selectSecondSign)->orderBy('order')->get();
                $this->form->ves_third_sign_id = $fourthSign->ves_third_sign_id;
            }
        } else {
            $this->selectedId = '';
            $this->form->reset();
            $this->form->defaultOrder();
        }
    }

    public function render()
    {
        if (empty($this->searchTerm) && $this->selectThirdSign != '') {
            $fourthSigns = VesFourthSign::where('ves_third_sign_id', $this->selectThirdSign)->orderBy('order')->paginate(10);
        } else {
            //dd('radi');
            $this->selectThirdSign = '';
            $keywords = explode(' ', $this->searchTerm);
            $query = VesFourthSign::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('sign', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%');
            }
            $fourthSigns = $query->orderBy('order')->paginate(10);
           // dump($fourthSigns);
        }
        
        return view('livewire.ves.fourth-sign', [
            'fourthSigns' => $fourthSigns
        ]);
    }
}
