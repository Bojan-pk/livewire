<?php

namespace App\Livewire\Forms;

use App\Models\VesCondition;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VesConditionForm extends Form
{
    public $id;

    //#[Validate('required', message: "Обавезно поље")]
    #[Validate('size:5', message: "Морате унети тачно 5 карактера")]
    public $old_ves;

    #[Validate('size:5', message: "Морате унети тачно 5 карактера")]
    public $ves;

    
    #[Validate('required', message: "Обавезно поље")]
    public $condition;

    public $old_alternative;
    public $old_kind;
    public $old_condition;
    public $alternative;

    public function store()
    {
        //dd($this->svl);
        $regulation = VesCondition::updateOrCreate(
            [
                'old_ves' => $this->old_ves,
                'ves' => $this->ves,
            ],
            [
                'old_alternative' => $this->old_alternative,
                'old_kind' => $this->old_kind,
                'old_condition' => $this->old_condition,
                'condition' => $this->condition,
                'alternative' => $this->alternative,

            ]
        );
    }
}
