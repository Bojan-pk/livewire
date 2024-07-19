<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Searach extends Component
{
    public $searchTerm='';
   
    public $users;
    public function render()
    {
        $results = [];

        if (empty($this->searchTerm)) {
           
            
            $this->users=null;
        } else {
            $keywords = explode(' ', $this->searchTerm);
            $query = User::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            }

            $results = $query->get();
        }

        return view('livewire.searach',
        [
            'results' => $results,
        ]);
        
        }
              
}
