<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

//this code render the list of users

class Users extends Component
{
    use WithPagination;

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        return view('livewire.users.users', [
            'users' => Auth::user()->hasRole('Manager') ? User::role('Staff')->paginate(25) : User::paginate(25)
        ]);
    }
}
