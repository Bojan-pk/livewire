<?php

namespace App\Livewire\Forms;

use App\Models\Regulation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegulationForm extends Form
{
    #[Validate('required', message: "Обавезно поље")]
    #[Validate('max:255', message: "Можете унети до 255 карактера")]
    public $name = '';

    #[Validate('required|max:255', message: "Обавезно поље")]
    public $svl = '';

    #[Validate('required', message: "Обавезно поље")]

    public $short_name = '';

    #[Validate('required', message: "Обавезно поље")]
    public $valid = '1';

    /* #[Validate('required', message: "Обавезно поље")] */
    public $file;

    public $uploadedFile;

    public $id = 'id';


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
        $file = $this->storeFile($regulation->id);
        $regulation->file = $file;
        //dd($regulation->file=$file);
        $regulation->save();
    }

    public function rules()
    {
        return [
            'uploadedFile' => $this->file? 'nullable' : 'required|file|max:2048', // Ako $fileName postoji, validacija za 'uploadedFile' postaje 'nullable'
        ];
    }


    public function storeFile($id)
    {
        
        if ($this->uploadedFile) {
            //dd($this->uploadedFile);
            $filename = 'document_' . $id . '.' . $this->uploadedFile->getClientOriginalExtension();
            $path = $this->uploadedFile->storeAs('public/file', $filename); //snima fajl

            $this->uploadedFile = "";
            return basename($path);
        } else return $this->file;
       
    }
}
