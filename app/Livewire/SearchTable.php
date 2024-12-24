<?php

namespace App\Livewire;

use App\Models\RulebooksTable;
use Livewire\Component;

class SearchTable extends Component
{
    public $searchTerm='';
    public $selectedCategory = '';
    
    protected $listeners=[
        'tableSelected'=>'tableSelected'
    ];

    public function tableSelected($tableId){
        $this->searchTerm="";
    }

    /* public function render()
    {
        $results = [];
        if (empty($this->searchTerm)) {
           
           $results="";
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = RulebooksTable::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('rb', 'LIKE', '%' . $keyword . '%');
            }

            $results = $query->orderBy('rb')->take(10)->get();  
        }



        return view('livewire.search-table',
        [
            'results' => $results,
        ]);
    } */

    public function render()
    {
        $results = [];
        if (empty($this->searchTerm)) {
           
           $results="";
        } else {
            //dd('radi');
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
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('rb', 'LIKE', '%' . $keyword . '%');
            }

        })
        ->orderBy('rb')  // Sortiranje po imenu
        ->take(10)  // Ograničenje broja rezultata
        ->get();
        }



        return view('livewire.search-table',
        [
            'results' => $results,
        ]);
    }


}
