<?php

namespace App\Http\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;

class CreateDepartments extends Component
{
    public $name;

    //    iteration-2: this function validate in real time

    public function updated($field)
    {
        $this->validateOnly($field, ['name' => 'required|unique:departments,name']);
    }

    //    iteration-2: this function validate the request and store the department

    public function addDepartment()
    {
        $this->validate([
            'name' => 'required|unique:departments,name'
        ]);
        Department::create([
            'name' => $this->name,
        ]);

        $this->redirect('/departments');
    }

    //    iteration-2: this function render department create page

    public function render()
    {
        return view('livewire.departments.create-departments');
    }
}
