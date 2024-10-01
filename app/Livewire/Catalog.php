<?php

namespace App\Livewire;

use App\Models\Catalog as ModelsCatalog;
use App\Models\Fm;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Katalog')]
class Catalog extends Component

{

    public $searchTerm = '';
    public $activeFm;
    public $catalog;
    public $jobsIds = [];
   // public $usualyFmIds = [];
    public $usualyFm;



    public $educationIds = [];
    public $conditionIds = [];
    public $experienceIds = [];
    public $activeColapse = 'jobs';

    protected $listeners = [
        'fmCartSelected',
        'saveJobs',
        'saveEducations',
        'saveConditions',
        'saveExperiences',
        'saveUsualyFm'
    ];
    use WithPagination;
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
        //dd($array);
    }

    public function saveJobs($id)
    {
        $this->saveItem($id, $this->jobsIds, 'jobs');
    }
    public function saveUsualyFm($value)
    {
        $this->activeColapse = 'usualyFms';
        if($this->usualyFm!=$value) $this->usualyFm=$value;
        else $this->usualyFm='';
        //$this->usualyFm=$value;
        // dd($value);
       // $this->saveItem($value, $this->usualyFm, 'usualyFms');
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

    protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }

   
 protected function highlightKeyword($text, $keyword)
    {
        if (!$keyword) return $text;
    
        // Користимо mb_ereg_replace за рад са ћирилицом и додајемо 'i' флаг за case-insensitive
        return mb_ereg_replace('(' . preg_quote($keyword) . ')', '<mark>\1</mark>', $text, 'i');
    }
    


    public function render()
    {

        $fms=Fm::query();

        if (!empty($this->searchTerm)) {

            $fms = $this->searchByTerm($fms);
            }
            $fms = $fms->paginate(10);
        
             // Примени маркирање на резултате
        $fms->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchTerm) as $keyword) {
                $item->name = $this->highlightKeyword($item->name, $keyword);
               
            }
            return $item;
        });

        return view(
            'livewire.catalog',
            [
                'fms' => $fms,

            ]
        );
    }
}
