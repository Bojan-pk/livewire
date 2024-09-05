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
        

        $regulation = Regulation::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'name' => $this->name,
                'svl' => $this->svl,
                'short_name' => $this->short_name,
                'valid' => $this->valid,
                //'file'=>$file
                
            ]
        );
        $file=$this->storeFile($regulation->id); 
        $regulation->file=$file;
        //dd($regulation->file=$file);
        $regulation->save();

    }

    public function storeFile($id) {
        
        
        if (!$this->file) return null;
     
        $filename = 'document_' . $id . '.' . $this->file->getClientOriginalExtension();
        $path = $this->file->storeAs('public/file', $filename);//snima fajl

        $this->file="";
        return basename($path);

    }

}
