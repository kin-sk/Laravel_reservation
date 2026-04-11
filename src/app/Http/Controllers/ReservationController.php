<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;

class ReservationController extends Controller
{
    public function index()
    {
        $timeSlots = TimeSlot::all();

        return view('reservations.index', compact('timeSlots'));
    }
}
