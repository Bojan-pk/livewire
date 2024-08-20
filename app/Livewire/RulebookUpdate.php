<?php

namespace App\Livewire;
use Livewire\Component;
use App\Livewire\Forms\RulebookUpdateForm;
use App\Models\Regulation;
use App\Models\Rulebook;
use App\Models\RulebooksTable;

class RulebookUpdate extends Component
{

    public RulebookUpdateForm $form;
    public $regulations = [];

    protected $listeners = [
        'tableSelected' => 'tableSelected'
    ];

    public $selectedRow;

    public $showDeleteModal = false;

    public function confirmDelete($key)
    {
        $this->selectedRow =$key;
        //dump( $this->selectedRow);
        $this->showDeleteModal = true; // Prikazuje modal
    }

    public function deleteRow()
    {
       
        $id=$this->form->table_items[$this->selectedRow]['id'];
       if($id) Rulebook::find($id)->delete();
        
       //briše niz
        unset($this->form->table_items[$this->selectedRow]);
        $this->form->table_items = array_values($this->form->table_items); // reindex array;
        //dodaje prazno polje
        if ($this->form->table_items == null) $this->addTableRow();

        $this->showDeleteModal = false; // Sakriva modal nakon brisanja
        $this->selectedRow = null;
        session()->flash('success', 'Успешно обрисан ред');  
    }

    public function closeModal()
    {
        $this->showDeleteModal = false; // Sakriva modal bez brisanja
    }

    public function mount()
    {
        $this->regulations = Regulation::where('short_name', 'Елементи ФМ')->get();
    }

    public function tableSelected($tableId)
    {
        $this->resetValidation();

        if ($rulebooksTable = RulebooksTable::where('id', $tableId)->first()) {
            // dd($rulebooksTable);
            $this->form->table_rb = $rulebooksTable->rb;
            $this->form->table_name = $rulebooksTable->name;
            $this->form->table_id = $rulebooksTable->id;
            $this->form->table_items = $rulebooksTable->rulebooks->sortBy('rb')->toArray();
        } else return session()->flash('error', 'Нема података о табелама');
    }

    public function submitForm()
    {
        $this->validate();
        $this->form->store();
        session()->flash('success', 'Подаци су успешно унети');
        $this->form->reset();
    }

    public function addTableRow()
    {
        $this->form->table_items[] =
            [
                'id' => '',
                'rb' => '',
                'fm' => '',
                'fc_sso' => '',
                'pg_bb' => '',
                'note' => '',
                'regulation_id' => ''
            ];
    }

   /*  public function removeTableRow($key)
    {
        unset($this->form->table_items[$key]);
        $this->form->table_items = array_values($this->form->table_items); // reindex array;
        //dodaje prazno polje
        if ($this->form->table_items == null) $this->addTableRow();
    } */

    public function removeTable($id = null)
    {
        if ($id) {
            $rulebooksTable = RulebooksTable::find($id);
            session()->flash('success', "Табела бр. " . $rulebooksTable->rb . " је успешно обрисан!!!");
            $rulebooksTable->delete();
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
        return view('livewire.rulebook-update');
    }
}
