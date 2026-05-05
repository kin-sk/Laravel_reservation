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

    // 管理者用キャンセルボタン
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', '予約をキャンセルしました');
    }

}