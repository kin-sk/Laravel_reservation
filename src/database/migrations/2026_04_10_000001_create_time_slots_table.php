<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            // 日付と時間を一つのカラムで管理
            $table->dateTime('start_time')->unique(); // 重複防止のユニーク制約
            $table->dateTime('end_time');
            $table->timestamps();
        });
    }
};