<?php

namespace App\Http\Livewire\Rosters;

use App\Models\Department;
use App\Models\Roster;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class EditRosters extends Component
{
    public $roster;
    public $start_time;
    public $end_time;
    public $user = '';
    public $department;

//    iteration-2: this function mount the current edit roster data which we need in edit form with prefill data
    public function mount(Roster $roster)
    {
        $this->roster = $roster;
        $this->start_time = Carbon::parse($roster->start_time)->format('Y-m-d H:i');
        $this->end_time = Carbon::parse($roster->end_time)->format('Y-m-d H:i');
        $this->user = $roster->user_id;
        $this->department = $roster->department;
    }

//    iteration-2: this function validate in real time

    public function updated($field)
    {
        $this->validateOnly($field, ['start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today',
            'user' => 'required|exists:users,id',
            'department' => 'required']);
    }

    //    iteration-2: this function validate the request and update the roster

    public function updateRoster($roster)
    {
        $this->validate([
            'start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today',
            'user' => 'required|exists:users,id',
            'department' => 'required'
        ]);

        $roster = Roster::find($roster);
        $roster->update([
            'user_id' => $this->user,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'department' => $this->department,
        ]);

        $this->redirect('/rosters');
    }

    //    iteration-2: this function render roster edit page with data users and departments for selection in form

    public function render()
    {
        return view('livewire.rosters.edit-rosters', [
            'usersData' => User::whereHas('roles', function ($q) {
                $q->where('name', 'Staff');
            })->get(),
            'departmentsData' => Department::all()
        ]);
    }
}
