<?php

namespace App\Livewire;

use Livewire\Component;


use App\Livewire\Forms\RulebookUpdateForm;

use App\Models\Regulation;
use App\Models\Rulebook;

class RulebookUpdate extends Component
{
   
    public RulebookUpdateForm $form;
    public $regulations=[];



    public function submitForm() {
        
        $this->validate();

        
        //if($this->form->customValidate()) return;

        $this->form->store();
        session()->flash('success','Подаци су успешно унети');
        $this->form->reset();
        
    }

    public function addTableRow()
    {
       $this->form->table_items[]= 
        [
            'rb' => '',
            'fm' => '',
            'fc_sso' => '',
            'pg_bb' => '',
            'note' => '',
            'regulation_id' => ''
        ];
    }
   
    
    public function removeTableRow($key) {
        unset($this->form->table_items[$key]);
        $this->form->table_items = array_values( $this->form->table_items); // reindex array;
        //dodaje prazno polje
        if($this->form->table_items==null) $this->form->addTableRow();

    }


/* 
    protected $listeners=[
        'fmSelected'=>'fmSelected'
    ];

    public function fmSelected($fmId){
       
        if($catalog=Catalog::where('fm_id',$fmId)->first())
    {
        $this->form->catalogId=$catalog->id;
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
   
    public function addJob()
    {
       $this->form->jobs[] = '';
    }


    public function mount()
    {
        $this->regulations = Regulation::pluck('name')->toArray(); 
    }

    

    public function removeCatalog($id=null)
    {
        
        if ($id) {
            $catalog=Catalog::find($id);
            session()->flash('success',"Каталог за ФМ ". $catalog->fm->name. " је успешно обрисан!!!");
            $catalog->delete();
            $this->form->reset();
        } 
        else $this->cleanCatalog();

        
    }

    public function cleanCatalog()
    {
        $this->form->reset();

        session()->flash('success','Обрисана је форма за унос');
    }
 */

    
    
    public function render()
    {
        return view('livewire.rulebook-update');
    }
}
