<?php

namespace App\Livewire\Forms;

use App\Models\VesSecondSign;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SecondSignForm extends Form
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

    public $note;



    public function store()
    {
        //dd($this->svl);
        $regulation = VesSecondSign::updateOrCreate(
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
    public function defaultOrder()
    {
        // Dohvati maksimalni redni broj
        $maxOrder = VesSecondSign::max('order');

        // Izračunaj novi redni broj
        $newSerialNumber = ceil(($maxOrder+1) / 10) * 10;

        // Dodijeli novi redni broj modelu
        $this->order = $newSerialNumber;/*  */
    }
}
