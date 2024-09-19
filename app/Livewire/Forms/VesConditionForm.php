<?php

namespace App\Livewire\Forms;

use App\Models\VesCondition;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VesDataImport; // Vaša klasa za import
use Livewire\Form;

class VesConditionForm extends Form
{
    public $id;
    public $rb;
    use WithFileUploads;
    
    //#[Validate('required', message: "Обавезно поље")]
    //#[Validate('required_without:excelFile', message: "Обавезан унос")]
    #[Validate('size:5', message: "Морате унети тачно 5 карактера")]
    public $old_ves;

   // #[Validate('required_without:excelFile', message: "Обавезан унос")]
    #[Validate('size:5', message: "Морате унети тачно 5 карактера")]
    public $ves;

    public $reading;

   // #[Validate('required_without:excelFile', message: "Обавезан унос")]
    #[Validate('required', message: "Обавезно поље")]
    public $condition;
   
    #[Validate('required', message: "Обавезно поље")]
    public $regulation_id;
    public $note;
    public $excelFile;
    public $old_alternative;
    public $old_kind;
    public $old_condition;
    public $alternative;

    public function store()
    {
        //dd($this->svl);
        VesCondition::updateOrCreate(
            [
                'old_ves' => $this->old_ves,
                'ves' => $this->ves,
            ],
            [
                'old_alternative' => $this->old_alternative,
                'rb' => $this->rb,
                'old_kind' => $this->old_kind,
                'old_condition' => $this->old_condition,
                'condition' => $this->condition,
                'alternative' => $this->alternative,
                'reading' => $this->reading,
                'regulation_id' => $this->regulation_id,
                'note' => $this->note,
            ]
        );
    }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
            'regulation_id' => 'required',
        ]);
        try {
        Excel::import(new VesDataImport($this->regulation_id,$this->note), $this->excelFile);

       // session()->flash('success', 'Excel file imported successfully.');
       session()->flash('success', 'Подаци су успешно унети');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Obradi specifične greške validacije iz Excel-a
        $failures = $e->failures();
        foreach ($failures as $failure) {
            $errorMessage = "Row {$failure->row()} failed with error: " . implode(', ', $failure->errors());
            session()->flash('error', $errorMessage);
        }

    } catch (\Exception $e) {
        // Uhvati bilo koju drugu grešku
        session()->flash('error', 'Јавила се грешка у току учитавања података: ' . $e->getMessage());
    }
    }

    
}
