<?php

namespace App\Livewire;

use App\Models\RulebooksTable;
use Livewire\Component;

class SearchTable extends Component
{
    public $searchTerm='';
    
    protected $listeners=[
        'tableSelected'=>'tableSelected'
    ];

    public function tableSelected($tableId){
        $this->searchTerm="";
    }

    public function render()
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
    }
}
