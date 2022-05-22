<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//this code render the form to create roles and store the new roles

class CreateRoles extends Component
{
    public $name;
    public $permissions = [];

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required|unique:roles,name', 'permissions' => 'required|array']);
    }

    public function addRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);
        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($this->permissions);

        $this->redirect('/roles');
    }

    public function render()
    {
        return view('livewire.roles.create-roles', [
            'permissionData' => Permission::all()
        ]);
    }
}
