<?php

namespace App\Livewire\Remembers;

use App\Livewire\Cart;
use App\Models\Condition;
use App\Models\Job;
use Livewire\Component;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class Update extends  Cart
{
   //public $cart = [];
    
    public $rb;
    //public $newJobName;

   /*  public function mount(){
        /* dd($this->selectedFm);
        $this->rb=$this->cart[$this->selectedFm]['rb'];
           $this->newJobName=$this->cart[$this->selectedFm]['newJobName']; 
    } */
   

    public function editItem (){

        $this->cart[$this->selectedFm]['rb']=$this->rb;
       $this->cart[$this->selectedFm]['newJobName']=$this->newJobName;
       
      // Чување старог елемента
       $movedItem = $this->cart[$this->selectedFm];
       // Уклањање елемента из старе позиције
    
       unset($this->cart[$this->selectedFm]);

       array_splice($this->cart, $this->rb - 1, 0, [$movedItem]); // убацује елемент на нову позицију

    // Ажурирање `rb` за сваки елемент
    foreach ($this->cart as $key => $item) {
        $this->cart[$key]['rb'] = $key + 1;
    }

    // Чување у сесији
    session()->put('cart', $this->cart);
    

    }

    public function fmSelected($id)
    {
 //dd($id);
        if ($this->selectedFm != $id) {
            $this->selectedFm = $id;
           $this->rb=$this->cart[$id]['rb'];
           $this->newJobName=$this->cart[$id]['newJobName'];
        } else {
            $this->selectedFm = '';
           // $this->reset('rb','newJobName');
        }
    }

    public function exportToWord()
    {
        // Kreirajte novi PhpWord objekat
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
    

        $phpWord->addParagraphStyle('reducedSpacing', [
            'spaceBefore' => 0, // Razmak pre paragrafa (u tačkama)
            'spaceAfter' => 0,  // Razmak posle paragrafa (u tačkama)
            'lineHeight' => 1.0, // Visina reda (1.0 je standardna visina, manja vrednost smanjuje razmak)
        ]);

        // Naslov
        $section->addTitle("ОПИСИ ПОСЛОВА ФОРМАЦИЈСКИХ МЕСТА", 1);
    
        // Iteracija kroz stavke korpe
        foreach ($this->cart as $item) {
            $section->addText("Радно место: " . ($item['newJobName'] ?? ''));
           
            $jobNames = Job::whereIn('id', $item['jobs'] ?? [])->pluck('name')->toArray();
            $section->addText("Послови: " . implode('; ', $jobNames), null, 'reducedSpacing');

            $conditions = Condition::whereIn('id', $item['conditions'] ?? [])->pluck('name')->toArray();
            $section->addText("Услови: " . implode('; ', $conditions),[ 'italic' => true ]);
            
            $section->addText("Образовање: " . implode(', ', $item['educations'] ?? []));
            
            $section->addText("Искуства: " . implode(', ', $item['experiences'] ?? []));
            $section->addText("Правилници: " . ($item['rulebooks'] ?? ''));
            $section->addText("ВЕС: " . ($item['ves'] ?? ''));
            $section->addTextBreak(1); // Razmak između stavki
        }
    
        // Kreiranje fajla
        $fileName = 'korpa_podaci.docx';
        $filePath = storage_path($fileName);
    
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);
    
        // Download fajla
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        /* $cartItems = $this->countValidCartItems();
        $this->dispatch('cart-items', $cartItems); */
        $this->dispatch('cart-items');
        return view('livewire.remembers.update');
    }
}
