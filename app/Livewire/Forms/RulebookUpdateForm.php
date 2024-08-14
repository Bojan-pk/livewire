<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

use App\Models\Catalog;
use App\Models\Condition;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Fm;
use App\Models\Job;
use App\Models\Regulation;
use App\Models\Rulebook;
use App\Models\RulebooksTable;
use Livewire\Attributes\Rule;

class RulebookUpdateForm extends Form
{
    #[Validate('required|max:255')]
    public $table_name='Uprava za organizaciju';

    #[Validate('required|max:255')]
    public $table_rb='1';

    /* #[Validate('array|min:1', message: "Барем једно ФМ морате унети.")] */
    public $table_items = [
        [
            'rb' => '1',
            'fm' => 'referent',
            'fc_sso' => 'pk',
            'pg_bb' => '19',
            'note' => 'napomena',
            'regulation_id' => '',
        ],
    ];

    /*
    
    public $educations = [''];

    
    public $conditions = [''];

    
    public $experiences = [''];

    #[Validate('required')]
    public $jobs = [''];

    public $catalogId = null; 
    */
                   
    #[Validate('required_without:new_regulation', message: "Изаберите или унесите нови документ")]
    public $regulation = null;

    #[Validate('required_without:regulation', message: "Изаберите или унесите нови документ")]
    public $new_regulation='Neka regulativa';


   

    public function customValidate()
    {
        $error = false;

        /* if ($this->fm && Fm::where('name', $this->fm)->exists()) {
            $this->addError('fm', 'Не можете унети формацијско место које већ постоји.');
            $error =true;
        }  */

        if (!$this->hasNonEmptyValue($this->usualy_fms)) {
            $this->addError('usualy_fms', 'Барем једно ФМ морате унети.');
            $error = true;
        }

        if (!$this->hasNonEmptyValue($this->jobs)) {
            $this->addError('jobs', 'Барем један посао морате унети.');
            $error = true;
        }

        return $error;
    }

    public function store()
    {
        //razmisliti o ovome
        $table = RulebooksTable::firstOrCreate([
            'name' => $this->table_name,
            'rb' => $this->table_rb,
        ]);
       
        $tableId = $table->id;
        if ($this->new_regulation) {
            $this->regulation = $this->new_regulation;
        }
        $regulation = Regulation::firstOrCreate(['name' => $this->regulation]);
        
        Rulebook::where('rulebooks_table_id', $tableId)->delete();
        //dd($tableId );
        foreach ($this->table_items as $item) {
            Rulebook::create([
                'rulebooks_table_id' => $tableId,
                'rb' => $item['rb'],
                'fm' => $item['fm'],
                'fc_sso' => $item['fc_sso'],
                'pg_bb' => $item['pg_bb'],
                'note' => $item['note'],
                'regulation_id' => $regulation->id,
                // ... druga polja
            ]);
        }
         }
       //regulation
      
       
        /*  $regulation = Regulation::firstOrCreate(['name' => $this->regulation]);

        //dd($fmId);
        $catalog = Catalog::firstOrCreate(
            ['fm_id' => $fmId],
            ['regulation_id' => $regulation->id]

        );
        // Povezivanje  sa katalogom
        $catalog->fms()->sync($fmIds);
        $catalog->educations()->sync($educationIds);
        $catalog->conditions()->sync($conditionIds);
        $catalog->jobs()->sync($jobIds);
        $catalog->experiences()->sync($experienceIds);
    }
 */


    public function hasNonEmptyValue($array)
    {
        foreach ($array as $value) {
            if (!empty(trim($value))) {
                return true;
            }
        }
        return false;
    }

    protected function makeCleanArray($array)
    {
        // Koristite array_map da izvršite preg_replace na svakom elementu niza
        $array = array_map(function ($q) {
            return $q = preg_replace('/^[^\p{L}\p{N}]+/u', '', $q);
        }, $array);

        // Koristite array_filter da uklonite prazne stringove iz niza
        $array = array_filter($array, function ($value) {
            return !empty($value);
        });

        return array_values($array); // Resetujte indekse niza
    }
}
