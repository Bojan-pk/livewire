<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserLogins extends Component
{
    use WithPagination;

    public $searchTerm = '';

   /*  protected function searchByTerm($query)
    {
        $keywords = explode(' ', $this->searchTerm);
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    } */

  
    public function render()
    {
        $logins = DB::table('user_logins')
        ->join('users', 'user_logins.user_id', '=', 'users.id')
        ->select('users.name','users.email', 'user_logins.login_at', 'user_logins.ip_address', 'user_logins.user_agent')
        ->when($this->searchTerm, function ($query, $search) {
            $query->where('users.name', 'like', "%{$search}%")
                  ->orWhere('user_logins.ip_address', 'like', "%{$search}%")
                  //->orWhere('user_logins.user_agent', 'like', "%{$search}%");
                  ->orWhere('users.email', 'like', "%{$search}%");

            // Dodavanje uslova za delimične datume
            $query->orWhere('user_logins.login_at', 'like', "%{$search}%");
        })
        ->orderBy('user_logins.login_at', 'desc')
        ->paginate(15);
        
        return view('livewire.user-logins', compact('logins'));
    }
}
