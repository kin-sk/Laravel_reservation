<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Carbon\Carbon; // Carbonを忘れずに追加
use Yasumi\Yasumi; // 祝日のライブラリ

class ReservationController extends Controller
{
    /**
     * 予約画面の表示
     */
    public function index(Request $request) // 引数にRequestを追加
    {
        // カレンダーを表示する月を決定
        $viewDate = Carbon::parse($request->query('date', Carbon::today()));
        
        // カレンダーの日付リストを生成
        $startOfMonth = $viewDate->copy()->startOfMonth();
        $calendarStart = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $calendarEnd = $viewDate->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
        // 【Yasumiの設定】
        // 表示している月の「年」の日本の祝日を取得
        $holidays = Yasumi::create('Japan', (int)$viewDate->year, 'ja_JP');

        $dates = [];
        $current = $calendarStart->copy();
        while ($current <= $calendarEnd) {
            // 現在のループの日付が祝日かどうかを判定
            $isHoliday = $holidays->isHoliday($current);
            $isSunday = $current->isSunday();
            $isWednesday = $current->isWednesday();

            $dates[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'is_current_month' => $current->month === $viewDate->month,
                'is_today' => $current->isToday(),
                'day_of_week' => $current->dayOfWeek,
                'is_holiday' => $isHoliday,
                // 水、日、または祝日を休診日とする
                'is_closed' => ($isSunday || $isWednesday || $isHoliday),
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