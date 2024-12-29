<?php

namespace App\Livewire\Forms;

use App\Models\VesFirstSign;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FirstSignForm extends Form
{
    public $id;

    #[Validate('required', message: "Обавезно поље")]
    #[Validate('integer', message: "Морате унети број")]
    public $order=10;

    #[Validate('required', message: "Обавезно поље")]
    #[Validate('max:1', message: "Морате унети највише 1 карактер")]
    public $sign;

    #[Validate('required', message: "Обавезно поље")]
    public $description;

    #[Validate('required', message: "Обавезно поље")]
    public $regulation_id;

    #[Validate('nullable|regex:/^([\p{Cyrillic}0-9],)*[\p{Cyrillic}0-9]$/u', message: "Погрешан унос")]
    public $rule;
     
    public $note;

    protected function rules() 
    {
        return [
            'rule' => 'nullable|regex:/^([\p{Cyrillic}0-9],)*[\p{Cyrillic}0-9]$/u',
            
        ];
    }
 
    protected function messages() 
    {
        return [
            'rule.regex' => 'Погрешан унос',
           // 'content.min' => 'The :attribute is too short.',
        ];
    }

    public function store()
    {
        //dd($this->svl);
        // Pretvaranje `sign` u veliko slovo
        $this->sign = strtoupper($this->sign);
        VesFirstSign::updateOrCreate(
            [
                'sign' => $this->sign,
            ],
            [
                'order' => $this->order,
                'description' => $this->description,
                'regulation_id' => $this->regulation_id,
                'note' => $this->note,
                'rule' => $this->rule,

            ]
        );
    }
   
    


    public function defaultOrder()
    {
        // Dohvati maksimalni redni broj
        $maxOrder = VesFirstSign::max('order');

        // Izračunaj novi redni broj
        $newSerialNumber = ceil(($maxOrder+1) / 10) * 10;

        // Dodijeli novi redni broj modelu
        $this->order = $newSerialNumber;/*  */
    }
}
