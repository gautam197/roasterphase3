<?php

namespace App\Http\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;

class EditDepartments extends Component
{

    public $department;
    public $name;

    //    iteration-2: this function mount the current edit department data which we need in edit form with prefill data

    public function mount(Department $department)
    {
        $this->department = $department;
        $this->name = $department->name;
    }

//    iteration-2: this function validate in real time

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required']);
    }

    //    iteration-2: this function validate the request and update the department

    public function updateDepartment($departmentId)
    {
        $this->validate([
            'name' => 'required'
        ]);
        $department = Department::find($departmentId);
        $department->update(['name' => $this->name]);

        $this->redirect('/departments');
    }

    //    iteration-2: this function render department edit page

    public function render()
    {
        return view('livewire.departments.edit-departments');
    }
}
