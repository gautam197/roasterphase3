<?php

namespace App\Http\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    //    phase::2 this function delete selected department

    public function deleteDepartment(Department $department)
    {
        $department->delete();
    }

    //    phase::2 this function render departments list page where we passed data with pagination

    public function render()
    {
        return view('livewire.departments.departments', [
            'departments' => Department::paginate(25)
        ]);
    }
}
