<?php

namespace App\Livewire\Forms;

use App\Models\Regulation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegulationForm extends Form
{
    #[Validate('required',message:"Обавезно поље")]
    #[Validate('max:255',message:"Можете унети до 255 карактера")]
    public $name='';

    #[Validate('required|max:255',message:"Обавезно поље")]
    public $svl='';

    #[Validate('required',message:"Обавезно поље")]
   
    public $short_name='';

    #[Validate('required',message:"Обавезно поље")]
    public $valid='1';
    
    public $file;

    public $id='id';


    public function store()
    {
        $file=$this->storeFile(); 

        $regulation = Regulation::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'name' => $this->name,
                'svl' => $this->svl,
                'short_name' => $this->short_name,
                'valid' => $this->valid,
                'file'=>$file
                
            ]
        );

    }

    public function storeFile() {
        
        if (!$this->file) return null;

        $path=$this->file->store('public/file');//snima fajl

        return basename($path);

    }

}
