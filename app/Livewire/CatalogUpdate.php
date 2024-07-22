<?php

namespace App\Livewire;

use Livewire\Component;

use App\Livewire\Forms\CatalogUpdateForm;
use App\Models\Catalog;
use App\Models\Regulation;

class CatalogUpdate extends Component
{
    public CatalogUpdateForm $form;
    public $regulations=[];
    public $catalog;

    protected $listeners=[
        'fmSelected'=>'fmSelected'
    ];

    public function fmSelected($fmId){
       
        if($catalog=Catalog::where('fm_id',$fmId)->first())
    {
        $this->form->fm=$catalog->fm->name;
        $this->form->usualy_fms=$catalog->fms->pluck('name')->toArray();
        $this->form->educations=$catalog->educations->pluck('name')->toArray();  
        $this->form->conditions=$catalog->conditions->pluck('name')->toArray();  
        $this->form->experiences=$catalog->experiences->pluck('name')->toArray();  
        $this->form->jobs=$catalog->jobs->pluck('name')->toArray();  
        $this->form->regulation=$catalog->regulation->name;  

    } else return session()->flash('error','Нема података о ФМ');
       
       //dd($this->form->regulation);
    }

    public function removeFm($key) {
        unset($this->form->usualy_fms[$key]);
        $this->form->usualy_fms = array_values( $this->form->usualy_fms); // reindex array;
        //dodaje prazno polje
        if($this->form->usualy_fms==null) $this->addFm();

    }
    public function addFm()
    {
       $this->form->usualy_fms[] = '';
    }

    public function removeEducation($key) {
        unset($this->form->educations[$key]);
        $this->form->educations = array_values( $this->form->educations); // reindex array;
        //dodaje prazno polje
        if($this->form->educations==null) $this->addEducation();

    }
    public function addEducation()
    {
       $this->form->educations[] = '';
    }

    public function removeCondition($key) {
        unset($this->form->conditions[$key]);
        $this->form->conditions = array_values( $this->form->conditions); // reindex array;
        //dodaje prazno polje
        if($this->form->conditions==null) $this->addCondition();

    }
    public function addCondition()
    {
       $this->form->conditions[] = '';
    }

    public function removeExperience($key) {
        unset($this->form->experiences[$key]);
        $this->form->experiences = array_values( $this->form->experiences); // reindex array;
        //dodaje prazno polje
        if($this->form->experiences==null) $this->addExperience();

    }
    public function addExperience()
    {
       $this->form->experiences[] = '';
    }
    public function removeJob($key) {
        unset($this->form->jobs[$key]);
        $this->form->jobs = array_values( $this->form->jobs); // reindex array;
        //dodaje prazno polje
        if($this->form->jobs==null) $this->addJob();

    }
    public function addJob()
    {
       $this->form->jobs[] = '';
    }


    public function mount()
    {
        $this->regulations = Regulation::pluck('name')->toArray(); 
    }

    public function submitForm() {
        
      
      // dd($this->form->educations);
        $this->validate();

       /*  $this->validate([
            //'form.fm' => 'array|string|max:255',
            'form.usualy_fms' => 'array|min:1',
            'form.usualy_fms.*' => 'required|string|max:255',
        ], [
            'form.usualy_fms.min' => 'Potrebno je uneti nazive fm',
            'form.usualy_fms.*.required' => 'Naziv FM je obavezan',
            'form.usualy_fms.*.string' => 'Naziv FM mora biti tekstualni',
            'form.usualy_fms.*.max' => 'Naziv FM ne sme biti duži od 255 karaktera',
        ]); */
        
        if($this->form->customValidate()) return;

        $this->form->store();
        session()->flash('success','Подаци су успешно унети');
        $this->form->reset();
        
    }



    public function render()
    {
        return view('livewire.catalog-update');
    }
}
