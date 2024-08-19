<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Regulation;
use App\Models\Rulebook;
use App\Models\RulebooksTable;

class RulebookUpdateForm extends Form
{
    #[Validate('required|max:255', message: "Обавезно поље")]
    public $table_name = '';

    #[Validate('required|max:255')]
    public $table_rb = '';
    public $table_id = '';

    public $table_items = [
        [
            'id' => '',
            'rb' => '',
            'fm' => '',
            'fc_sso' => '',
            'pg_bb' => '',
            'note' => '',
            'regulation_id' => '',
        ],
    ];

    #[Validate('required', message: "Обавезан унос")]
    public $regulation_id = null;

    protected function rules()
    {
        return [
            'table_items.*.rb' => 'required',
            'table_items.*.fm' => 'required',
            'table_items.*.fc_sso' => 'required',
            'table_items.*.pg_bb' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'table_items.*.rb.required' => 'Obavezno polje',
            'table_items.*.fm.required' => 'Obavezno polje',
            'table_items.*.fc_sso.required' => 'Obavezno polje',
            'table_items.*.pg_bb.required' => 'Obavezno polje',
        ];
    }

    public function store()
    {

        $table = RulebooksTable::updateOrCreate(
            [
                'id' => $this->table_id,
            ],
            [
                'name' => $this->table_name,
                'rb' => $this->table_rb,
            ]
        );

        $tableId = $table->id;
   
//ovo je staro
        /* Rulebook::where('rulebooks_table_id', $tableId)->delete();
        //dd($tableId );
        foreach ($this->table_items as $item) {
            Rulebook::create([
                'rulebooks_table_id' => $tableId,
                'rb' => $item['rb'],
                'fm' => $item['fm'],
                'fc_sso' => $item['fc_sso'],
                'pg_bb' => $item['pg_bb'],
                'note' => $item['note'],
                'regulation_id' => $this->regulation_id,
            ]);
        }*/

        foreach ($this->table_items as $item) {
            // Pronađi postojeći zapis, ako postoji
           /*  $existingRulebook = Rulebook::where('rulebooks_table_id', $tableId)
                ->where('rb', $item['rb'])
                ->where('fm', $item['fm'])
                ->where('fc_sso', $item['fc_sso'])
                ->where('pg_bb', $item['pg_bb'])
                ->where('note', $item['note'])
                ->first(); */
                
            $existingRulebook = Rulebook::find($item['id']);
        
            if ($existingRulebook) {
                // Ako zapis postoji, proveri da li postoje promene
                $existingRulebook->fill([
                    'rulebooks_table_id' => $tableId,
                    'id' => $item['id'],
                    'rb' => $item['rb'],
                    'fm' => $item['fm'],
                    'fc_sso' => $item['fc_sso'],
                    'pg_bb' => $item['pg_bb'],
                    'note' => $item['note'],
                    // ... druga polja
                ]);
                
                // Ako postoje promene, ažuriraj regulation_id
                if ($existingRulebook->isDirty()) {
                    //dd($existingRulebook);
                    $existingRulebook->regulation_id =  $this->regulation_id;
                    
                $existingRulebook->save();
                //dd($existingRulebook);
                }
        
                
            } else {
                // Ako zapis ne postoji, kreiraj novi
                
                Rulebook::create([
                    'rulebooks_table_id' => $tableId,
                    'rb' => $item['rb'],
                    'fm' => $item['fm'],
                    'fc_sso' => $item['fc_sso'],
                    'pg_bb' => $item['pg_bb'],
                    'note' => $item['note'],
                    'regulation_id' => $this->regulation_id,
                    // ... druga polja
                ]);
            }
        }


    } 
}
