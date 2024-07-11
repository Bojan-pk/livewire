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
        if (empty($this->searchTerm)) {
            $this->users=null;
        } else {
            $this->users=User::where('name','like',"%$this->searchTerm%")->get();
        }
           
        return view('livewire.searach');
    }
}
