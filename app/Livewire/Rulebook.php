<?php

namespace App\Livewire;

use App\Models\Rulebook as ModelsRulebook;
use App\Models\RulebooksTable;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Elementi FM')]
class Rulebook extends Component
{
    public $searchTerm = '';
    public $rulebooksTable;
    public $activeTable;
    public $rulebooksId;
    //public $rulebooks;

    protected $listeners = [
        'saveRulebooks',
        'fmCartSelected',
    ];
    use WithPagination;
    public function mount()
    {
        $this->rulebooksTable = RulebooksTable::first();
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);
        $this->rulebooksId = isset($cart[$index]['rulebooks']) ? $cart[$index]['rulebooks'] : '';
    }

    public function tableSelected($fmTable)
    {
        $this->activeTable = $fmTable;
        $this->rulebooksTable = RulebooksTable::find($fmTable);
    }

    public function saveRulebooks($id)
    {
        if ($this->rulebooksId != $id) $this->rulebooksId = $id;
        else $this->rulebooksId = '';
    }

    public function render()
    {
        $results = [];

        if ($this->searchTerm == null) {

            $results = RulebooksTable::orderBy('rb')->paginate(10);
        } else {

            $keywords = explode(' ', $this->searchTerm);
            $query = RulebooksTable::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('rb', 'LIKE', '%' . $keyword . '%');
                });
            }
            $results = $query->orderBy('rb')->paginate(10);
        }
        $rulebooks = $this->rulebooksTable->rulebooks()->paginate(2, pageName: 'rulebooks-page');
        return view(
            'livewire.rulebook',
            [
                'results' => $results,
                'rulebooks'=>$rulebooks
            ]
        );
    }
}
