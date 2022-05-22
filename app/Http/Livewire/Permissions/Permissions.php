<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

//this code render the list of permissions

class Permissions extends Component
{
    use WithPagination;

    public function deletePermission(Permission $permission)
    {
        $permission->delete();
    }

    public function render()
    {
        return view('livewire.permissions.permissions', [
            'permissions' => Permission::paginate(25)
        ]);
    }
}
