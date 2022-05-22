<?php

namespace App\Http\Controllers;

use App\Models\ClockInClockOut;
use App\Models\Roster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClockInClockOutController extends Controller
{
//    iteration-2:this function does clock in functionality
    public function clockIn(Request $request)
    {
        $todayDate = Carbon::today()->toDateString();
        try {
            DB::beginTransaction();
            $shift = Roster::whereDate('start_time', $todayDate)->latest('id')->first();
            $clock_in_clock_out = ClockInClockOut::whereDate('created_at', $todayDate)->where('user_id',Auth::id())->latest('id')->first();
            if (!$clock_in_clock_out) {
                ClockInClockOut::create([
                    'user_id' => Auth::id(),
                    'clock_in_clock_out' => [[
                        'clock_in' => Carbon::now()->toDateTimeString(),
                        'clock_out' => null
                    ],
                    ],
                    'status' => "UNAPPROVED"
                ]);
            } else {
                $clock_in_clock_out_data = $clock_in_clock_out->clock_in_clock_out;
                $new_clock_in_clock_out = [[
                    'clock_in' => Carbon::now()->toDateTimeString(),
                    'clock_out' => null
                ]];
                $updated_clock_in_clock_out = array_merge($clock_in_clock_out_data, $new_clock_in_clock_out);
                $clock_in_clock_out->update([
                    'clock_in_clock_out' => $updated_clock_in_clock_out,
                    'status' => "UNAPPROVED"
                ]);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

//    iteration-2:this function does clock out functionality
    public function clockOut(Request $request)
    {
        $todayDate = Carbon::today()->toDateString();
        try {
            DB::beginTransaction();
            $clock_in_clock_out = ClockInClockOut::whereDate('created_at', $todayDate)->where('user_id',Auth::id())->latest('id')->first();
            $last_clock_in = collect($clock_in_clock_out->clock_in_clock_out)->last();
            $total_clock_in_clock_out = collect($clock_in_clock_out->clock_in_clock_out)->count();
            if ($clock_in_clock_out) {
                if ($total_clock_in_clock_out === 1) {
                    $clock_in_clock_out->update([
                        'clock_in_clock_out' => [[
                            'clock_in' => $last_clock_in['clock_in'],
                            'clock_out' => Carbon::now()->toDateTimeString()
                        ]],
                    ]);
                } else {
                    $clock_in_clock_out_data = $clock_in_clock_out->clock_in_clock_out;
                    $lastKey = array_key_last($clock_in_clock_out_data);
                    $clock_in_clock_out_data[$lastKey] = [
                        'clock_in' => $last_clock_in['clock_in'],
                        'clock_out' => Carbon::now()->toDateTimeString()
                    ];
                    $clock_in_clock_out->update([
                        'clock_in_clock_out' => $clock_in_clock_out_data
                    ]);
                }
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

//  iteration-2: this function approve shift of the staff.
    public function approveShift(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $shift = ClockInClockOut::find($id);
            if ($shift) {
                $shift->update(['status' => 'APPROVED', 'comments' => $request->get('comment'), 'request_changed_by' => Auth::id(), 'status_changed_date_time' => Carbon::now()->toDateTimeString()]);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    //  iteration-2: this function rejects shift of the staff.
    public function rejectShift(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $shift = ClockInClockOut::find($id);
            if ($shift) {
                $shift->update(['status' => 'REJECTED', 'comments' => $request->get('comment'), 'request_changed_by' => Auth::id(), 'status_changed_date_time' => Carbon::now()->toDateTimeString()]);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

//    public function approveRequest(Request $request)
//    {
//        $todayDate = Carbon::today()->toDateString();
//        try {
//            DB::beginTransaction();
//            $clock_in_clock_out = ClockInClockOut::whereDate('created_at', $todayDate)->latest('id')->first();
//            $clock_in_clock_out->update(['status' => 'SENT_FOR_APPROVE_REQUEST','request_sent_date_time' => Carbon::now()->toDateTimeString()]);
//            DB::commit();
//            return redirect()->back();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//        }
//    }
}
