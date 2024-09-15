<?php

namespace App\Livewire;
use App\Models\VesCondition;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class VesConversion extends Component
{
    public $code1;
    public $code2;
    public $code3;
    public $code4;
    public $code5;
    public $ves_conditions;
 
public function updatedCode5($code) {
    
    $oldVes=$this->code1.$this->code2.$this->code3.$this->code4.$this->code5;
    $this->ves_conditions=VesCondition::where('old_ves',$oldVes)->get();
    
    if (mb_strlen($oldVes)==5 && !count($this->ves_conditions)) session()->flash('error', 'Непостојећи ВЕС/ЕС');
}

public function cleanCode()  {
    $this->reset('code1','code2','code3','code4','code5');
    $this->dispatch('setFocus');
}

    public function render()
    {
        return view('livewire.ves-conversion');
    }
}
