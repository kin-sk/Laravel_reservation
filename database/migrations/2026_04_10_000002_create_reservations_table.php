<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // 外部キー
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('time_slot_id')
                ->constrained()
                ->cascadeOnDelete();

            // 予約ステータス
            $table->string('status');

            $table->timestamps();

            // 🔥 超重要：同じ時間枠は1人だけ
            $table->unique('time_slot_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};