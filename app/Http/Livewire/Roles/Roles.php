<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
//this code render the list of the roles

class Roles extends Component
{
    use WithPagination;

    public function deletePermission(Role $role)
    {
        $role->delete();
    }

    public function render()
    {
        return view('livewire.roles.roles', [
            'roles' => Role::paginate(25)
        ]);
    }
}
