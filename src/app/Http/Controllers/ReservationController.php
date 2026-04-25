<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Carbon\Carbon; // Carbonを忘れずに追加

class ReservationController extends Controller
{
    /**
     * 予約画面の表示
     */
    public function index(Request $request) // 引数にRequestを追加
    {
        // カレンダーを表示する月を決定
        $viewDate = Carbon::parse($request->query('date', Carbon::today()));
        
        // カレンダーの日付リストを生成（以前のロジックと同じ）
        $startOfMonth = $viewDate->copy()->startOfMonth();
        $calendarStart = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $calendarEnd = $viewDate->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $dates = [];
        $current = $calendarStart->copy();
        while ($current <= $calendarEnd) {
            $dates[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'is_current_month' => $current->month === $viewDate->month,
                'is_today' => $current->isToday(),
                'day_of_week' => $current->dayOfWeek,
            ];
            $current->addDay();
        }

        return view('reservations.index', compact('dates', 'viewDate'));
    }

    public function show($date)
    {
        // URLから受け取った日付（2026-04-25など）の枠を取得
        $selectedDate = Carbon::parse($date);
        $timeSlots = TimeSlot::whereDate('start_time', $date)
                            ->orderBy('start_time')
                            ->get();

        return view('reservations.show', compact('timeSlots', 'selectedDate'));
    }
}