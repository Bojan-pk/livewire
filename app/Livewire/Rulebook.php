<?php

namespace App\Livewire;

//use App\Models\Rulebook as ModelsRulebook;

use App\Models\Rulebook as ModelsRulebook;
use App\Models\RulebooksTable;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Elementi FM')]
class Rulebook extends Component
{
    public $searchTerm = '';
    public $searchFm = '';
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
        // $this->rulebooksTable = RulebooksTable::first();
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);
        $this->rulebooksId = isset($cart[$index]['rulebooks']) ? $cart[$index]['rulebooks'] : '';
    }

    public function tableSelected($idTable)
    {
        // dd($idTable);
        if ($this->activeTable != $idTable) {
            $this->activeTable = $idTable;
            // $this->rulebooksTable = RulebooksTable::find($idTable);
        } else {
            $this->activeTable = '';
        }
    }

    public function updatedSearchTerm()
    {
        $this->activeTable = "";
    }

    public function saveRulebooks($id)
    {
        if ($this->rulebooksId != $id) $this->rulebooksId = $id;
        else $this->rulebooksId = '';
    }

    protected function searchByFm($query)
    {
        $keywords = explode(' ', $this->searchFm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('fm', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('fc_sso', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('pg_bb', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }

    protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('rb', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('name', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }

    protected function highlightKeyword($text, $keyword)
    {
        if (!$keyword) return $text;

        // Користимо mb_ereg_replace за рад са ћирилицом и додајемо 'i' флаг за case-insensitive
        return mb_ereg_replace('(' . preg_quote($keyword) . ')', '<mark>\1</mark>', $text, 'i');
    }

    public function render()
    {
        //$resultsTable = [];
        $resultsTable = RulebooksTable::query();

        if (!empty($this->searchTerm)) {

            $resultsTable = $this->searchByTerm($resultsTable);
        }
        $resultsTable = $resultsTable->paginate(10);

       

        // Sortiranje po 'rb' koristeći strnatcmp
        $sortedResults = $resultsTable->getCollection()->sort(function ($a, $b) {
            return strnatcmp($a->rb, $b->rb);
        });

        // Zameni originalnu kolekciju sortiranom

        $resultsTable->setCollection($sortedResults);

         // Примени маркирање на резултате
         $resultsTable->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchTerm) as $keyword) {
                $item->rb = $this->highlightKeyword($item->rb, $keyword);
                $item->name = $this->highlightKeyword($item->name, $keyword);
               
            }
            return $item;
        });

        $rulebooks = ModelsRulebook::query();

        if ($this->activeTable) {

            $rulebooks->where('rulebooks_table_id', $this->activeTable);
        }
        if (!empty($this->searchFm)) {
            // dd($this->searchFm);
            $rulebooks = $this->searchByFm($rulebooks);
        }
        $rulebooks =  $rulebooks->paginate(10, pageName: 'rulebooks-page');

        // Примени маркирање на резултате
        $rulebooks->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchFm) as $keyword) {
                $item->fm = $this->highlightKeyword($item->fm, $keyword);
                $item->fc_sso = $this->highlightKeyword($item->fc_sso, $keyword);
                $item->pg_bb = $this->highlightKeyword($item->pg_bb, $keyword);
            }
            return $item;
        });

        return view(
            'livewire.rulebook',
            [
                'resultsTable' => $resultsTable,
                'rulebooks' => $rulebooks
            ]
        );
    }
}
