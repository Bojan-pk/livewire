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
use Livewire\Attributes\Rule;

class CatalogUpdateForm extends Form
{
   
    #[Rule('required', message: "Поље мора бити попуњено")]
    public $fm;

    #[Rule('required|max:255')]
    public $usualy_fms = [''];

    
    public $educations = [''];


    public $conditions = [''];


    public $experiences = [''];

    #[Rule('required|max:255')]
    public $jobs = [''];

    public $catalogId = null;

    #[Rule('required')]
    public $regulation;

    /*  #[Validate('required_without:regulation', message: "Изаберите или унесите нови документ")]
    public $new_regulation; */

    protected $rules = [
        //'educations' => 'required|array|min:1', // Niz mora postojati i imati najmanje jednu stavku
        'educations.*' => 'required|string',   // Svaka stavka mora biti ne-prazan string
        'usualy_fms.*' => 'required|string',   // Svaka stavka mora biti ne-prazan string
        'jobs.*' => 'required|string|max:255',   // Svaka stavka mora biti ne-prazan string
    ];

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
        $fm = Fm::firstOrCreate(['name' => $this->fm]);
        $fmId = $fm->id;
        //  usualy_fms 
        //dd($this->usualy_fms);

        $usualy_fms = $this->makeCleanArray($this->usualy_fms);
        //dd($usualy_fms);

        //$fmIds = [];
        foreach ($usualy_fms as $fmName) {
            $fm = Fm::firstOrCreate(['name' => $fmName]);
            $fmIds[] = $fm->id;
        }
        //education
        $educations = $this->makeCleanArray($this->educations);
        // $educationIds = [];
        foreach ($educations as $educationName) {
            $education = Education::firstOrCreate(['name' => $educationName]);
            $educationIds[] = $education->id;
        }


        //condition
        $conditions = $this->makeCleanArray($this->conditions);
        // $conditionIds = [];
        foreach ($conditions as $conditionName) {
            $condition = Condition::firstOrCreate(['name' => $conditionName]);
            $conditionIds[] = $condition->id;
        }

        //experiences
        $experiences = $this->makeCleanArray($this->experiences);
        //$experienceIds = [];
        foreach ($experiences as $experienceName) {
            $experience = Experience::firstOrCreate(['name' => $experienceName]);
            $experienceIds[] = $experience->id;
        }

        //jobs
        $jobs = $this->makeCleanArray($this->jobs);
        // $jobIds = [];
        foreach ($jobs as $jobName) {
            $job = Job::firstOrCreate(['name' => $jobName]);
            $jobIds[] = $job->id;
        }

        //regulation
        /* if ($this->new_regulation) {
            $this->regulation = $this->new_regulation;
        } */


        /* $regulation = Regulation::firstOrCreate([
            'name' => $this->regulation,
            'short_name' => 'Katalog FM'
        ]); */

        //dd($fmId);
        $catalog = Catalog::firstOrCreate(
            ['fm_id' => $fmId],
            ['regulation_id' => $this->regulation]

        );
        // Povezivanje  sa katalogom
        $catalog->fms()->sync($fmIds);
        $catalog->educations()->sync($educationIds);
        $catalog->conditions()->sync($conditionIds);
        $catalog->jobs()->sync($jobIds);
        $catalog->experiences()->sync($experienceIds);
    }


    public function messages()
    {
        return [
            /* 'educations.required' => 'Морате додати најмање једно образовање.',
            'educations.min' => 'Морате додати најмање једно образовање.', */
            'educations.*.required' => 'Поље мора бити попуњено.',
            'usualy_fms.*.required' => 'Поље мора бити попуњено.',
            'jobs.*.required' => 'Поље мора бити попуњено.',
           // usualy_fms
        ];
    }
    


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
