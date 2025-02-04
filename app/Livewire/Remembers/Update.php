<?php

namespace App\Livewire\Remembers;

use App\Livewire\Cart;
use App\Models\Condition;
use App\Models\Education;
use App\Models\Job;
use Livewire\Component;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\CartExport;
use App\Models\Rulebook;
use Maatwebsite\Excel\Facades\Excel;

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


    public function editItem()
    {

        $this->cart[$this->selectedFm]['rb'] = $this->rb;
        $this->cart[$this->selectedFm]['newJobName'] = $this->newJobName;

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

    public function fmSelectedEdit($index)
    {
        //dd($index);
        if ($this->selectedFm != $index) {
            $this->selectedFm = $index;
           // dd($this->cart);
            @$this->rb = $this->cart[$index]['rb'];
            @$this->newJobName = $this->cart[$index]['newJobName'];
        } else {
            $this->selectedFm = '';
            // $this->reset('rb','newJobName');
        }
    }

    public function exportToExcel()
    {
        //prilagođava cart formaciji
        $itemsFormacy = [];

        foreach ($this->cart as $key => $item) {

            $itemsFormacy[$key]['rb'] = $item['rb'];
            $itemsFormacy[$key]['newJobName'] = $item['newJobName'];
            $itemsFormacy[$key]['ves'] = $item['ves'];
            $rulebooks = Rulebook::find($item['rulebooks']);
            
            //određuje kategoriju kadra na osnovu broja bodova
            $itemsFormacy[$key]['bb'] = '';
            $itemsFormacy[$key]['pg'] = '';
            $itemsFormacy[$key]['fc'] = '';
            $itemsFormacy[$key]['gb'] = '';

            if (@strlen($rulebooks->pg_bb) === 3 && @is_numeric($rulebooks->pg_bb)) {

                $itemsFormacy[$key]['bb'] = $rulebooks->pg_bb;
                $itemsFormacy[$key]['gb'] = $this->grupaBodova($rulebooks->pg_bb);
                /* dd($itemsFormacy[$key]['gb']); */

            } elseif (@strlen($rulebooks->pg_bb) < 3 && @strlen($rulebooks->pg_bb) > 0) {
                
                $itemsFormacy[$key]['pg'] = $rulebooks->pg_bb;
                $itemsFormacy[$key]['fc'] = $rulebooks->fc_sso;
            } 
        }

        return Excel::download(new CartExport($itemsFormacy), 'cart.xlsx');
    }

    protected function grupaBodova($bb){
        
        $groups = [
            1 => ['min' => 938, 'max' => 1000],
            2 => ['min' => 879, 'max' => 937],
            3 => ['min' => 820, 'max' => 878],
            4 => ['min' => 761, 'max' => 819],
            5 => ['min' => 702, 'max' => 760],
            6 => ['min' => 643, 'max' => 701],
            7 => ['min' => 584, 'max' => 642],
            8 => ['min' => 525, 'max' => 583],
            9 => ['min' => 466, 'max' => 524],
            10 => ['min' => 407, 'max' => 465],
            11 => ['min' => 348, 'max' => 406],
            12 => ['min' => 289, 'max' => 347],
            13 => ['min' => 230, 'max' => 288],
            10 => ['min' => 171, 'max' => 229],
            // Dodajte ostale grupe
        ];
    
        foreach ($groups as $groupNumber => $range) {
            if ($bb >= $range['min'] && $bb <= $range['max']) {
                return $groupNumber;
            }
        } 
    }

    public function exportToWord()
    {
        // Kreirajte novi PhpWord objekat
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $phpWord->addParagraphStyle('reducedSpacing', [
            'spaceBefore' => 0, // Razmak pre paragrafa (u tačkama)
            'spaceAfter' => 0,  // Razmak posle paragrafa (u tačkama)
            'lineHeight' => 1.0, // Visina reda (1.0 je standardna visina, manja vrednost smanjuje razmak)
        ]);

        // Naslov
        $phpWord->addTitleStyle(1, ['bold' => true, 'size' => 14]);
        $section->addTitle("ОПИСИ ПОСЛОВА ФОРМАЦИЈСКИХ МЕСТА", 1);

        // Iteracija kroz stavke korpe
        foreach ($this->cart as $item) {
            $section->addText($item['rb'] . '. ' . $item['newJobName'] ?? '', ['bold' => true]);

            $jobNames = Job::whereIn('id', $item['jobs'] ?? [])->pluck('name')->toArray();
            $section->addText(implode('; ', $jobNames), null, 'reducedSpacing');

            $conditions = Condition::whereIn('id', $item['conditions'] ?? [])->pluck('name')->toArray();
            $textRun = $section->addTextRun();
            $textRun->addText("Посебни услови за обављање послова формацијког места:", ['bold' => true, 'italic' => true]);
            $textRun->addText(' ' . implode('; ', $conditions), ['italic' => true]);

           /*  $educations = Education::whereIn('id', $item['educations'] ?? [])->pluck('name')->toArray();
            $textRun->addText('; ' . implode('; ', $educations), ['italic' => true]); */

            /*  $section->addText("Образовање: " . implode(', ', $item['educations'] ?? []));

            $section->addText("Искуства: " . implode(', ', $item['experiences'] ?? []));
            $section->addText("Правилници: " . ($item['rulebooks'] ?? ''));
            $section->addText("ВЕС: " . ($item['ves'] ?? '')); */
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
