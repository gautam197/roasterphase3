<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
//this code render the form to create users and store the new users

class CreateUsers extends Component
{
    public $name;
    public $username;
    public $email_address;
    public $role = '';
    public $password;
    public $password_confirmation;

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required',
            'email_address' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password' => 'required|confirmed|min:8']);
    }

    public function addUser()
    {
        $this->validate([
            'name' => 'required',
            'email_address' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email_address,
            'username' => $this->username,
            'password' => bcrypt($this->password),
        ]);
        $user->syncRoles($this->role);
        $this->redirect('/users');
    }

    public function render()
    {
        return view('livewire.users.create-users', [
            'roles' => Auth::user()->hasRole('Manager') ? Role::where('name','Staff')->get() : Role::all()
        ]);
    }
}
