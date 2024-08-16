<?php

namespace App\Livewire;

use App\Livewire\Forms\RegulationForm;
use App\Models\Regulation;
use Livewire\Component;

class RegulationUpdate extends Component
{

    public RegulationForm $form;
    public $regulations = [];
    public $searchTerm='';

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
