<?php

namespace App\Http\Livewire\ClockInClockOut;

use App\Models\ClockInClockOut as Shift;
use Livewire\Component;

class ViewClockInClockOut extends Component
{
    public $clock_in_clock_out;

    //    phase::2 this function mount the current view clock in clock out data which we need in view page

    public function mount(Shift $clock_in_clock_out)
    {
        $this->clock_in_clock_out = $clock_in_clock_out;
    }

    //    phase-2:: this function render clock in clock out view page

    public function render()
    {
        return view('livewire.clock-in-clock-out.view-clock-in-clock-out');
    }
}
