<?php

namespace App\Http\Livewire\ClockInClockOut;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ClockInClockOut as Shift;

class EditClockInClockOut extends Component
{
    public $clock_in_clock_out;
    public $start_time;
    public $end_time;


    //    iteration-2: this function mount the current edit clock in clock out data which we need in edit form with prefill data

    public function mount(Shift $clock_in_clock_out)
    {
        $this->clock_in_clock_out = $clock_in_clock_out;
    }

    //    iteration-2: this function validate in real time

    public function updated($field)
    {
        $this->validateOnly($field, ['start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today']);
    }

    //    iteration-2: this function validate the request and update the clock in clock out

    public function updateShift($clock_in_clock_out)
    {
        $this->validate([
            'start_time' => 'required|after_or_equal:today',
            'end_time' => 'required|after_or_equal:today'
        ]);
        $clock_in_clock_out = \App\Models\ClockInClockOut::find($clock_in_clock_out);
        $clock_in_clock_out->update([
            'clock_in_clock_out' => [
                [
                    'clock_in' => Carbon::parse($this->start_time)->toDateTimeString(),
                    'clock_out' => Carbon::parse($this->end_time)->toDateTimeString()
                ]
            ]
        ]);
        $this->redirect('/shifts');
    }

    //    iteration-2: this function render clock in clock out edit page

    public function render()
    {
        return view('livewire.clock-in-clock-out.edit-clock-in-clock-out');
    }
}
