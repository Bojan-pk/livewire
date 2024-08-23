<?php

namespace App\Livewire\Forms;

use App\Models\VesFirstSign;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FirstSignForm extends Form
{
    public $id;
    
    public $order;

    public $sign;
    
    public $description;

    public $note;

   

    public function store()
    {
        //dd($this->svl);
        $regulation = VesFirstSign::updateOrCreate(
            [
                'sign' => $this->sign,
            ],
            [
                'order' => $this->order,
                'description' => $this->description,
                'note' => $this->note,  
                
            ]
        );
}
}