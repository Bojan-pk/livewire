<?php

namespace App\Livewire;

use App\Models\Fm;
use Livewire\Component;

class SearchFm extends Component
{
    public $searchTerm = '';
    public $selectedCategory = '';

    protected $listeners = [
        'fmSelected' => 'fmSelected'
    ];

    public function fmSelected($fmId)
    {
        $this->searchTerm = "";
    }

    public function render()
    {

        $results = [];
        if (empty($this->searchTerm)) {

            $results = "";
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);

            /* $results = Fm::whereIn('id', function ($query) {
                $query->select('fm_id')
                      ->from('catalogs');
            })
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->orderBy('name')
            ->take(10)
            ->get();
 */
            $selectedCategory = $this->selectedCategory;
            $results = Fm::whereIn('id', function ($query) use ($selectedCategory) {
                $query->select('fm_id')
                    ->from('catalogs')
                    ->join('regulations', 'catalogs.regulation_id', '=', 'regulations.id')  // Join sa regulations tabelom
                    ->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');  // Filtriranje po short_name
            })
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');  // Pretraga po imenu
                    }
                })
                ->orderBy('name')  // Sortiranje po imenu
                ->take(10)  // Ograničenje broja rezultata
                ->get();
        }

        return view(
            'livewire.search-fm',
            [
                'results' => $results,
            ]
        );
    }
}
