<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約日を選択してください') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
    <!-- 全体カード -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <!-- ヘッダー（年月） -->
        <div class="flex items-center justify-between px-4 py-3 bg-blue-50 border-b">
            <a href="{{ route('reservations.index', ['date' => $prevMonth]) }}" class="p-2 hover:bg-white rounded-full transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>

            <h2 class="text-xl font-bold text-gray-800">
                {{ $viewDate->format('Y年 n月') }}
            </h2>

            <a href="{{ route('reservations.index', ['date' => $nextMonth]) }}" class="p-2 hover:bg-white rounded-full transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- 曜日 -->
        <div class="grid grid-cols-7 text-center font-semibold text-sm py-2">
            <div class="text-red-400">日</div>
            <div class="text-gray-500">月</div>
            <div class="text-gray-500">火</div>
            <div class="text-gray-500">水</div>
            <div class="text-gray-500">木</div>
            <div class="text-gray-500">金</div>
            <div class="text-cyan-700">土</div>
        </div>

        <!-- カレンダー -->
        <div class="grid grid-cols-7 gap-3 p-4">
            @foreach ($dates as $date)
                @php  
                    $isSunOrHoliday = ($date['day_of_week'] === 0 || $date['is_holiday']);
                    $isSaturday = ($date['day_of_week'] === 6);

                    $textColor = 'text-gray-700';
                    if ($isSunOrHoliday) $textColor = 'text-red-500';
                    if ($isSaturday) $textColor = 'text-cyan-700';
                    if (!$date['is_current_month']) $textColor = 'text-gray-200';
                @endphp

                @if ($date['is_closed'])
                    <div class="h-20 flex flex-col items-center justify-center rounded-xl bg-gray-100 text-gray-400">
                        <span class="text-lg font-bold">{{ $date['day'] }}</span>
                        <span class="text-xs">休診</span>
                    </div>
                @else
                    <a href="{{ route('reservations.show', $date['date']) }}" 
                        class="h-20 flex items-center justify-center rounded-xl transition
                        {{ $date['is_today'] ? 'ring-2 ring-blue-400' : '' }}
                        {{ $date['is_selected'] ?? false ? 'bg-blue-600 text-white' : 'hover:bg-gray-50' }}">
                        
                        <span class="text-lg font-bold {{ $date['is_selected'] ?? false ? 'text-white' : $textColor }}">
                            {{ $date['day'] }}
                        </span>
                    </a>
                @endif
            @endforeach
        </div>

    </div>
</div>
    </div>
</x-app-layout>