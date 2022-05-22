<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//this code render the form to edit roles and update the  roles

class EditRoles extends Component
{
    public $role;
    public $name;
    public $permissions = [];

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = $role->getAllPermissions()->pluck('id')->toArray();
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required|unique:roles,name','permissions' => 'required|array']);
    }

    public function updateRole($roleId)
    {
        $this->validate([
            'name' => 'required|unique:roles,name,'.$roleId,
            'permissions' => 'required|array'
        ]);
        $role = Role::findById($roleId,'web');
        $role->update(['name' => $this->name]);
        $role->syncPermissions($this->permissions);
        $this->redirect('/roles');
    }

    public function render()
    {
        return view('livewire.roles.edit-roles',[
            'permissionData' => Permission::all()
        ]);
    }
}
