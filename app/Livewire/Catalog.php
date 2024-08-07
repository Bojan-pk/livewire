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
    public $activeColapse = 'jobs';

    protected $listeners = [
        'fmCartSelected',
        'saveJobs',
        'saveEducations',
        'saveConditions'
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

        //dd($index);

        $directions = session()->get('directions', []);

        if (@$directions[$index]['jobs']) {
            $this->jobsIds = $directions[$index]['jobs'];
        } else $this->jobsIds = [];

        if (@$directions[$index]['educations']) {
            $this->jobsIds = $directions[$index]['educations'];
        } else $this->educationIds = [];

        if (@$directions[$index]['conditions']) {
            $this->jobsIds = $directions[$index]['conditions'];
        } else $this->conditionIds = [];
    }

    public function updatedJobsIds()
    {
        dd('radi');
        // Ova metoda se poziva svaki put kada se $jobsIds ažurira
        $this->emit('jobsIdsUpdated', $this->jobsIds);
    }

    public function saveJobs($id)
    {
        //dd($id);
        if (in_array($id, $this->jobsIds)) {
            $this->jobsIds = array_diff($this->jobsIds, [$id]);
            //session()->put('saved_items', $this->savedItems);
        } else $this->jobsIds[] = $id;

        // Emituj događaj sa informacijama o selektovanoj stavci
        // $this->dispatch('saveJobs', $id);

        $this->activeColapse = 'jobs';
    }

    public function saveUsualyFms($id)
    {
        if (in_array($id, $this->usualyFmIds)) {
            $this->usualyFmIds = array_diff($this->usualyFmIds, [$id]);
            //session()->put('saved_items', $this->savedItems);
        } else $this->usualyFmIds[] = $id;

        $this->activeColapse = 'usualyFms';
    }

    public function saveEducations($id)
    {
        //dd('stiglo');
        if (in_array($id, $this->educationIds)) {
            $this->educationIds = array_diff($this->educationIds, [$id]);
            //session()->put('saved_items', $this->savedItems);
        } else $this->educationIds[] = $id;

        $this->activeColapse = 'education';
    }

    public function saveConditions($id)
    {
        //dd('stiglo');
        if (in_array($id, $this->conditionIds)) {
            $this->conditionIds = array_diff($this->conditionIds, [$id]);
            //session()->put('saved_items', $this->savedItems);
        } else $this->conditionIds[] = $id;

        $this->activeColapse = 'condition';
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
