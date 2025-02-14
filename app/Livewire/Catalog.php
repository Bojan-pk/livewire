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
    public $selectedCategory = '';
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
        'saveUsualyFm',
        'fmSelected'

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
        $this->usualyFm = isset($cart[$index]['newJobName']) ? $cart[$index]['newJobName'] : [];
       // dd($this->usualyFm);
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

    public function saveJobs($id,$indexFm=null)
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


    public function saveEducations($id,$indexFm=null)
    {
        $this->saveItem($id, $this->educationIds, 'education');
    }

    public function saveConditions($id,$indexFm=null)
    {
        $this->saveItem($id, $this->conditionIds, 'condition');
    }

    public function saveExperiences($id,$indexFm=null)
    {
        $this->saveItem($id, $this->experienceIds, 'experience');
    }

    /* protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    } */

   
 protected function highlightKeyword($text, $keyword)
    {
        if (!$keyword) return $text;
    
        // Користимо mb_ereg_replace за рад са ћирилицом и додајемо 'i' флаг за case-insensitive
        return mb_ereg_replace('(' . preg_quote($keyword) . ')', '<mark>\1</mark>', $text, 'i');
    }
    


    /* public function render()
    {

        $fms=Fm::query();

        $keywords = explode(' ', $this->searchTerm);
           $selectedCategory = $this->selectedCategory;
        if (!empty($this->searchTerm)) {

           // $fms = $this->searchByTerm($fms);
          // $keywords = explode(' ', $this->searchTerm);
           //$selectedCategory = $this->selectedCategory;
           $fms = Fm::whereIn('id', function ($query) use ($selectedCategory) {
               $query->select('fm_id')
                   ->from('catalogs')
                   ->join('regulations', 'catalogs.regulation_id', '=', 'regulations.id')  // Join sa regulations tabelom
                   ->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');  // Filtriranje po short_name
           })
               ->where(function ($query) use ($keywords) {
                   foreach ($keywords as $keyword) {
                       $query->orWhere('name', 'LIKE', '%' . $keyword . '%');  // Pretraga po imenu
                   }
               })
               ->orderBy('name')  // Sortiranje po imenu
               ->paginate(10)  // Ograničenje broja rezultata
              // ->get()
               ;

            } else {
                $fms = Fm::whereIn('id', function ($query) use ($selectedCategory) {
                    $query->select('fm_id')
                        ->from('catalogs')
                        ->join('regulations', 'catalogs.regulation_id', '=', 'regulations.id')  // Join sa regulations tabelom
                        ->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');  // Filtriranje po short_name
                })
                    
                    ->orderBy('name')  // Sortiranje po imenu
                    ->paginate(10)  // Ograničenje broja rezultata
                   // ->get()
                    ;
            }
            //$fms = $fms->paginate(10);
        
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
    } */

    public function render()
    {
        $keywords = explode(' ', $this->searchTerm);
        $selectedCategory = $this->selectedCategory;
    
        // Osnovni query za filtriranje i sortiranje
        $fmsQuery = Fm::whereIn('id', function ($query) use ($selectedCategory) {
            $query->select('fm_id')
                ->from('catalogs')
                ->join('regulations', 'catalogs.regulation_id', '=', 'regulations.id')
                ->when($selectedCategory, function ($query, $selectedCategory) {
                    $query->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');
                });
        });
    
        // Dodaj pretragu po ključnim rečima ako postoji
        if (!empty($this->searchTerm)) {
            $fmsQuery->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                }
            });
        }
    
        // Paginacija i sortiranje
        $fms = $fmsQuery->orderBy('name')->paginate(10);


        $catalogsFms = ModelsCatalog::with('fm', 'fms')
        /* ->join('regulations', 'catalogs.regulation_id', '=', 'regulations.id')
        ->when($selectedCategory, function ($query, $selectedCategory) {
            $query->where('regulations.short_name', 'LIKE', '%' . $selectedCategory . '%');
        }) */
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                // Pretraga po FM imenu i FMS imenu
                $query->where(function($query) use ($keyword) {
                    $query->whereHas('fm', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('fms', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                });
            }
        })
        //->orderBy('fms.name')
        ->paginate(10);


    
        // Markiranje rezultata
        $catalogsFms->getCollection()->transform(function ($item) {
            foreach (explode(' ', $this->searchTerm) as $keyword) {
                $item->fm->name = $this->highlightKeyword($item->fm->name, $keyword);
                if ($item->fms) {
                    foreach ($item->fms as $fm) {
                        $fm->name = $this->highlightKeyword($fm->name, $keyword);
                    }
                    //$item->rulebooksTable->name = $this->highlightKeyword($item->rulebooksTable->name, $keywords);
                }
            }
            return $item;
        });
    
        return view('livewire.catalog', [
            'fms' => $fms,
            'catalogsFms'=>$catalogsFms
        ]);
    }

}
