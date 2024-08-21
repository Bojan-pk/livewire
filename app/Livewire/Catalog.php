<?php

namespace App\Livewire;

use App\Models\Catalog as ModelsCatalog;
use App\Models\Fm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Katalog')]
class Catalog extends Component

{

    public $searchTerm = '';
    public $activeFm;
    public $catalog;
    public $jobsIds = [];
    public $usualyFmIds = [];
    public $educationIds = [];
    public $conditionIds = [];
    public $experienceIds = [];
    public $activeColapse = 'jobs';

    protected $listeners = [
        'fmCartSelected',
        'saveJobs',
        'saveEducations',
        'saveConditions',
        'saveExperiences'
    ];

    public function mount()
    {
        $this->catalog = ModelsCatalog::first();
    }

    public function fmSelected($fmId)
    {
        $this->activeFm = $fmId;
        $this->catalog = ModelsCatalog::where('fm_id', $fmId)->first();
    }

    public function fmCartSelected($index)
    {
        $cart = session()->get('cart', []);

        $this->jobsIds = isset($cart[$index]['jobs']) ? $cart[$index]['jobs'] : [];
        $this->educationIds = isset($cart[$index]['educations']) ? $cart[$index]['educations'] : [];
        $this->conditionIds = isset($cart[$index]['conditions']) ? $cart[$index]['conditions'] : [];
        $this->experienceIds = isset($cart[$index]['experiences']) ? $cart[$index]['experiences'] : [];
    }


    

    public function saveItem($id, &$array, $collapse)
    {
        if (in_array($id, $array)) {
            $array = array_diff($array, [$id]);
        } else {
            $array[] = $id;
        }
        $this->activeColapse = $collapse;
    }

    public function saveJobs($id)
    {
        $this->saveItem($id, $this->jobsIds, 'jobs');
    }

    public function saveEducations($id)
    {
        $this->saveItem($id, $this->educationIds, 'education');
    }

    public function saveConditions($id)
    {
        $this->saveItem($id, $this->conditionIds, 'condition');
    }

    public function saveExperiences($id)
    {
        $this->saveItem($id, $this->experienceIds, 'experience');
    }


    public function render()
    {

        $results = [];

        if (empty($this->searchTerm)) {

            $results = "";
        } else {
            //dd('radi');
            $keywords = explode(' ', $this->searchTerm);
            $query = Fm::query();
            // Pretraži svaku ključnu reč u polju name
            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            }

            $results = $query->orderBy('name')->take(10)->get();
        }

        return view(
            'livewire.catalog',
            [
                'results' => $results,

            ]
        );
    }
}
