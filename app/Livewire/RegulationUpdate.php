<?php

namespace App\Livewire;

use App\Livewire\Forms\RegulationForm;
use App\Models\Regulation;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegulationUpdate extends Component
{

    public RegulationForm $form;
    public $regulations = [];
    public $searchTerm='';
    public $selectedId;

    use WithFileUploads;
    
    public function mount()
    {
        //$this->regulations = Regulation::all();
    }

    public function submitForm()
    {
        $this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
    }

    public function regulationSelected($id){
       
        if($this->selectedId!=$id) {
            $this->selectedId=$id;
        $regulation=Regulation::find($id);
        
        if($regulation) {
            $this->form->id=$regulation->id;
            $this->form->name=$regulation->name;
            $this->form->svl=$regulation->svl;
            $this->form->short_name=$regulation->short_name;
            $this->form->valid=$regulation->valid;
            $this->form->file=$regulation->file;
        }
    } else {
        $this->selectedId='';
        $this->form->reset();
        
    }
        
    }

    public function removeRegulation($id = null)
    {
        if ($id) {
            $regulation = Regulation::find($id);
            session()->flash('success', "Propis " . $regulation->name . " је успешно обрисан!!!");
            $regulation->delete();
            $this->form->reset();
        } else $this->cleanTable();
    }
    public function cleanTable()
    {
        $this->form->reset();

        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function render()
    {
        $results = [];
        if (empty($this->searchTerm)) {
           
            $this->regulations = Regulation::orderBy('name')->get();
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = Regulation::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('svl', 'LIKE', '%' . $keyword . '%');
            }

            $this->regulations = $query->orderBy('name')->get();  
        }

        return view('livewire.regulation-update');
    }
}
