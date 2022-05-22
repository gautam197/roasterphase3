<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

//this code render the form to create permissions and store the new permission

class CreatePermissions extends Component
{
    public $name;

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required|unique:permissions,name']);
    }

    public function addPermission()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name'
        ]);
        Permission::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);

        $this->redirect('/permissions');
    }

    public function render()
    {
        return view('livewire.permissions.create-permissions');
    }
}
