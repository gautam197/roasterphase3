<?php

namespace App\Http\Livewire\ClockInClockOut;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ClockInClockOut extends Component
{
    use WithPagination;

    public $from_date;
    public $to_date;

    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    //    phase::2 this function delete selected shift

    public function deleteShift(\App\Models\ClockInClockOut $clock_in_clock_out)
    {
        $clock_in_clock_out->delete();
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

    //    phase::2 this function render shifts list page where we passed data with pagination

    public function render()
    {
        $reports = Auth::user()->hasRole('Staff') ? \App\Models\ClockInClockOut::where('user_id', Auth::user()->id) : new \App\Models\ClockInClockOut();
        if ($this->from_date) {
            $reports = $reports->whereDate('created_at', '>=', $this->from_date);
        }
        if ($this->to_date) {
            $reports = $reports->whereDate('created_at', '<=', $this->to_date);
        }

        if ($this->sortField) {
            $reports = $reports->orderBy($this->sortField, $this->sortDirection);
        }

        return view('livewire.clock-in-clock-out.clock-in-clock-out', [
            'reports' => $reports->paginate(25)
        ]);
    }
}
