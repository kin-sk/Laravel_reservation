<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 text-center">
            マイページ（予約一覧）
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto space-y-3">

            @forelse ($reservations as $reservation)
                <div class="bg-white shadow-sm rounded-lg px-4 py-3 border border-gray-100">
                    
                    <div class="flex justify-between items-center">
                        
                        <!-- 日付 -->
                        <div>
                            <p class="text-sm text-gray-400">日付</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $reservation->timeSlot->start_time->format('Y/m/d') }}
                            </p>
                        </div>

                        <!-- 区切り -->
                        <div class="w-px h-8 bg-gray-200 mx-4"></div>

                        <!-- 時間 -->
                        <div>
                            <p class="text-sm text-gray-400">時間</p>
                            <p class="text-lg font-semibold text-blue-600">
                                {{ $reservation->timeSlot->start_time->format('H:i') }}
                            </p>
                        </div>

                    </div>

                </div>
            @empty
                <div class="text-center text-gray-400 py-10">
                    予約はありません
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>