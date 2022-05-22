<?php

namespace App\Http\Livewire\Rosters;

use App\Models\Department;
use App\Models\Roster;
use App\Models\User;
use Livewire\Component;

class CreateRosters extends Component
{
    public $start_time;
    public $end_time;
    public $user = '';
    public $department = '';

//    phase::2 this function validate in real time
    public function updated($field)
    {
        $this->validateOnly($field, ['start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today',
            'user' => 'required|exists:users,id',
            'department' => 'required']);
    }

//    phase-2:: this function validate the request and store the roster
    public function addRoster()
    {
        $this->validate([
            'start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today',
            'user' => 'required|exists:users,id',
            'department' => 'required'
        ]);

        Roster::create([
            'user_id' => $this->user,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'department' => $this->department,
        ]);

        $this->redirect('/rosters');
    }

//    phase-2:: this function render roster create page with data users and departments for selection in form
    public function render()
    {
        return view('livewire.rosters.create-rosters', [
            'usersData' => User::whereHas('roles', function ($q) {
                $q->where('name','Staff');
            })->get(),
            'departmentsData' => Department::all()
        ]);
    }
}
