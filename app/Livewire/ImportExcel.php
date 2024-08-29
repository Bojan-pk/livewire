<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VesDataImport; // Vaša klasa za import
use Illuminate\Support\Facades\DB;

class ImportExcel extends Component
{
    use WithFileUploads;

    public $excelFile;

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new VesDataImport, $this->excelFile);

        session()->flash('success', 'Excel file imported successfully.');
    }


    public function render()
    {
        return view('livewire.import-excel');
    }
}
