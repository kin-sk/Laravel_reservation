<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'timeSlot'])
            ->join('time_slots', 'reservations.time_slot_id', '=', 'time_slots.id')
            ->orderBy('time_slots.start_time', 'asc')
            ->select('reservations.*')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }
}