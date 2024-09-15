<?php

namespace App\Livewire;

use App\Models\VesCondition;
use App\Models\VesFifthSign;
use App\Models\VesFirstSign;
use App\Models\VesFourthSign;
use App\Models\VesSecondSign;
use App\Models\VesThirdSign;
use Livewire\Component;
use Livewire\WithPagination;

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

    //public $combinedVes = '';
    public $searchTerm = '';
    use WithPagination;
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
        $this->resetExcept('ves_first_signs', 'ves_second_signs', 'ves_fifth_signs');
        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);
        $this->vesId = isset($cart[$index]['rulebooks']) ? $cart[$index]['rulebooks'] : '';
    }

    public function updatedSecondSign($sign)
    {
        @$ves_second_sign_id = VesSecondSign::whereIn('sign', [$sign, '0'])->pluck('id');

        $this->ves_third_signs = VesThirdSign::whereIn('ves_second_sign_id', $ves_second_sign_id)->orderBy('order')->get();
        $this->ves_fourth_signs = null;
        $this->reset('thirdSign', 'fourthSign');
    }

    public function updated(){
        $this->resetPage();
    }

    public function updatedThirdSign($sign)
    {
        @$ves_third_sign_id = $this->ves_third_signs->whereIn('sign', [$sign, '0'])->pluck('id');
        $this->ves_fourth_signs = VesFourthSign::whereIn('ves_third_sign_id', $ves_third_sign_id)->orderBy('order')->get();
        $this->reset('fourthSign');
    }

    protected function searchByVes($query)
    {
        if ($this->firstSign != null) $query->whereRaw('SUBSTRING(ves, 1, 1) = ?', [$this->firstSign]);
        if ($this->secondSign != null) $query->whereRaw('SUBSTRING(ves, 2, 1) = ?', [$this->secondSign]);
        if ($this->thirdSign != null) $query->whereRaw('SUBSTRING(ves, 3, 1) = ?', [$this->thirdSign]);
        if ($this->fourthSign != null) $query->whereRaw('SUBSTRING(ves, 4, 1) = ?', [$this->fourthSign]);
        if ($this->fifthSign != null) $query->whereRaw('SUBSTRING(ves, 5, 1) = ?', [$this->fifthSign]);

        return $query;
    }

    protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('reading', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('condition', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }


    public function render()
    {
        $ves_conditions = VesCondition::query();

        if (!empty($this->searchTerm)) $ves_conditions = $this->searchByTerm($ves_conditions);
        $ves_conditions = $this->searchByVes($ves_conditions)->orderBy('rb')->paginate(15);

        return view('livewire.ves', [
            'ves_conditions' => $ves_conditions
        ]);
    }
}
