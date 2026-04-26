<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約日を選択してください') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-blue-900">
                        {{ $viewDate->format('Y年 n月') }}
                    </h2>
                </div>

                <div class="grid grid-cols-7 gap-2 text-center font-bold mb-4 text-xs uppercase tracking-widest">
                    <div class="text-red-400">日</div>
                    <div class="text-gray-400">月</div>
                    <div class="text-gray-400">火</div>
                    <div class="text-gray-400">水</div>
                    <div class="text-gray-400">木</div>
                    <div class="text-gray-400">金</div>
                    <div class="text-cyan-700">土</div>
                </div>

                <div class="grid grid-cols-7 gap-3">
                    @foreach ($dates as $date)
                        @php  
                            $isSunOrHoliday = ($date['day_of_week'] === 0 || $date['is_holiday']);
                            $isSaturday = ($date['day_of_week'] === 6);
                            
                            // テキスト色の判定
                            $textColor = 'text-gray-700'; // デフォルト
                            if ($isSunOrHoliday) $textColor = 'text-red-500';
                            if ($isSaturday) $textColor = 'text-cyan-700'; // 土曜日の色
                            
                            // 今月以外は薄くする
                            if (!$date['is_current_month']) $textColor = 'text-gray-200';
                        @endphp

                        @if ($date['is_closed'])
                            <!-- 休診日：リンクを無効化し、グレーアウト -->
                            <div class="h-20 flex flex-col items-center justify-center border-2 border-transparent rounded-2xl bg-gray-100 text-gray-400 cursor-not-allowed shadow-inner">
                                <span class="text-lg font-bold">{{ $date['day'] }}</span>
                                <span class="text-[10px] font-black opacity-60">休診</span>
                            </div>
                        @else
                        {{-- クリックすると show 画面へ飛ぶようにします --}}
                        {{-- 診察日：クリック可能なボタン --}}
                        <a href="{{ route('reservations.show', $date['date']) }}" 
                            class="h-20 flex flex-col items-center justify-center border-2 rounded-2xl transition-all duration-200
                            {{ $date['is_today'] ? 'ring-2 ring-blue-400 ring-offset-2' : 'border-gray-50' }}
                            {{ $date['is_selected'] ?? false ? 'bg-blue-600 text-white font-bold' : 'bg-white hover:border-blue-200 hover:shadow-md' }}
                        ">
                            <span class="text-lg font-bold {{ $date['is_selected'] ?? false ? 'text-white' : $textColor }}">
                                {{ $date['day']}}
                            </span>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>