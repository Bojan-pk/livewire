<?php

namespace App\Livewire\Ves;

use App\Livewire\Forms\VesConditionForm;
use App\Models\VesCondition as ModelsVesCondition;
use Livewire\Component;
use Livewire\WithFileUploads;

use Livewire\WithPagination;

class VesCondition extends Component
{
    use WithFileUploads;
    use WithPagination;

    public VesConditionForm $form;
    public $searchTerm = '';
    public $selectedId;

    public $showDeleteModal = false;

    public function mount()
    {
        //$this->form->defaultOrder();
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
            $vesCondition = ModelsVesCondition::find($id);
            session()->flash('success', "Услов за " . $vesCondition->ves . " је успешно обрисанa!!!");
            $vesCondition->delete();
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
        if ($this->form->excelFile) $this->form->import();
        else {
            $this->validate();
            $this->form->store();
        }

        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
        //$this->form->defaultOrder();

    }
    public function rowSelected($id)
    {

        if ($this->selectedId != $id) {
            $this->selectedId = $id;
            $vesCondition = ModelsVesCondition::find($id);

            if ($vesCondition) {
                $this->form->id = $vesCondition->id;
                $this->form->rb = $vesCondition->rb;
                $this->form->old_ves = $vesCondition->old_ves;
                $this->form->old_alternative = $vesCondition->old_alternative;
                $this->form->old_condition = $vesCondition->old_condition;
                $this->form->ves = $vesCondition->ves;
                $this->form->condition = $vesCondition->condition;
                $this->form->alternative = $vesCondition->alternative;
            }
        } else {
            $this->selectedId = '';
            $this->form->reset();
            //$this->form->defaultOrder();
        }
    }

    public function render()
    {
        if (empty($this->searchTerm)) {

            $vesConditions = ModelsVesCondition::orderBy('old_ves')->paginate(10);
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = ModelsVesCondition::query();
            // Pretraži svaku ključnu reč 
            foreach ($keywords as $keyword) {
                $query->where('ves', 'LIKE', '%' . $keyword . '%')->orWhere('old_ves', 'LIKE', '%' . $keyword . '%');
            }

            $vesConditions = $query->orderBy('old_ves')->paginate(10);
        }

        return view('livewire.ves.ves-condition', [
            'vesConditions' => $vesConditions
        ]);
    }
}
