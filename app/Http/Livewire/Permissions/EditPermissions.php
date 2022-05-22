<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use function view;
//this code render the form to edit permissions and update the  permission

class EditPermissions extends Component
{
    public $permission;
    public $name;

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->name = $permission->name;
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required|unique:permissions,name']);
    }

    public function updatePermission($permissionId)
    {
        $this->validate([
            'name' => 'required|unique:permissions,name,'.$permissionId
        ]);
        $permission = Permission::findById($permissionId,'web');
        $permission->update(['name' => $this->name]);

        $this->redirect('/permissions');
    }
    public function render()
    {
        return view('livewire.permissions.edit-permissions');
    }
}
