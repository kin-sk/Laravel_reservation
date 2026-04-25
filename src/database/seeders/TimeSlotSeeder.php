<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        // 1. 既存データの削除 (PostgreSQL対応)
        // TRUNCATE CASCADE を使うことで外部キー制約を無視して削除できます
        DB::statement('TRUNCATE TABLE time_slots CASCADE');

        $startDate = Carbon::today();
        $endDate = Carbon::today()->copy()->addMonths(3);

        $slots = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            
            // 【重要】定休日の判定（水曜日=3, 日曜日=0）
            if ($date->isWednesday() || $date->isSunday()) {
                continue;
            }

            // 午前（09:00〜12:00）
            $morningStart = $date->copy()->setTime(9, 0);
            $morningEnd   = $date->copy()->setTime(12, 0);

            for ($time = $morningStart->copy(); $time < $morningEnd; $time->addMinutes(30)) {
                $slots[] = [
                    'start_time' => $time->format('Y-m-d H:i:s'), // 日付と時間を結合
                    'end_time'   => $time->copy()->addMinutes(30)->format('Y-m-d H:i:s'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // 午後（14:00〜18:00） ※休憩時間を考慮して14時から開始
            $afternoonStart = $date->copy()->setTime(14, 0);
            $afternoonEnd   = $date->copy()->setTime(18, 0);

            for ($time = $afternoonStart->copy(); $time < $afternoonEnd; $time->addMinutes(30)) {
                $slots[] = [
                    'start_time' => $time->format('Y-m-d H:i:s'),
                    'end_time'   => $time->copy()->addMinutes(30)->format('Y-m-d H:i:s'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // 大量データを一括挿入
        DB::table('time_slots')->insert($slots);
    }
}