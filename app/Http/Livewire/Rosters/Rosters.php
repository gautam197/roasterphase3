<?php

namespace App\Http\Livewire\Rosters;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Roster;
use Livewire\WithPagination;

class Rosters extends Component
{
    use WithPagination;

    public $from_date;
    public $to_date;

    public $sortField = 'start_time';
    public $sortDirection = 'desc';

//    iteration-2: this function delete selected roster
    public function deleteRoster(Roster $roster)
    {
        $roster->delete();
    }

    public function clearFilter(){
        $this->from_date = null;
        $this->to_date = null;
    }
    public function sortBy($sortField)
    {
        $this->sortDirection = $this->sortField === $sortField ? $this->sortDirection === 'desc' ? 'asc' : 'desc' : 'desc';
        $this->sortField = $sortField;
    }


//    iteration-2: this function render rosters list page where we passed data with pagination
    public function render()
    {
        $rosters = Auth::user()->hasRole('Staff') ? Roster::where('user_id', Auth::id()) : new Roster();
        if ($this->from_date) {
            $rosters = $rosters->whereDate('start_time', '>=', $this->from_date);
        }
        if ($this->to_date) {
            $rosters = $rosters->whereDate('end_time', '<=', $this->to_date);
        }

        if ($this->sortField) {
            if ($this->sortField === 'name') {
                $rosters = $rosters->with(['user' => function ($query)  {
                   return  $query->orderBy('name', $this->sortDirection);
                }]);
            } else {
                $rosters = $rosters->orderBy($this->sortField, $this->sortDirection);
            }
        }
        return view('livewire.rosters.rosters', [
            'rosters' => $rosters->paginate(25)
        ]);
    }
}
