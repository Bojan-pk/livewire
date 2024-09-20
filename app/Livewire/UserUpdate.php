<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserUpdate extends Component
{
    public UserForm $form;
   // public $users = [];
    public $searchTerm='';
    public $selectedId;
    use WithPagination;
    public function submitForm()
    {
        //$this->validate();
        $this->form->register();
        session()->flash('success', 'Подаци су успешно унети');
        //$this->form->reset();
    }

    public function userSelected($id){
       
        if($this->selectedId!=$id) {
            $this->selectedId=$id;
        $user=User::find($id);
        
        if($user) {
            $this->form->id=$user->id;
            $this->form->name=$user->name;
            $this->form->email=$user->email;
            $this->form->password ='';
            $this->form->role=$user->role;
            //$this->form->file=$user->file;
        }
    } else {
        $this->selectedId='';
        $this->form->reset();
        
    }
        
    }

    public function removeUser($id = null)
    {
        if ($id) {
            $user = User::find($id);
            session()->flash('success', "Корисник" . $user->name . " је успешно обрисан!!!");
            $user->delete();
            $this->form->reset();
        } else $this->cleanTable();
    }
    public function cleanTable()
    {
        $this->form->reset();

        session()->flash('success', 'Обрисана је форма за унос');
    }

   
    protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }
    public function render()
    {

       
        $users = User::query();

        if (!empty($this->searchTerm)) $users = $this->searchByTerm($users);
        
        
        $users = $users->orderBy('name')->paginate(15);
        

        return view('livewire.user-update', [
            'users' => $users
        ]);
    }
}
