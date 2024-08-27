<?php

namespace App\Livewire\Forms;

use App\Models\VesFourthSign;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FourthSignForm extends Form
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

    
   // public $ves_second_sign_id;

    #[Validate('required', message: "Обавезно поље")]
    public $ves_third_sign_id;

    public $selectSecondSign;

    public $note;

    


    public function store()
    {
       // dump('store');
        $regulation = VesFourthSign::updateOrCreate(
            [
                'sign' => $this->sign,
                //'ves_second_sign_id' => $this->ves_second_sign_id,
                'ves_third_sign_id' => $this->ves_third_sign_id,
            ],
            [
                'order' => $this->order,
                'description' => $this->description,
                'note' => $this->note,
                

            ]
        );
    }
    public function defaultOrder()
    {
        // Dohvati maksimalni redni broj
        $maxOrder = VesFourthSign::max('order');

        // Izračunaj novi redni broj
        $newSerialNumber = ceil(($maxOrder+1) / 10) * 10;

        // Dodijeli novi redni broj modelu
        $this->order = $newSerialNumber;/*  */
    }
}
