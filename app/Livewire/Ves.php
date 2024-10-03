<?php

namespace App\Livewire;

use App\Livewire\Ves\FifthSign;
use App\Models\VesCondition;
use App\Models\VesFifthSign;
use App\Models\VesFirstSign;
use App\Models\VesFourthSign;
use App\Models\VesSecondSign;
use App\Models\VesThirdSign;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('VES/ES')]
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

    public $ves;

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
        $this->ves_third_signs =  collect();
        $this->ves_fourth_signs =  collect();
        $this->ves_fifth_signs =  collect();
        
    }

    public function saveVes($ves)
    {
        if ($this->ves != $ves) $this->ves = $ves;
        else $this->ves = '';
    }

    public function cleanForm()
    {
        $this->resetExcept('ves_first_signs', 'ves_second_signs', 'ves_fifth_signs');
        session()->flash('success', 'Обрисана је форма за унос');
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);
        $this->ves = isset($cart[$index]['rulebooks']) ? $cart[$index]['rulebooks'] : '';
    }

    public function updatedFirstSign($sign)
    {
        $this->firstSign = mb_strtoupper($sign, 'UTF-8');
        
       //dd($rule);
        
        if(@$rule=VesFirstSign::where('sign',$this->firstSign)->first()->rule){
            $fifthSignsArray=array_map('trim', explode(',', $rule));
            $this->ves_fifth_signs = VesFifthSign::whereIn('sign',$fifthSignsArray)->orderBy('order')->get();  
        } else {
            $this->ves_fifth_signs = collect();
        }
    }

    public function updatedSecondSign($sign)
    {
        $this->secondSign = mb_strtoupper($sign, 'UTF-8');  
        @$ves_second_sign_id = VesSecondSign::whereIn('sign', [$sign, '0'])->pluck('id');

        $this->ves_third_signs = VesThirdSign::whereIn('ves_second_sign_id', $ves_second_sign_id)->orderBy('order')->get();
        $this->ves_fourth_signs = collect();
        $this->reset('thirdSign', 'fourthSign');
    }

    public function updated(){
        $this->resetPage();
    }

    public function updatedThirdSign($sign)
    {
        $this->thirdSign = mb_strtoupper($sign, 'UTF-8');  
        @$ves_third_sign_id = $this->ves_third_signs->whereIn('sign', [$sign, '0'])->pluck('id');
        $this->ves_fourth_signs = VesFourthSign::whereIn('ves_third_sign_id', $ves_third_sign_id)->orderBy('order')->get();
        $this->reset('fourthSign');
    }
    public function updatedFourthSign($sign)
    {
        $this->fourthSign = mb_strtoupper($sign, 'UTF-8');  
    }

    public function updatedFifthSign($sign)
    {
        $this->fifthSign = mb_strtoupper($sign, 'UTF-8');  
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

    protected function highlightKeyword($text, $keyword)
    {
        if (!$keyword) return $text;
    
        // Користимо mb_ereg_replace за рад са ћирилицом и додајемо 'i' флаг за case-insensitive
        return mb_ereg_replace('(' . preg_quote($keyword) . ')', '<mark>\1</mark>', $text, 'i');
    }
    
    protected function highlightVes($ves)
    {
        // Низ унетих знакова које треба маркирати
        $signs = [$this->firstSign, $this->secondSign, $this->thirdSign, $this->fourthSign, $this->fifthSign];
    
        // Претварамо вес у низ да бисмо обрадили сваки знак појединачно
        $markedVes = '';
    
        // Прођемо кроз сваки знак у низу вес
        for ($i = 0; $i < mb_strlen($ves); $i++) {
            $currentChar = mb_substr($ves, $i, 1);
            
            // Ако постоји одговарајући знак у $signs на истој позицији и подудара се
            if (isset($signs[$i]) && $currentChar == $signs[$i]) {
                // Маркирамо тај знак
                $markedVes .= '<mark>' . $currentChar . '</mark>';
            } else {
                // Додајемо немаркирани знак
                $markedVes .= $currentChar;
            }
        }
    
        return $markedVes;
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

    protected function combineVes()
    {
        return  $this->firstSign.$this->secondSign.$this->thirdSign.$this->fourthSign. $this->fifthSign;
    }

    protected function readVes()
{
    // Čita VES 
    $readVes = "";

    // 1. znak
    $sign1 = VesFirstSign::where('sign', $this->firstSign)->first();
    if (!$sign1) return false;
    $readVes .= $sign1->description;

    // 2. znak
    $sign2 = VesSecondSign::where('sign', $this->secondSign)->first();
    if (!$sign2) return false;
    $readVes .= " - " . $sign2->description;

    // 3. znak
    $ves_second_sign_id = $sign2->id;
    $sign3 = VesThirdSign::where('sign', $this->thirdSign)
                          ->where('ves_second_sign_id', $ves_second_sign_id)
                          ->first();
    if (!$sign3) return false;
    $readVes .= " - " . $sign3->description;

    // 4. znak
    $ves_third_sign_id = $sign3->id;
    $sign4 = VesFourthSign::where('sign', $this->fourthSign)
                          ->where('ves_third_sign_id', $ves_third_sign_id)
                          ->first();
    if (!$sign4) return false;
    $readVes .= " - " . $sign4->description;

    // 5. znak
    $rule = $sign1->rule;
    $fifthSignsArray = array_map('trim', explode(',', $rule));

    $sign5 = VesFifthSign::where('sign', $this->fifthSign)
                         ->whereIn('sign', $fifthSignsArray)
                         ->first();
    if (!$sign5) return false;
    $readVes .= " - " . $sign5->description;

    return $readVes;
}


    public function render()
    {
        $ves_conditions = VesCondition::query();
    
        if (!empty($this->searchTerm)) {
            $ves_conditions = $this->searchByTerm($ves_conditions);
        }
    
        $ves_conditions = $this->searchByVes($ves_conditions)->orderBy('rb')->paginate(15);
    // Примени маркирање на резултате
    /* $ves_conditions->getCollection()->transform(function ($item) {
        $item->ves = $this->highlightVes($item->ves);
        return $item;
    }); */

    if ($ves_conditions->isEmpty()&&  mb_strlen($this->combineVes(), 'UTF-8')==5) {
        // Ukoliko nema zapisa, dodaj novi sa željenom vrednošću za polje 'ves'
        // Pretpostavljamo da 'ves' i ostala polja treba da imaju određene vrednosti
        $newVesCondition = new VesCondition([
            'ves' => $this->combineVes(), // Postavi odgovarajuću vrednost za ves
            'reading'=> $this->readVes(),
            'rb' => 1, // Primer dodatnog polja
            // Dodaj vrednosti za ostala potrebna polja
        ]);
    
        // Ručno dodaj novi objekat u kolekciju ili ga sačuvaj u bazi
        $ves_conditions->push($newVesCondition);
    }

        // Примени маркирање на резултате
        $ves_conditions->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchTerm) as $keyword) {
                $item->reading = $this->highlightKeyword($item->reading, $keyword);
                $item->condition = $this->highlightKeyword($item->condition, $keyword);
                $item->ves = $this->highlightVes($item->ves);
            }
            return $item;
        });
    
        return view('livewire.ves', [
            'ves_conditions' => $ves_conditions
        ]);
    }
    

}
