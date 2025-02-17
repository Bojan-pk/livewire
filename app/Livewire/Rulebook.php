<?php

namespace App\Livewire;

//use App\Models\Rulebook as ModelsRulebook;

use App\Models\Regulation;
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
    public $selectedCategory = '';

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

    public function updatedSelectedCategory()
    {
       // dd($this->selectedCategory);
        $this->activeTable = '';
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
                    ->orWhere('pg_bb', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('note', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('rulebooksTable', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }
        return $query;
    }

    protected function searchByTerm()
    {
        $keywords = explode(' ', $this->searchTerm);
        $selectedCategory = $this->selectedCategory;
        $results = RulebooksTable::whereIn('id', function ($query) use ($selectedCategory) {
            $query->select('rulebooks_table_id')
                ->from('rulebooks')
                ->join('regulations', 'rulebooks.regulation_id', '=', 'regulations.id')  // Join sa regulations tabelom
                ->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');  // Filtriranje po short_name
        })
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('rb', 'LIKE', '%' . $keyword . '%');
                        // ->orWhere('note', 'LIKE', '%' . $keyword . '%');
                    });
                }
            })
            ->paginate(20);

        return $results;
    }

    /* protected function highlightKeyword($text, $keyword)
    {
        if (!$keyword) return $text;

        // Користимо mb_ereg_replace за рад са ћирилицом и додајемо 'i' флаг за case-insensitive
        //Dodavanje \b osigurava da će se označiti samo cela reč i sprečava delimična poklapanja unutar drugih reči.
        //return mb_ereg_replace('(' . preg_quote($keyword) . ')', '<mark>\1</mark>', $text, 'i');
        return mb_ereg_replace('\b(' . preg_quote($keyword) . ')\b', '<mark>\1</mark>', $text, 'i');
    } */

    protected function highlightKeyword($text, $keywords)
    {
        if (!$keywords) return $text;

        $pattern = implode('|', array_map('preg_quote', explode(' ', $keywords)));
        return mb_ereg_replace('(' . $pattern . ')', '<mark>\1</mark>', $text, 'i');
    }



    public function render()
    {

        $resultsTable = $this->searchByTerm();

        // Sortiranje po 'rb' koristeći strnatcmp
        $sortedResults = $resultsTable->getCollection()->sort(function ($a, $b) {
            return strnatcmp($a->rb, $b->rb);
        });


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
        } elseif ($this->selectedCategory) {
            $selectedCategory = $this->selectedCategory;
            // dd(Regulation::where('short_name','LIKE', '%' . $selectedCategory . '%')->pluck('id'));
            $rulebooks->whereIn('regulation_id', Regulation::where('short_name', 'LIKE', '%' . $selectedCategory . '%')->pluck('id'));
        }
        if (!empty($this->searchFm)) {
            // dd($this->searchFm);
            $rulebooks = $this->searchByFm($rulebooks);
        }
        $rulebooks =  $rulebooks->paginate(10, pageName: 'rulebooks-page');

        // Примени маркирање на резултате
        /*  $rulebooks->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchFm) as $keyword) {
            $item->fm = $this->highlightKeyword($item->fm, $keyword);
            $item->fc_sso = $this->highlightKeyword($item->fc_sso, $keyword);
            $item->pg_bb = $this->highlightKeyword($item->pg_bb, $keyword);
            $item->note = $this->highlightKeyword($item->note, $keyword);
            if ($item->rulebooksTable) {
                $item->rulebooksTable->name = $this->highlightKeyword($item->rulebooksTable->name, $keyword);
            }
            }
            return $item;
        }); */

        $keywords = trim($this->searchFm);
        $rulebooks->getCollection()->transform(function ($item) use ($keywords) {
            $item->fm = $this->highlightKeyword($item->fm, $keywords);
            $item->fc_sso = $this->highlightKeyword($item->fc_sso, $keywords);
            $item->pg_bb = $this->highlightKeyword($item->pg_bb, $keywords);
            $item->note = $this->highlightKeyword($item->note, $keywords);
            if ($item->rulebooksTable) {
                $item->rulebooksTable->name = $this->highlightKeyword($item->rulebooksTable->name, $keywords);
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
