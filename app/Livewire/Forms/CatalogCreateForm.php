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


class CatalogCreateForm extends Form
{
    #[Rule('required|max:255')]
    public $fm;

    #[Rule('required', message: "Potrebno je uneti nazive fm")]
    public $usualy_fms;

    #[Rule('required')]
    public $educations;

    #[Rule('required')]
    public $conditions;

    #[Rule('required')]
    public $experiences;

    #[Rule('required')]
    public $jobs;

    public $regulation;
    public $new_regulation;

    public function store()
    {
        $fm = Fm::firstOrCreate(['name' => $this->fm]);

        //  usualy_fms 
        $usualy_fms=$this->makeCleanArray($this->usualy_fms);
        $fmIds = [];
        foreach ($usualy_fms as $fmName) {
            $fmId = Fm::firstOrCreate(['name' => $fmName]);
            $fmIds[] = $fmId ->id;
        }
        //education
        $educations=$this->makeCleanArray($this->educations);
        $educatinIds = [];
        foreach ($educations as $educationName) {
            $education = Education::firstOrCreate(['name' => $educationName]);
            $educationIds[] = $education ->id;
        }

         //condition
         $conditions=$this->makeCleanArray($this->conditions);
         $conditionIds = [];
         foreach ($conditions as $conditionName) {
             $condition = Condition::firstOrCreate(['name' => $conditionName]);
             $conditionIds[] = $condition ->id;
         }

         //experiences
         $experiences=$this->makeCleanArray($this->experiences);
         $experienceIds = [];
         foreach ($experiences as $experienceName) {
             $experience = Experience::firstOrCreate(['name' => $experienceName]);
             $experienceIds[] = $experience ->id;
         }

         //jobs
         $jobs=$this->makeCleanArray($this->jobs);
         $jobIds = [];
         foreach ($jobs as $jobName) {
             $job = Job::firstOrCreate(['name' => $jobName]);
             $jobIds[] = $job ->id;
         }

         //regulation
         if ($this->new_regulation) {
            $this->regulation = $this->new_regulation;
        }
        $regulation = Regulation::firstOrCreate(['name' => $this->regulation]);


        $catalog = Catalog::create([
            'fm_id' => $fm->id,
            'regulation_id' => $regulation->id,
            
        ]);
         // Povezivanje  sa katalogom
        $catalog->fms()->attach($fmIds);
        $catalog->educations()->attach( $educationIds);
        $catalog->conditions()->attach( $conditionIds);
        $catalog->jobs()->attach( $jobIds);
        $catalog->experiences()->attach( $experienceIds);
    }

    public function fmValidate()
    {
        if ($this->fm && Fm::where('name', $this->fm)->exists()) {
            $this->addError('fm', 'Не можете унети формацијско место које већ постоји.');
            return true;
        } else false;
    }

    protected function makeCleanArray($string)
    {
        $array = explode(';', $string);

        $array = array_map(function($q) {
            return preg_replace('/^[^\p{L}]+/u', '', $q);
        }, $array);


        return $array;
    }
}
