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
            'rb' => '',
            'fm' => '',
            'fc_sso' => '',
            'pg_bb' => '',
            'note' => '',
            'regulation_id' => '',
        ],
    ];

    #[Validate('required_without:new_regulation', message: "Изаберите или унесите нови документ")]
    public $regulation = null;

    #[Validate('required_without:regulation', message: "Изаберите или унесите нови документ")]
    public $new_regulation = '';

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
        if ($this->new_regulation) {
            $this->regulation = $this->new_regulation;
        }

        $regulation = Regulation::firstOrCreate([
            'name' => $this->regulation,
            'short_name' => 'Elementi FM'
        ]);

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
            ]);
        }
    }
}
