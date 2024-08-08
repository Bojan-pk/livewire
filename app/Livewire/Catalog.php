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
        $directions = session()->get('directions', []);

        $this->jobsIds = isset($directions[$index]['jobs']) ? $directions[$index]['jobs'] : [];
        $this->educationIds = isset($directions[$index]['educations']) ? $directions[$index]['educations'] : [];
        $this->conditionIds = isset($directions[$index]['conditions']) ? $directions[$index]['conditions'] : [];
        $this->experienceIds = isset($directions[$index]['experiences']) ? $directions[$index]['experiences'] : [];
    }


    /* public function saveJobs($id)
    {
        //dd($id);
        if (in_array($id, $this->jobsIds)) {
            $this->jobsIds = array_diff($this->jobsIds, [$id]);
        } else $this->jobsIds[] = $id;

        $this->activeColapse = 'jobs';
    }


    public function saveEducations($id)
    {
        if (in_array($id, $this->educationIds)) {
            $this->educationIds = array_diff($this->educationIds, [$id]);
        } else $this->educationIds[] = $id;

        $this->activeColapse = 'education';
    }

    public function saveConditions($id)
    {
        if (in_array($id, $this->conditionIds)) {
            $this->conditionIds = array_diff($this->conditionIds, [$id]);
        } else $this->conditionIds[] = $id;
        $this->activeColapse = 'condition';
    }

    public function saveExperiences($id)
    {
        if (in_array($id, $this->experienceIds)) {
            $this->experienceIds = array_diff($this->experienceIds, [$id]);
        } else $this->experienceIds[] = $id;
        $this->activeColapse = 'experience';
    } */

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
