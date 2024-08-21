<?php
namespace App\Livewire\Forms;
use Livewire\Attributes\Validate;
use Livewire\Form;
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

        foreach ($this->table_items as $item) {

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
                ]);
                // Ako postoje promene, ažuriraj regulation_id
                if ($existingRulebook->isDirty()) {
                    $existingRulebook->regulation_id =  $this->regulation_id;
                    $existingRulebook->save();
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
