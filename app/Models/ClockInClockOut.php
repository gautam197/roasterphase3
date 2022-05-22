<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockInClockOut extends Model
{
    use HasFactory;

    protected $table = 'clock_in_clock_out';
    protected $fillable = ['user_id', 'clock_in_clock_out','status','comments','request_changed_by','request_sent_date_time','status_changed_date_time'];
    protected $casts = ['clock_in_clock_out' => 'array'];
    protected $with = ['user'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
