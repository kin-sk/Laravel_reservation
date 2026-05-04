<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'time_slot_id',
        'status',
    ];

    public function timeSlot()
    {
        return $this->belongsTo(\App\Models\TimeSlot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
