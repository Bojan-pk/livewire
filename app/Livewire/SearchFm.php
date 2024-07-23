<?php

namespace App\Livewire;

use App\Models\Fm;
use Livewire\Component;

class SearchFm extends Component
{

    public $searchTerm='';
    
    protected $listeners=[
        'fmSelected'=>'fmSelected'
    ];

    public function fmSelected($fmId){
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
            $query = Fm::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            }

            
            $results = $query->orderBy('name')->take(10)->get();
          
            
        }


        
        return view('livewire.search-fm',
        [
            'results' => $results,
        ]);
    }
}
