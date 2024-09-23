<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;

use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    public string $email = '';

    public string $password = '';
    
    #[Validate('required|string')]
    public string $role = '';   
    
    public  $id;   

    public function rules()
    {
        return [
            //'name' => 'required|string|max:255',
            'email' => $this->id ?'required|email':'required|email|unique:users,email' ,
            'password' => $this->id ? 'nullable|min:6' : 'required|min:6', // Uslovna validacija
           // 'role' => 'required|string',
        ];
    }


    public function register(): void
    {
        $validated = $this->validate();

        // Uslovno dodaj lozinku
    if (!empty($this->password)) {
        $validated['password'] = Hash::make($this->password);
    }else {
        // Ako lozinka nije uneta, ukloni je iz $validatedData
        unset($validated['password']);
    }
    
      //dd($this->id);
       $user= User::updateOrCreate(
            [
                'id' => $this->id,
            ],
                $validated
        );
    }
}