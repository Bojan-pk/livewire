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

    #[Rule('required')]
    public $usualy_fms;

    #[Rule('required')]
    public $educations;

    //#[Rule('required')]
    public $conditions;

    //#[Rule('required')]
    public $experiences;

    #[Rule('required')]
    public $jobs;

    #[Validate('required')]
    public $regulation;
    /* public $new_regulation; */

    public function store()
    {

        $usualy_fms = $this->makeCleanArray($this->usualy_fms);
        $educations = $this->makeCleanArray($this->educations);
        $conditions = $this->makeCleanArray($this->conditions);
        $experiences = $this->makeCleanArray($this->experiences);
        $jobs = $this->makeCleanArray($this->jobs);

        // Validacija dužine pojedinačnih vrednosti
        foreach ($usualy_fms as $fmName) {
            if (mb_strlen($fmName) > 255) {
                $this->addError('usualy_fms', "Име формацијског места '{$fmName}' не сме прећи 255 карактера.");
                return true;
            }
        }

        foreach ($educations as $educationName) {
            if (mb_strlen($educationName) > 255) {
                $this->addError('educations', "Назив образовања '{$educationName}' не сме прећи 255 карактера.");
                return true;
            }
        }

        foreach ($conditions as $conditionName) {
            if (mb_strlen($conditionName) > 255) {
                $this->addError('conditions', "Назив услова '{$conditionName}' не сме прећи 255 карактера.");
                return true;
            }
        }

        foreach ($experiences as $experienceName) {
            if (mb_strlen($experienceName) > 255) {
                $this->addError('experiences', "Назив искуства '{$experienceName}' не сме прећи 255 карактера.");
                return true;
            }
        }

        foreach ($jobs as $jobName) {
            if (mb_strlen($jobName) > 600) {
                $this->addError('jobs', "Назив посла '{$jobName}' не сме прећи 600 карактера.");
                return true;
            }
        }


        //$fm = Fm::firstOrCreate(['name' => $this->fm]);
        $fm = Fm::create(['name' => $this->fm]);

        //  usualy_fms 
        //$usualy_fms=$this->makeCleanArray($this->usualy_fms);
        $fmIds = [];
        foreach ($usualy_fms as $fmName) {
            $fmId = Fm::firstOrCreate(['name' => $fmName]);
            $fmIds[] = $fmId->id;
        }
        //education
        //$educations=$this->makeCleanArray($this->educations);
        $educationIds = [];
        foreach ($educations as $educationName) {
            $education = Education::firstOrCreate(['name' => $educationName]);
            $educationIds[] = $education->id;
        }

        //condition
        //$conditions=$this->makeCleanArray($this->conditions);
        $conditionIds = [];
        foreach ($conditions as $conditionName) {
            $condition = Condition::firstOrCreate(['name' => $conditionName]);
            $conditionIds[] = $condition->id;
        }

        //experiences
        //$experiences=$this->makeCleanArray($this->experiences);
        $experienceIds = [];
        foreach ($experiences as $experienceName) {
            $experience = Experience::firstOrCreate(['name' => $experienceName]);
            $experienceIds[] = $experience->id;
        }

        //jobs
        //$jobs=$this->makeCleanArray($this->jobs);
        $jobIds = [];
        foreach ($jobs as $jobName) {
            $job = Job::firstOrCreate(['name' => $jobName]);
            $jobIds[] = $job->id;
        }


        //$regulation = Regulation::firstOrCreate(['name' => $this->regulation]);


        $catalog = Catalog::create([
            'fm_id' => $fm->id,
            'regulation_id' => $this->regulation,

        ]);
        // Povezivanje  sa katalogom
        /*  $experienceIds = $experienceIds ?? []; // Ako je $experienceIds null, postavlja se na prazan niz
       $conditionIds = $conditionIds ?? []; */


        $catalog->fms()->attach($fmIds);
        $catalog->educations()->attach($educationIds);
        $catalog->conditions()->attach($conditionIds);
        $catalog->jobs()->attach($jobIds);
        $catalog->experiences()->attach($experienceIds);
    }

    public function fmValidate()
    {
        if ($this->fm && Fm::where('name', $this->fm)->exists()) {
            $fm_id = Fm::where('name', $this->fm)->first()->id;
            if (Catalog::where('fm_id', $fm_id)->exists() &&
             Catalog::where('fm_id', $fm_id)->first()->regulation->short_name == Regulation::find($this->regulation)->short_name)
              {
                $this->addError('fm', 'Не можете унети формацијско место које већ постоји.');
                return true;
            } else return false;
        } else false;
    }

    protected function makeCleanArray($string)
    {
        $array = explode(';', $string);

        $array = array_map(function ($q) {
            return preg_replace('/^[^\p{L}]+/u', '', $q);
        }, $array);


        return $array;
    }
}
