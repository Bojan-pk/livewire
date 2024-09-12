<?php

namespace App\Livewire\Forms;

use App\Models\VesThirdSign;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ThirdSignForm extends Form
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
    public $ves_second_sign_id;

    #[Validate('required', message: "Обавезно поље")]
    public $regulation_id;

    public $note;



    public function store()
    {
         VesThirdSign::updateOrCreate(
            [
                'sign' => $this->sign,
                'ves_second_sign_id' => $this->ves_second_sign_id
            ],
            [
                'order' => $this->order,
                'description' => $this->description,
                'regulation_id' => $this->regulation_id,
                'note' => $this->note,
                

            ]
        );
    }
    public function defaultOrder()
    {
        // Dohvati maksimalni redni broj
        $maxOrder = VesThirdSign::max('order');

        // Izračunaj novi redni broj
        $newSerialNumber = ceil(($maxOrder+1) / 10) * 10;

        // Dodijeli novi redni broj modelu
        $this->order = $newSerialNumber;/*  */
    }
}
