<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        // 既存データ削除（重要）
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('time_slots')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $startDate = Carbon::today();
        $endDate = Carbon::today()->copy()->addMonths(3);

        $slots = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {

            // 午前（9:00〜12:00）
            $morningStart = $date->copy()->setTime(9, 0);
            $morningEnd   = $date->copy()->setTime(12, 0);

            for ($time = $morningStart->copy(); $time < $morningEnd; $time->addMinutes(30)) {
                $slots[] = [
                    'date'       => $date->format('Y-m-d'),
                    'start_time' => $time->format('H:i:s'),
                    'end_time'   => $time->copy()->addMinutes(30)->format('H:i:s'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // 午後（13:00〜18:00）
            $afternoonStart = $date->copy()->setTime(13, 0);
            $afternoonEnd   = $date->copy()->setTime(18, 0);

            for ($time = $afternoonStart->copy(); $time < $afternoonEnd; $time->addMinutes(30)) {
                $slots[] = [
                    'date'       => $date->format('Y-m-d'),
                    'start_time' => $time->format('H:i:s'),
                    'end_time'   => $time->copy()->addMinutes(30)->format('H:i:s'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('time_slots')->insert($slots);
    }
}