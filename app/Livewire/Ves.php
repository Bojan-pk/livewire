<?php

namespace App\Livewire;

use App\Models\VesCondition;
use App\Models\VesFifthSign;
use App\Models\VesFirstSign;
use App\Models\VesFourthSign;
use App\Models\VesSecondSign;
use App\Models\VesThirdSign;
use Livewire\Component;

class Ves extends Component
{
    public $firstSign;
    public $secondSign;
    public $thirdSign;
    public $fourthSign;
    public $fifthSign;

    public $ves_first_signs;
    public $ves_second_signs;
    public $ves_third_signs;
    public $ves_fourth_signs;
    public $ves_fifth_signs;

    public $vesId;

    public $combinedVes = '';

    protected $listeners = [
        'saveVes',
        'fmCartSelected',
    ];

    public function mount()
    {
        $this->ves_first_signs = VesFirstSign::orderBy('order')->get();
        $this->ves_second_signs = VesSecondSign::orderBy('order')->get();
        $this->ves_fifth_signs = VesFifthSign::orderBy('order')->get();
    }

    public function saveVes($id)
    {
        if ($this->vesId != $id) $this->vesId = $id;
        else $this->vesId = '';
    }

    public function cleanForm()
    {
        $this->reset(
           'firstSign',
           'secondSign',
           'thirdSign',
           'fourthSign',
           'fifthSign',
           'combinedVes'
        );

        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);

        $this->vesId = isset($cart[$index]['rulebooks']) ? $cart[$index]['rulebooks'] : '';
    }

    public function updatedSecondSign($value)
    {
        $this->ves_third_signs = VesThirdSign::where('ves_second_sign_id', $value)->orderBy('order')->get();
        $this->ves_fourth_signs = '';
    }
    public function updatedThirdSign($value)
    {
        $this->ves_fourth_signs = VesFourthSign::where('ves_third_sign_id', $value)->orderBy('order')->get();
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'combinedVes') {
            $this->combineVes();
        }
    }

    public function combineVes()
    {
        $this->combinedVes =
            (@VesFirstSign::find($this->firstSign)->sign ?: '*') .
            (@VesSecondSign::find($this->secondSign)->sign ?: '*') .
            (@VesThirdSign::find($this->thirdSign)->sign ?: '*') .
            (@VesFourthSign::find($this->fourthSign)->sign ?: '*') .
            (@VesFifthSign::find($this->fifthSign)->sign ?: '*');
    }

    public function updatedCombinedVes()
    {
        $characters = mb_str_split($this->combinedVes);
        //1
        $this->firstSign = @VesFirstSign::where('sign', $characters[0])->first()->id ?? '';
        // 2
        $this->secondSign = @VesSecondSign::where('sign', $characters[1])->first()->id ?? '';
        $this->updatedSecondSign($this->secondSign);
        // 3
        $this->thirdSign = @VesThirdSign::where('sign', $characters[2])->where('ves_second_sign_id', $this->secondSign)->first()->id ?? '';
        $this->updatedThirdSign($this->thirdSign);
        //4
        $this->fourthSign = @VesFourthSign::where('sign', $characters[3])->where('ves_third_sign_id', $this->thirdSign)->first()->id ?? '';
        //5
        $this->fifthSign = @VesFifthSign::where('sign', $characters[4])->first()->id ?? '';
    }

    public function render()
    {
        $searchTerm = str_replace('*', '', $this->combinedVes);
        $ves_conditions = VesCondition::where('ves', 'LIKE', '%' . $searchTerm . '%')
            ->orderBy('rb')
            ->paginate(15);

        return view('livewire.ves', [
            'ves_conditions' => $ves_conditions
        ]);
    }
}
