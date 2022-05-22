<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
//this code render the form to edit users and update the users

class EditUsers extends Component
{
    public $user;
    public $name;
    public $username;
    public $email_address;
    public $role;
    public $password;
    public $password_confirmation;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email_address = $user->email;
        $this->role = $user->roles->first()->id;
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required',
            'email_address' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password' => 'nullable|confirmed|min:8']);
    }

    public function updateUser($user)
    {
        $this->validate([
            'name' => 'required',
            'email_address' => 'required|unique:users,email,' . $user,
            'username' => 'required|unique:users,username,' . $user,
            'role' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = User::find($user);

        $user->update([
            'name' => $this->name,
            'email' => $this->email_address,
            'username' => $this->username,
        ]);
        if (isset($this->password)) {
            $user->update(['password' => bcrypt($this->password)]);
        }
        $user->syncRoles($this->role);
        $this->redirect('/users');
    }

    public function render()
    {
        return view('livewire.users.edit-users', [
            'roles' => Auth::user()->hasRole('Manager') ? Role::where('name','Staff')->get() : Role::all()
        ]);
    }
}
